<?php
namespace PHPFramework;

class Application
{
    public string $uri;
    public Request $request;
    public Response $response;
    public Router $router;
    public View $view;
    public static Application $app;

    protected function detectUri(): string
    {
        $serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';
        $isNginx = stripos($serverSoftware, 'nginx') !== false;
        $isApache = stripos($serverSoftware, 'apache') !== false;
        
        if ($isNginx) {
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            
            if (($pos = strpos($uri, '?')) !== false) {
                $uri = substr($uri, 0, $pos);
            }

            return $uri;
        } 
        
        $uri = $_SERVER['QUERY_STRING'] ?? '';
        
        if (empty($uri)) {
            $uri = $_SERVER['REQUEST_URI'] ?? '/';
            
            if (($pos = strpos($uri, '?')) !== false) {
                $uri = substr($uri, 0, $pos);
            }
        }
        
        return $uri;
    }

    public function __construct()
    {
        self::$app = $this;
        $this->uri = $this->detectUri();
        $this->request = new Request($this->uri);
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View(LAYOUT);
    }

    

    public function run(): void{
        echo $this->router->dispatch();
    }

}
