<?php
require_once('vendor/autoload.php');
// ---- set up error handling ----

use Whoops\Handler\PrettyPageHandler;
use Whoops\Handler\JsonResponseHandler;

$run     = new Whoops\Run;
$handler = new PrettyPageHandler;

// Add some custom tables with relevant info about your application,
// that could prove useful in the error page:
// $handler->addDataTable('Killer App Details', array(
//   "Important Data" => $myApp->getImportantData(),
//   "Thingamajig-id" => $someId
// ));

// Set the title of the error page:
$handler->setPageTitle("Whoops! There was a problem.");

$run->pushHandler($handler);

// Add a special handler to deal with AJAX requests with an
// equally-informative JSON response. Since this handler is
// first in the stack, it will be executed before the error
// page handler, and will have a chance to decide if anything
// needs to be done.
if (Whoops\Util\Misc::isAjaxRequest()) {
  $run->pushHandler(new JsonResponseHandler);
}

// Register the handler with PHP, and you're set!
$run->register();

// --- end set up error handling ---

session_start();

require_once('data/database.php');
require_once('models/product_inventory.php');
require_once('models/user.php');
require_once('models/purchases.php');
require_once('controllers/inventory_controller.php');
require_once('controllers/index_controller.php');
require_once('controllers/login_controller.php');
require_once('controllers/report_controller.php');

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
