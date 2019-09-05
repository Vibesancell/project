<?php

require_once( "controllers/ProjectController.php" );

class Routing {
	private $routes;

  public function __construct( $routesPath ) {
    $this->routes = include( $routesPath );
  }

  public function getURI() {
     if ( !empty( $_SERVER['REQUEST_URI'] ) ) {
         return trim( $_SERVER['REQUEST_URI'], '/' );
     }

     if ( !empty( $_SERVER['PATH_INFO'] ) ) {
         return trim( $_SERVER['PATH_INFO'], '/' );
     }

     if ( !empty( $_SERVER['QUERY_STRING'] ) ) {
         return trim( $_SERVER['QUERY_STRING'], '/' );
     }
   }

	public static function buildRoute() {

		$controllerName = "ProjectController";
		$modelName = "ProjectModel";
		$action = "index";

		$route = explode( "/", $_SERVER['REQUEST_URI'] );

		if($route[1] != '') {
			$controllerName = ucfirst( $route[1]. "Controller" );
			$modelName = ucfirst( $route[1]. "Model" );
		}

		require_once CONTROLLER_PATH . $controllerName . ".php"; //IndexController.php
		require_once MODEL_PATH . $modelName . ".php"; //IndexModel.php

		if( isset($route[2] ) && $route[2] !='' ) {
			$action = $route[2];
		}

		$projectController = new ProjectController();
		$projectController->index();
	}

	public function errorPage() {

	}
}
