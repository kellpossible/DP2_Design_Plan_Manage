<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require( 'php_error.php' );
\php_error\reportErrors();
session_start();

require_once('data/database.php');
require_once('models/product_inventory.php');
require_once('models/user.php');
require_once('models/purchases.php');
require_once('controllers/inventory_controller.php');
require_once('controllers/index_controller.php');
require_once('controllers/login_controller.php');
require_once('controllers/report_controller.php');
require_once('vendor/autoload.php');

use Symfony\Component\HttpFoundation\Request;


/** Builds on example from http://www.sitepoint.com/front-controller-pattern-1/ */
class FrontController {
	private $templates;
	private $db;
	private $models;
	private $request;

	const DEFAULT_CONTROLLER = "IndexController";
    const DEFAULT_ACTION     = "Index";

    private $controller    = self::DEFAULT_CONTROLLER;
    private $action        = self::DEFAULT_ACTION;
	private $params = array();

	public function __construct($options = array())
	{
		$db = openDatabase(false);
		$this->request = Request::createFromGlobals();
		$this->templates = new League\Plates\Engine();
		$this->templates->loadExtension(new League\Plates\Extension\URI($this->request->getPathInfo()));
		$this->templates->addFolder('base', 'views/base');
		$this->templates->addFolder('inventory', 'views/inventory');
		$this->templates->addFolder('user', 'views/user');
		$this->templates->addFolder('report', 'views/report');
		$this->templates->addFolder('index', 'views/index');

		$this->models = array();
		$this->models[ProductInventory::getModelName()] = new ProductInventory($db, $this->models);
		$this->models[Users::getModelName()] = new Users($db, $this->models);
		$this->models[Purchases::getModelName()] = new Purchases($db, $this->models);

		if (empty($options)) {
           $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
	}

	protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/");
        // $path = preg_replace('/[^a-zA-Z0-9]//', "", $path);
        $path = preg_replace("(\bindex.php[/]\b)", "", $path);
        // if (strpos($path, $this->basePath) === 0) {
        //     $path = substr($path, strlen($this->basePath));
        // }
        $matches = array();
        preg_match("(([a-zA-Z0-9]+)[/]([a-zA-Z0-9]+)([/](.*)){0,1})", $path, $matches);
        // preg_match("([a-zA-Z0-9]+)[/]([a-zA-Z0-9]+)([?].*)*", $path, $matches);

        if (isset($matches[1])) {
            $this->setController($matches[1]);
        }
        if (isset($matches[2])) {
            $this->setAction($matches[2]);
        }
        if (isset($matches[4])) {
            $this->setParams(explode("/", $matches[4]));
        }
    }

    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new InvalidArgumentException(
                "The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new InvalidArgumentException(
                "The controller action '$action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
    	$run_controller = new $this->controller($this->templates, $this->models);
        call_user_func_array(array($run_controller, $this->action), $this->params);
    }
}

?>
