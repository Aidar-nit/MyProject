<?php 
namespace MyProject\Controllers;
use MyProject\View\View;
use MyProject\Models\Users\User;
use MyProject\Exceptions\InvalidArgumentException;


class UsersController
{
    private $view;

    public function __construct()
    {
        $this->view = new View(__DIR__.'/../../../templates');
    }

    public function singUp()
    {
        if(!empty($_POST))
        {
            try {
                $user = User::singUp($_POST);
            } catch (InvalidArgumentException $e) {
               $this->view->renderHtml('/users/singUp.php',['error' => $e->getMessage()]);
               return;
            }
            if ($user instanceof User) {
                $this->view->renderHtml('users/signUpSuccessful.php');
                return;
            }
           
        }
        $this->view->renderHtml('/users/singUp.php');
    }
}


?>