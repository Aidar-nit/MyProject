<?php include __DIR__.'/../header.php';?>
<?php foreach($articles as $article):?>
    <h2><a href="/articles/<?=$article->getId()?>"><?=$article->getName()?></a></h2>
    <p><?=$article->getText()?></p>
    <?php if (!empty($user) && $user->isAdmin()): ?>
        <a href="articles/<?=$article->getId()?>/edit">Редактировать</a>
        <a href="articles/<?=$article->getId()?>/delete">Удалить</a>
    <?php endif ?>
    <hr>
    
<?php endforeach;?>

<?php include __DIR__.'/../footer.php';?>       