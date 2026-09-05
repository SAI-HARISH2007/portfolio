<?php
$PAGE = 'about';
$TITLE = 'Sai Haresh Anand S — builds agent systems, then audits them';
$DESC = 'B.Tech CS (AI & ML), IcfaiTech Hyderabad. I build autonomous and LLM-powered systems, then evaluate them adversarially and publish what breaks.';
require __DIR__ . '/inc/data.php';
require __DIR__ . '/inc/header.php';
$featured = array_slice($PROJECTS, 0, 3);
?>

<section class="section" style="padding-top:clamp(7rem,18vh,11rem)">
  <div class="wrap">
    <p class="eyebrow r">Hyderabad, India</p>

    <h1 class="r" style="max-width:16ch">
      I build agent systems,<br>
      then try to <em style="font-family:var(--display);font-style:italic;color:var(--accent-soft)">break</em> them.
    </h1>

    <div class="r" style="margin-top:2.2rem">
      <p class="lede">
        Second-year computer science student at IcfaiTech Hyderabad, working on autonomous
        and LLM-powered systems. The building is the easy half. What I actually care about is
        whether the thing holds up when someone attacks it, so I write the evaluation harness
        against my own work and publish the results even when they are unflattering.
      </p>
      <p style="margin-top:1.1rem">
        The last audit I ran found prompt injection succeeding 81% of the time against an app
        I had already won a hackathon with. That number is on this site because leaving it out
        would make the site worth less, not more.
      </p>
    </div>

    <div class="flow r">
      <a class="btn btn--primary" href="projects.php">
        See the work
        <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 8h10M9 4l4 4-4 4"/></svg>
      </a>
      <a class="btn btn--ghost" href="https://github.com/SAI-HARISH2007">GitHub</a>
      <a class="btn btn--ghost" href="contact.php">Get in touch</a>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0">
  <div class="wrap split">
    <header class="r">
      <p class="eyebrow">How I work</p>
      <h2 style="font-size:var(--step-2)">Verification is the product</h2>
    </header>
    <div class="stack">
      <p class="r">
        A model that is right most of the time is not the same as a system you can trust. The
        difference is whether anything in the loop can <em>check</em>. So the systems I build put
        deterministic code where correctness is knowable, and let the model handle only the part
        that genuinely needs judgement.
      </p>
      <p class="r">
        In <a href="https://github.com/SAI-HARISH2007/greenlight" style="color:var(--accent-soft)">greenlight</a>
        that meant a gate the agent cannot talk its way past: no conclusion without an active probe
        confirming the mechanism, and no remediation without a human approving it. It moved root-cause
        accuracy from 83% to 100% across twelve seeded incidents.
      </p>
      <p class="r">
        It also taught me the more useful lesson. My first version of that gate was eleven lines and
        obviously correct, and it made the system worse, because a rejected agent does not stop, it
        tries something else. It rolled back an unrelated production deploy. Untested code in the
        control loop turned out to be more dangerous than an unverified model.
      </p>
    </div>
  </div>
</section>

<section class="section stage" style="padding-top:0">
  <div class="wrap">
    <header class="r" style="margin-bottom:3rem">
      <p class="eyebrow">Selected work</p>
      <h2 style="font-size:var(--step-2)">Three of six</h2>
    </header>

    <div class="cards">
      <?php foreach ($featured as $i => $p): ?>
        <?php $total = 0; $wide = ($i === 0); require __DIR__ . '/inc/card.php'; ?>
      <?php endforeach; ?>
    </div>

    <div class="flow">
      <a class="btn btn--ghost r" href="projects.php">All six projects</a>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
