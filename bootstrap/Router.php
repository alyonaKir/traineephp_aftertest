<?php

namespace Bootstrap;

class Router
{
    private const REGEXES = ['[0-9]+', '[a-z]+'];

    public array $routeCollection;

    public array $args = [];

    public function run(): void
    {
        $urlParts = parse_url($_SERVER['REQUEST_URI']);
        $isMatched = false;

        foreach ($this->routeCollection[$_SERVER['REQUEST_METHOD']] as $route) {
            $isMatched = preg_match("/^" . str_replace('/', '\/', $route['uri']) . "$/", rtrim($urlParts['path'], '/'));

            if ($isMatched) {
                $this->setPostBody();
                $this->callMethod($route, $urlParts);
                break;
            }
        }

        if (!$isMatched) {
            echo '404 not Found';
        }
    }

    private function setPostBody(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = file_get_contents('php://input');
            $data = json_decode($data, true);
            if ($data != NULL) {
                foreach ($data as $key => $value) {
                    $_POST[$key] = $value;
                }
            }
        }
    }

    private function callMethod(array $route, array $urlParts): void
    {
        $segments = explode('/', $route['uri']);

        foreach ($segments as $segmentKey => $segment) {
            if (in_array($segment, self::REGEXES)) {
                $uriSegments = explode('/', $urlParts['path']);
                $this->args[] = $uriSegments[$segmentKey];
            }
        }

        $route['callback'](...$this->args);
    }

    public function post(string $uri, callable $callback): void
    {
        $this->add('POST', $uri, $callback);
    }

    public function get(string $uri, callable $callback): void
    {
        $this->add('GET', $uri, $callback);
    }

    public function put(string $uri, callable $callback): void
    {
        $this->add('PUT', $uri, $callback);
    }

    public function delete(string $uri, callable $callback): void
    {
        $this->add('DELETE', $uri, $callback);
    }

    public function patch(string $uri, callable $callback): void
    {
        $this->add('PATCH', $uri, $callback);
    }

    public function add(string $method, string $uri, callable $callback): void
    {
        $this->routeCollection[$method][] = ['uri' => $uri, 'callback' => $callback];
    }
}