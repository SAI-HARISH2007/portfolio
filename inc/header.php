<?php
$PAGE  = $PAGE  ?? 'about';
$TITLE = $TITLE ?? 'Sai Haresh Anand S';
$DESC  = $DESC  ?? 'I build agent systems, then evaluate them adversarially. B.Tech CS (AI & ML), IcfaiTech Hyderabad.';
$URL   = 'https://haresh.acadnet.net/';
$nav = ['about' => 'Index', 'projects' => 'Work', 'contact' => 'Contact'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<script>document.documentElement.className+=" js";</script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= htmlspecialchars($TITLE) ?></title>
<meta name="description" content="<?= htmlspecialchars($DESC) ?>">
<meta name="author" content="Sai Haresh Anand S">
<link rel="canonical" href="<?= $URL . ($PAGE === 'about' ? '' : $PAGE) ?>">

<meta property="og:type" content="website">
<meta property="og:site_name" content="Sai Haresh Anand S">
<meta property="og:title" content="<?= htmlspecialchars($TITLE) ?>">
<meta property="og:description" content="<?= htmlspecialchars($DESC) ?>">
<meta property="og:url" content="<?= $URL ?>">
<meta name="twitter:card" content="summary_large_image">

<link rel="icon" href="data:image/svg+xml,%3Csvg%20xmlns='http://www.w3.org/2000/svg'%20viewBox='0%200%2032%2032'%3E%3Crect%20width='32'%20height='32'%20rx='7'%20fill='%230c0a09'/%3E%3Ccircle%20cx='16'%20cy='16'%20r='5'%20fill='%23c2612f'/%3E%3C/svg%3E"><rect width='32' height='32' rx='7' fill='%230c0a09'/><circle cx='16' cy='16' r='5' fill='%23c2612f'/></svg>">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Instrument+Sans:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="assets/site.css">
</head>
<body>
<a class="skip" href="#main">Skip to content</a>

<nav class="nav">
  <a class="brand" href="about.php"><b></b> SAI HARESH ANAND S</a>
  <ul>
    <?php foreach ($nav as $slug => $label): ?>
      <li><a href="<?= $slug ?>.php"<?= $PAGE === $slug ? ' aria-current="page"' : '' ?>><?= $label ?></a></li>
    <?php endforeach; ?>
  </ul>
</nav>

<main id="main">
