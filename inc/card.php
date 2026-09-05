<?php
/* Project card. Expects $p (project), $i (index), $total, and optional $wide. */
$wide = $wide ?? false;
$total = $total ?? 0;
?>
<article class="card r<?= $wide ? ' card--wide' : '' ?>" id="<?= $p['slug'] ?>">
  <div class="card__top">
    <h3><a href="<?= $p['repo'] ?>"><?= htmlspecialchars($p['name']) ?></a></h3>
    <span class="card__idx"><?= str_pad((string)($i + 1), 2, '0', STR_PAD_LEFT) ?><?= $total ? ' / ' . $total : '' ?></span>
  </div>
  <p class="card__role"><?= htmlspecialchars($p['role']) ?></p>

  <div class="card__body">
    <p><?= htmlspecialchars($p['blurb']) ?></p>
    <div class="tags">
      <?php foreach ($p['tags'] as $t): ?><span class="tag"><?= htmlspecialchars($t) ?></span><?php endforeach; ?>
    </div>
  </div>

  <div class="card__side">
    <div class="metrics">
      <?php foreach ($p['metrics'] as $m): ?>
        <div class="metric"><b><?= htmlspecialchars($m[0]) ?></b><span><?= htmlspecialchars($m[1]) ?></span></div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="card__foot">
    <a class="btn btn--text" href="<?= $p['repo'] ?>">
      Source
      <svg viewBox="0 0 16 16" fill="none" stroke="currentColor" stroke-width="1.6" style="width:1em;height:1em"><path d="M6 10l4-4M7 5h4v4"/></svg>
    </a>
    <span class="mono dim" style="font-size:var(--step--1);align-self:center"><?= htmlspecialchars($p['note']) ?></span>
  </div>
</article>
