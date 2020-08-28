<?php

	function my_autoload($className) {
		$file = dirname(__DIR__) . "/" . $className . ".php";
		if (is_readable($file)) {
			require $file;
		} 		 
	}
	
	// Autoload
	spl_autoload_register("my_autoload"); 

	// Set Error and Exception Handlers
	set_error_handler('Core\Error::errorHandler');
	set_exception_handler('Core\Error::exceptionHandler');

	// Start the Application by providing Query String to dispatch method in Router object	
	$router = new \Core\Router();
	$router->dispatch($_SERVER['QUERY_STRING']);

?>