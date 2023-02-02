<?php 
try {
	spl_autoload_register(function($className){
		require_once __DIR__.'/src/'.str_replace('\\','/',$className).'.php';
	});

	$route = $_GET['route'] ?? '';
	//var_dump($route);
	$routes = require __DIR__.'/src/routes.php';

	$isRouteFound = false;
	foreach ($routes as $pattern => $controllerAndAction) {
		preg_match($pattern, $route, $matches);
		if (!empty($matches)) {
			$isRouteFound = true;
			break;
		}
	}
	if (!$isRouteFound) {
		throw new \MyProject\Exceptions\NotFoundException();
		
	}
	//var_dump($matches);
	unset($matches[0]);
	//var_dump($matches);
	$controllerName = $controllerAndAction[0];
	$actionName = $controllerAndAction[1];

	$controller = new $controllerName();
	$controller->$actionName(...$matches);

} catch (\MyProject\Exceptions\DbException $e) {
	$view = new \MyProject\View\View(__DIR__.'/templates/errors');
	$view->renderHtml('500.php',['error'=>$e->getMessage()],500);
} catch(\MyProject\Exceptions\NotFoundException $e){
	$view = new \MyProject\View\View(__DIR__.'/templates/errors');
	$view->renderHtml('404.php',[],404);
}
?>