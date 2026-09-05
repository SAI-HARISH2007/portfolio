<?php
http_response_code(404);
$PAGE = '';
$TITLE = 'Page not found — Sai Haresh Anand S';
$DESC = 'That page does not exist.';
require __DIR__ . '/inc/header.php';
?>
<section class="section" style="padding-top:clamp(8rem,22vh,13rem)">
  <div class="wrap">
    <p class="eyebrow r">404</p>
    <h1 class="r" style="font-size:var(--step-3);max-width:14ch">That page does not exist.</h1>
    <p class="lede r" style="margin-top:1.6rem">
      The link may be out of date, or I may have moved something. Both are recoverable.
    </p>
    <div class="flow r">
      <a class="btn btn--primary" href="about.php">Back to the start</a>
      <a class="btn btn--ghost" href="projects.php">See the work</a>
    </div>
  </div>
</section>
<?php require __DIR__ . '/inc/footer.php'; ?>
