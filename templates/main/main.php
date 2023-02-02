<?php include __DIR__.'/../header.php';?>
<?php foreach($articles as $article):?>
    <h2><a href="/articles/<?=$article->getId()?>"><?=$article->getName()?></a></h2>
    <p><?=$article->getText()?></p>
    <hr>
    
<?php endforeach;?>
<?php 
function sum($a, $b)
{
    return $a + $b;
}


$sumReflector = new ReflectionFunction('sum');
//echo $sumReflector->getFileName();
//echo $sumReflector->getStartLine();
echo $sumReflector->getEndLine();

?>
<?php include __DIR__.'/../footer.php';?>       