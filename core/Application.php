<?php
namespace app\core;

class Application{

    public Router $router;
    public Request $request;
    public Response $response;
    public static string $ROOT_DIR;
    public static Application $app; 

    public function __construct(string $rootPath)
    {
        $this->request = new Request();
        $this->response =  new Response();
        $this->router = new Router($this->request, $this->response);
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

    }

    public function run(){
        echo $this->router->resolve();
    }
}