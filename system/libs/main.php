<?php
class Main
{
    public $url;
    public $controllerName = "index";
    public $methodName = "index";
    public $controllerPath = "app/controllers/";
    public $controller;

    public function __construct()
    {
        $this->getUrl();
        $this->loadController();
        $this->callMethod();
    }

    // Lấy URL từ request
    public function getUrl()
    {
        $url = isset($_GET['url']) ? $_GET['url'] : NULL;
        if ($url != NULL) {
            $url = rtrim($url, '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            $this->url = $url;
        } else {
            unset($this->url);
        }
    }

    // Tải controller tương ứng
    public function loadController()
    {
        if (isset($this->url[0])) {
            $this->controllerName = $this->url[0];
            $fileName = $this->controllerPath . $this->controllerName . ".php";

            if (file_exists($fileName)) {
                include $fileName;
                
                if (class_exists($this->controllerName)) {
                    $this->controller = new $this->controllerName;
                } else {
                    header("Location: " . BASE_URL . "/index/notfound");
                    exit;
                }
            } else {
                header("Location: " . BASE_URL . "/index/notfound");
                exit;
            }
        } else {
            include $this->controllerPath . $this->controllerName . ".php";
            $this->controller = new $this->controllerName;
        }
    }

    // Gọi method của controller
    public function callMethod()
    {
        if (isset($this->url[1])) {
            $this->methodName = $this->url[1];
            if (isset($this->url[2])) {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}($this->url[2]);
                } else {
                    header("Location: " . BASE_URL . "/index/notfound");
                    exit;
                }
            } else {
                if (method_exists($this->controller, $this->methodName)) {
                    $this->controller->{$this->methodName}();
                } else {
                    header("Location: " . BASE_URL . "/index/notfound");
                    exit;
                }
            }
        } else {
            if (method_exists($this->controller, $this->methodName)) {
                $this->controller->{$this->methodName}();
            } else {
                header("Location: " . BASE_URL . "/index/notfound");
                exit;
            }
        }
    }
}
?>