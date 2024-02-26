<?php require_once "../functions.php"; __init(); ?>
<html>
<head>
  <title>nPlayer Links</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link href="./stylesheet.css?<?= $App->Token ?>" rel="stylesheet" type="text/css"/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript" language="javascript"></script>
  <script src="./js/jquery.cookie.js" type="text/javascript" language="javascript"></script>
  <script src="./document.ready.js?<?= $App->Token ?>" type="text/javascript" language="javascript"></script>
</head>
<body>
<div class="container">
<div class="row content">
  <ul class="list-group nplayer links">
  <?php $num = 1; ?>
  <?php foreach(loadLinks($App->Path."/data/links.lst") as $i => $entry): ?>
    <!--<li><pre><code><?php var_dump($entry); ?></code></pre></li>-->
    <?php if (empty($entry->source)) continue; ?>
    <li class="list-group-item">
         <a data-link="<?= $entry->source ?>" class="link-<?= $entry->hash ?>"
            data-hash="<?= $entry->hash ?>"
            <?php if (!isset($_GET['r'])): ?>
            href="<?= srcScheme($entry->source) ?>">
            <?php else: ?>
            href="<?= $entry->source ?>">
            <?php endif; ?>
              <?= htmlspecialchars(  srcName( $entry->source )  ) ?>
         </a>
    </li>
   
    <?php if ($num == 5): ?>
      <?php $num = 0; ?>
      </ul>
      <div class="hr">&ensp;</div>
      <ul class="list-group nplayer links">
    <?php endif; ?>
    
    <?php $num++; ?>
  <?php endforeach; ?>
  </ul>
</div>
</div>
<div class="debug-console"><pre><code>
  <?php var_dump($App); ?>
</code><pre></div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

