<?php include __DIR__.'/../header.php';?>
<h2><?=$article->getName()?></h2>
<p><?=$article->getText()?></p>
<p><?=$article->getAuthor()->getNickName()?></p>
<?php include __DIR__.'/../footer.php';?>