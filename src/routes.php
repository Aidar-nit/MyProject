<?php 

return [
	'~^$~'=>[\MyProject\Controllers\MainController::class, 'main'],
	'~^hello/(.*)$~'=>[\MyProject\Controllers\MainController::class, 'sayHello'],
	'~^bye/(.*)$~'=>[\MyProject\Controllers\MainController::class, 'sayBye'],
	'~^articles/(\d+)$~'=>[\MyProject\Controllers\ArticlesController::class, 'view'],
	'~^articles/(\d+)/edit$~'=>[\MyProject\Controllers\ArticlesController::class, 'edit'],
	'~^articles/add$~'=>[\MyProject\Controllers\ArticlesController::class, 'add'],
	'~^users/register$~'=>[\MyProject\Controllers\UsersController::class, 'singUp'],
	'~^users/(\d+)/activate/(.+)$~' => [\MyProject\Controllers\UsersController::class, 'activate'],
];



?>