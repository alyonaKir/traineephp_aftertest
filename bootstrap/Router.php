<?php

class Router
{
    private array $handlers;
    private $notFoundHandler;
    public function get(string $path, $handler) : void{
        $this->addHandler($path, 'GET', $handler);
    }
    public function post(string $path, $handler) : void{
        $this->addHandler($path, 'POST', $handler);
    }
    private function addHandler($path, $method, $handler): void{
        $this->handlers[$method.$path] =[
            'path' => $path,
            'method' => $method,
            'handler' => $handler,
        ];
    }
    public function addNotFoundHandler($handler){
        $this->notFoundHandler = $handler;
    }

    public function run(){
        $request_uri = parse_url($_SERVER['REQUEST_URI']);
        $request_path = $request_uri['path'];
        $method = $_SERVER['REQUEST_METHOD'];
        $callback = null;
        foreach ($this->handlers as $handler){
            if($handler['path'] === $request_path && $method === $handler['method']){
                $callback = $handler['handler'];
            }
        }
            if(!$callback){
                header("HTTP/1.0 404 Not Found");
                if(!empty($this->notFoundHandler)){
                    $callback = $this->notFoundHandler;
                }
            }
        call_user_func_array($callback, [
            array_merge($_GET, $_POST)
        ]);
    }
}