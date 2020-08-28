<?php

	namespace Core;

	class Router {

		private $filePath;
		private $namespace;
		private $controller;
		private $action;
	
		public function dispatch($url) {	
			
			if($this->setRoute($url)) {

				$controller = ucfirst($this->controller);
				$controller = $this->filePath . $controller;

				if (class_exists($controller)) {
					$controller_obj = new $controller();
					
					$action = $this->action;
					if(method_exists($controller_obj, $action)) {
						$controller_obj->$action();
					} else {
						throw new \BadMethodCallException("Method '" . $action . "' not found.", 404);
					}
				} else {
					throw new \Exception("Class '" . ucfirst($this->controller) . "' not found", 404);
				}

			}		

		}

		/*
			Calls method to remove query strings from the url
			Calls method to remove trailing slash(es) at the end
			Refactors URL to namespace/controller/action based on number of elements in URL
			Example (1): /admin/users/new will assign following values to private variables:
					$this->namespace = admin
					$this->controller = user
					$this->action = new

			Example (2): /products/list will assign following values to private variables:
					$this->controller = products
					$this->action = list

		*/
		private function setRoute($url) {
			$url = $this->removeQueryStringVariables($url);
			$url = $this->trimRightSlash($url);
			if ($url == '') {
				$this->controller = 'home';
				$this->action = 'index';
			} else {
				$arrUrl = explode('/', $url, 3);
				if (count($arrUrl) > 2) {
					$this->namespace = $arrUrl[0];
					$this->controller = $arrUrl[1];
					$this->action = $arrUrl[2];
				} else {
					$this->controller = $arrUrl[0];
					$this->action = $arrUrl[1];
				}
			}
			$this->setFilePathToController();
			return true;
		}

		/*
			Checks if namespace(s) are used and sets path to location where Controllers are located
			Example (1): namespace 'admin' is requested in the url, filePath will set to:
						\App\Controllers\Admin
			Example (2): no namespace requested in the url, filePath will set to:
						\App\Controllers\
		*/
		private function setFilePathToController() {
			$this->filePath = 'App\Controllers\\';
			if ($this->namespace != '') {
				$this->filePath .= ucfirst($this->namespace) . '\\';
			}
		}

		/*
			Remove Slash at the end of URL:
			Example: /product/list/ returns
			         /product/list
		*/
		private function trimRightSlash($url) {
			$url = rtrim($url, '/');
			return $url;
		}

		/*
			Remove Query String variables from URL:
			Example: /product/list?id=5&product-name=Apples returns
			         /product/list
		*/
		private function removeQueryStringVariables($url) {
			if ($url != '') {
				if (strpos($url, '&') !=  null) {
					$url = substr($url, 0, strpos($url, '&'));
				}
			}
			return $url;
		}

	}