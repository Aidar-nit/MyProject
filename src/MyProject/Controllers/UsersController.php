<?php 
namespace MyProject\Controllers;
use MyProject\View\View;

class UsersController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__.'/../../../templates');
    }

    public function singUp()
    {
        $this->view->renderHtml('/users/singUp.php');
    }
}


?>