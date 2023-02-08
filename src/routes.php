<?php 

return [
	'~^$~'=>[\MyProject\Controllers\MainController::class, 'main'],
	'~^hello/(.*)$~'=>[\MyProject\Controllers\MainController::class, 'sayHello'],
	'~^bye/(.*)$~'=>[\MyProject\Controllers\MainController::class, 'sayBye'],
	'~^articles/(\d+)$~'=>[\MyProject\Controllers\ArticlesController::class, 'view'],
	'~^articles/(\d+)/edit$~'=>[\MyProject\Controllers\ArticlesController::class, 'edit'],
	'~^articles/(\d+)/delete$~'=>[\MyProject\Controllers\ArticlesController::class, 'deleteArticle'],
	'~^articles/add$~'=>[\MyProject\Controllers\ArticlesController::class, 'add'],
	'~^users/register$~'=>[\MyProject\Controllers\UsersController::class, 'singUp'],
	'~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
	'~^users/login$~' => [\MyProject\Controllers\UsersController::class, 'login'],
	'~^users/logout$~' => [\MyProject\Controllers\UsersController::class, 'logout'],
];



?>