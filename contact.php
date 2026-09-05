<?php
$PAGE = 'contact';
$TITLE = 'Contact — Sai Haresh Anand S';
$DESC = 'Get in touch about internships, open-source collaboration or research.';

$message = '';
$messageType = '';
$old = ['name' => '', 'phone' => '', 'email' => '', 'subject' => '', 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($old as $k => $_) {
        $old[$k] = trim($_POST[$k] ?? '');
    }

    $name       = htmlspecialchars($old['name']);
    $phone      = htmlspecialchars($old['phone']);
    $email      = filter_var($old['email'], FILTER_SANITIZE_EMAIL);
    $subject    = htmlspecialchars($old['subject']);
    $userMessage = htmlspecialchars($old['message']);

    if ($name === '' || $phone === '' || $email === '' || $subject === '' || $userMessage === '') {
        $message = 'Every field is required. Please complete the ones left blank.';
        $messageType = 'error';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'That email address does not look valid. Please check it.';
        $messageType = 'error';
    } else {
        $to = 'saiharishanand2007@gmail.com';
        $emailSubject = 'Portfolio Contact: ' . $subject;

        $emailBody  = "=== New Contact Form Submission ===\n\n";
        $emailBody .= "From: $name\n";
        $emailBody .= "Email: $email\n";
        $emailBody .= "Phone: $phone\n";
        $emailBody .= "Subject: $subject\n\n";
        $emailBody .= "Message:\n$userMessage\n";

        $headers  = "From: noreply@acadnet.net\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

        if (@mail($to, $emailSubject, $emailBody, $headers)) {
            $message = 'Message sent. I usually reply within a couple of days.';
            $messageType = 'success';
            $old = array_map(fn($v) => '', $old);
        } else {
            $message = 'The message could not be sent. Email me directly at saiharishanand2007@gmail.com.';
            $messageType = 'error';
        }
    }
}

require __DIR__ . '/inc/header.php';
$v = fn($k) => htmlspecialchars($old[$k] ?? '', ENT_QUOTES);
?>

<section class="section" style="padding-top:clamp(7rem,16vh,10rem)">
  <div class="wrap split">
    <header class="r">
      <p class="eyebrow">Contact</p>
      <h1 style="font-size:var(--step-3)">Say hello</h1>
      <p class="dim" style="margin-top:1.4rem;font-size:var(--step--1)">
        Internships, open-source collaboration, or anything about the work on this site.
      </p>
      <p style="margin-top:1.6rem">
        <a class="btn btn--text" href="mailto:saiharishanand2007@gmail.com">saiharishanand2007@gmail.com</a>
      </p>
    </header>

    <div class="r">
      <?php if ($message !== ''): ?>
        <div class="note <?= $messageType ?>" role="<?= $messageType === 'error' ? 'alert' : 'status' ?>">
          <span aria-hidden="true"><?= $messageType === 'success' ? '✓' : '!' ?></span>
          <span><?= $message ?></span>
        </div>
      <?php endif; ?>

      <form method="POST" action="contact.php" novalidate>
        <div class="field-row">
          <div class="field">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= $v('name') ?>" placeholder="Your name" required autocomplete="name">
          </div>
          <div class="field">
            <label for="phone">Phone</label>
            <input type="tel" id="phone" name="phone" value="<?= $v('phone') ?>" placeholder="Contact number" required autocomplete="tel">
          </div>
        </div>

        <div class="field">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="<?= $v('email') ?>" placeholder="you@example.com" required autocomplete="email">
        </div>

        <div class="field">
          <label for="subject">Subject</label>
          <input type="text" id="subject" name="subject" value="<?= $v('subject') ?>" placeholder="What is this about" required>
        </div>

        <div class="field">
          <label for="message">Message</label>
          <textarea id="message" name="message" rows="7" placeholder="Write as much or as little as you like." required><?= $v('message') ?></textarea>
        </div>

        <button type="submit" class="btn btn--primary">
          Send message
          <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
        </button>
      </form>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
