<?php 
namespace MyProject\Controllers;

use MyProject\View\View;
use MyProject\Models\Articles\Article;

class MainController
{
	/** @var View */
	private $view;


	public function __construct()
	{
		$this->view = new View(__DIR__.'/../../../templates');
		
	}


	public function sayHello($name)
	{
		$this->view->renderHtml('main/hello.php',['name'=>$name],'Страница приветствия');
	}

	public function main()
	{
		
		$articles = Article::findAll();
		
		$this->view->renderHtml('main/main.php',['articles'=>$articles]);

	}

	public function sayBye($name)
	{
		echo 'Bye '.$name;
	}

}



?>