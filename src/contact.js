/* Contact form: progressive. Without JS it posts to contact.php and comes back
   with ?sent=1|0. With JS it posts in place and shows the reply. */

export function initContact() {
  const form = document.querySelector('[data-contact-form]');
  if (!form) return;
  const status = form.querySelector('[data-form-status]');
  const button = form.querySelector('[data-submit]');
  const label = button.querySelector('span');

  const show = (kind, text) => {
    status.hidden = false;
    status.dataset.kind = kind;
    status.textContent = text;
  };

  const params = new URLSearchParams(location.search);
  if (params.has('sent')) {
    show(params.get('sent') === '1' ? 'ok' : 'error',
      params.get('sent') === '1' ? 'Sent. I usually reply within a couple of days.' : 'Could not send. Email me directly at saiharishanand2007@gmail.com.');
    history.replaceState(null, '', location.pathname + '#contact');
  }

  const validate = () => {
    let ok = true;
    for (const el of form.querySelectorAll('[required]')) {
      const bad = !el.value.trim() || (el.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(el.value));
      el.setAttribute('aria-invalid', bad ? 'true' : 'false');
      if (bad && ok) { el.focus(); ok = false; }
    }
    return ok;
  };

  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    if (!validate()) { show('error', 'Name, a valid email and a message are all needed.'); return; }
    button.disabled = true;
    const original = label.textContent;
    label.textContent = 'Sending…';
    try {
      const res = await fetch(form.action, {
        method: 'POST',
        headers: { Accept: 'application/json' },
        body: new FormData(form),
      });
      const data = await res.json();
      show(data.ok ? 'ok' : 'error', data.message);
      if (data.ok) form.reset();
    } catch {
      show('error', 'The message could not be sent. Email me directly at saiharishanand2007@gmail.com.');
    } finally {
      button.disabled = false;
      label.textContent = original;
    }
  });
}
