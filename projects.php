<?php
$PAGE = 'projects';
$TITLE = 'Work — Sai Haresh Anand S';
$DESC = 'Agent systems, adversarial evaluations and interpretability experiments: greenlight, activation-shield, SafeStep, QuantBot, Reclaim, Sentinel.';
require __DIR__ . '/inc/data.php';
require __DIR__ . '/inc/header.php';
?>

<section class="section" style="padding-top:clamp(7rem,16vh,10rem);padding-bottom:0">
  <div class="wrap">
    <p class="eyebrow r">Six projects</p>
    <h1 class="r" style="font-size:var(--step-3);max-width:18ch">Everything here has a number attached to it.</h1>
    <p class="lede r" style="margin-top:1.8rem">
      Where a project claims something, the claim is measured and the source is one click away.
      Where a project failed, the failure is written down. Two of these are still in progress and
      say so.
    </p>
  </div>
</section>

<section class="section stage">
  <div class="wrap">
    <div class="cards">
      <?php foreach ($PROJECTS as $i => $p): ?>
        <?php $total = count($PROJECTS); $wide = ($i === 0); require __DIR__ . '/inc/card.php'; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="section" style="padding-top:0">
  <div class="wrap split">
    <header class="r">
      <p class="eyebrow">Also</p>
      <h2 style="font-size:var(--step-2)">Open source</h2>
    </header>
    <div class="stack">
      <p class="r">
        Seven pull requests to <a href="https://github.com/AOSSIE-Org/EduAid" style="color:var(--accent-soft)">AOSSIE's EduAid</a>,
        including a directory-traversal fix in the file upload path, plus one to matplotlib.
        None merged yet, and I would rather say that plainly than round it up.
      </p>
      <p class="r">
        Earlier work — an algorithm visualiser rendered entirely on HTML5 Canvas with no libraries,
        a multithreaded TCP chat server written on raw sockets, an LLM interview-practice platform —
        is on <a href="https://github.com/SAI-HARISH2007" style="color:var(--accent-soft)">GitHub</a>.
      </p>
    </div>
  </div>
</section>

<?php require __DIR__ . '/inc/footer.php'; ?>
