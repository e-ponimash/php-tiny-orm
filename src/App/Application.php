<?php
namespace App;

use App\Controller\UserServiceController;


/**
 * Базовый класс приложения
 * @package App
 */
class Application{
    private static $instance = null;

    private $requestMethod = null;
    private $requestBody = null;
    private $config = array();

    /**
     * Application constructor.
     * @param $config
     */
    private function __construct($config)
    {
        $this->config = $config;
    }

    public function configRoutes()
    {
        $userService = new UserServiceController();

        Router::addRoute('^/users/(\d+)$', [$userService, 'findUser'], 'GET');
    }

    public static function getInstance($config = null)
    {
        if (null === self::$instance)
        {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public function getConfig(){
        return $this->config;
    }

    /**
     * Точка входа
     */
    public function run(){
        $uri = preg_replace('/^([^?]+)(\?.*?)?(#.*)?$/', '$1$3', $_SERVER['REQUEST_URI']);
        $this->setRequestBody();
        Router::execute($this->requestMethod, $uri);
    }

    /**
     * Разбор тела запроса
     * @param $params
     */
    private function setRequestBody(){
        $this->requestMethod = $_SERVER['REDIRECT_REQUEST_METHOD'];
        if( !isset($this->requestMethod) ){
            $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        }

        if($this->requestMethod == 'PUT') {
            $body = file_get_contents('php://input');
            $this->requestBody = json_decode($body);
        }
    }

    /**
     * Получить тело запроса
     * @param $name
     * @return mixed
     */
    public function getRequestBody(){
        return $this->requestBody;
    }

}