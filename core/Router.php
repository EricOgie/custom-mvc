<?php

namespace app\core;

class Router{

    public Request $request;
    public Response $response;
    protected array $routes = [];

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get($path, $callback)
    {
        // Here, 'get' is the request method
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        // Here, 'get' is the request method
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {  
       
        // Retrieve essentials from the super global Server array
        $requestPath = $this->request->getPath();
        $requestMethod = $this->request->getMethod();

        // To know the callback to execute, we get the matching callback to the requested path.
        $callback = $this->routes[$requestMethod][$requestPath] ?? false;

        if($callback)
        {
            
            if (is_string($callback)) {
                return $this->renderView($callback);
            }

            $executableCallback = $callback;

            if(is_array($callback)){
                $controllerClass = $callback[0];
                $executableCallback = [new $controllerClass(), $callback[1]];
            }

            return call_user_func($executableCallback, $this->request);

        }else{

            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }
  
    }

    public function renderView($view, $params = [])
    {

        $layout = $this->layoutContent();
        $view = $this->renderOnlyView($view, $params);
        return str_replace("{{content}}", $view, $layout);

    }

    protected function renderOnlyView($view, $params)
    {

        foreach ($params as $key => $value) {
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";
        return ob_get_clean();
    }
    
}