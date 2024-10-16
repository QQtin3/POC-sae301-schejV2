<?php
namespace controller;

class ApplicationController
{
    private static $instance;
    private $routes;

    private function __construct()
    {
        // Sets the controllers and the views of the application.
        $this->routes = [
            "/" => CONTROLLER_DIR . "/MainController.php",
            "error" => CONTROLLER_DIR . "/ErrorController.php",
        ];
    }

    /**
     * Returns the single instance of this class.
     * @return ApplicationController the single instance of this class.
     */
    public static function getInstance(): ApplicationController
    {
        if (!isset(self::$instance)) {
            self::$instance = new ApplicationController();
        }
        return self::$instance;
    }

    private function starts_with($string, $startString): bool
    {
        $len = strlen($startString);
        return substr($string, 0, $len) === $startString;
    }

    function ends_with($string, $endString): bool
    {
        $len = strlen($endString);
        if ($len == 0) {
            return true;
        }
        return substr($string, -$len) === $endString;
    }

    /**
     * Adds a new route in the application.
     * @param String $path the request path.
     * @param String $ctrl the controller that must be called to
     * process the request sent for the path $path.
     * request specified as parameter.
     */
    public function addRoute($path, $ctrl): void
    {
        $filePath = $ctrl;
        // if(!str_ends_with($ctrl, '.php')){
        //     $filePath = $filePath.".php";
        // }
        if (!$this->ends_with($ctrl, ".php")) {
            $filePath = $filePath . ".php";
        }

        if (file_exists($filePath)) {
            $this->routes[$path] = $filePath;
        }
    }

    /**
     * Returns the path of the request
     * @return
     */
    private function request_path(): string
    {
        $request_uri = explode("/", trim($_SERVER["REQUEST_URI"], "/"));
        $script_name = explode("/", trim($_SERVER["SCRIPT_NAME"], "/"));

        $parts = array_diff_assoc($request_uri, $script_name);
        if (empty($request_uri[0])) {
            return "/";
        }
        $path = implode("/", $parts);
        if (($position = strpos($path, "?")) !== false) {
            $path = substr($path, 0, $position);
        }
        return $path;
    }

    private function get_php_classes($php_code): array
    {
        $classes = [];
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if (
                $tokens[$i - 2][0] == T_CLASS &&
                $tokens[$i - 1][0] == T_WHITESPACE &&
                $tokens[$i][0] == T_STRING
            ) {
                $class_name = $tokens[$i][1];
                $classes[] = $class_name;
            }
        }
        return $classes;
    }

    private function file_get_php_classes($filepath): array
    {
        $php_code = file_get_contents($filepath);
        $classes = $this->get_php_classes($php_code);
        return $classes;
    }

    /**
     * Returns the controller that must be called to process the
     * request sent for the path $path.
     * @param String $path
     */
    public function process(): void
    {
        $path = $this->request_path();
        if (array_key_exists($path, $this->routes)) {
            $filePath = $this->routes[$path];
            // if(!str_ends_with($filePath, '.php')){
            //     $filePath = $filePath.".php";
            // }

            if (!$this->ends_with($filePath, ".php")) {
                $filePath = $filePath . ".php";
            }

            require_once $filePath;
            $ctrl_class =
                "controller\\" . $this->file_get_php_classes($filePath)[0];

            $controller = new $ctrl_class();
            switch ($_SERVER["REQUEST_METHOD"]) {
                case "GET":
                    $controller->get($_REQUEST);
                    break;
                case "POST":
                    $controller->post($_REQUEST);
                    break;

                case "PUT":
                    $controller->post($_REQUEST);
                    break;

                case "DELETE":
                    $controller->post($_REQUEST);
                    break;

                default:
                    $controller->get($_REQUEST);
                    break;
            }
        }
        // if (isset($this->routes[$path]) AND is_callable($this->routes[$path])) {
        //     $this->routes[$path]();
        // }
        else {
            $this->routes["error"];
        }
    }
}
?>
