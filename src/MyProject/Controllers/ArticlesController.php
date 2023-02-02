<?php 
namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Services\DB;
use MyProject\Models\Articles\Article;
use MyProject\Models\Users\User;
use MyProject\Exceptions\NotFoundException;


class ArticlesController
{
	private $view;


	public function __construct()
	{
		$this->view = new View(__DIR__.'/../../../templates');
	
	}

	public function view(int $articleId): void
	{
		$article = Article::getById($articleId);
		if ($article === null) 
		{
			throw new NotFoundException();
			return;
		}
		
		$this->view->renderHtml('articles/view.php',['article'=>$article]);
			
	}

	public function edit(int $articleId):void 
	{

	    $article = Article::getById($articleId);

	    if ($article === null) {
	        throw new NotFoundException();
	    }

	    $article->setName('Новое название статьи');
	    $article->setText('Новый текст статьи');
	    $article->save();
	}

	public function add():void 
	{
		$author = User::getById(1);

		$article = new Article();
		$article->setAuthor($author);
		$article->setName('New Name');
		$article->setText('New Text');
		$article->save();
		//var_dump($article);
	}
	
	
}


?>