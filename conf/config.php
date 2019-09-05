<?php

define( "ROOT", $_SERVER['DOCUMENT_ROOT'] );
define( "CONTROLLER_PATH", ROOT. "/project/controllers/" );
define( "MODEL_PATH", ROOT. "/project/models/" );
define( "VIEW_PATH", ROOT. "/project/views/" );

require_once( "route.php" );
require_once MODEL_PATH. 'Model.php';
require_once VIEW_PATH. 'View.php';
require_once CONTROLLER_PATH. 'Controller.php';


Routing::buildRoute();
