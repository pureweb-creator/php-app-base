<?php

namespace App\Core;

use App\Exceptions\NotAllowedException;
use App\Exceptions\NotFoundException;
use ReflectionException;

class Router
{
    private const HOME_URL = '/home';
    private static array $routes = [];

    private static function createRoute($uri, $action, $method): void
    {
        self::$routes[] = ['uri'=>$uri, 'action'=>$action, 'method'=>$method];
    }

    private static function removeQueryString($uri): array|string|null
    {
        return preg_replace('/\?.*/', '', $uri);
    }

    public static function dispatch($uri, $method): void
    {
        try{
            $methodNotAllowed = true;
            $allowedMethod = '';

            $uri = $uri == '/' ? self::HOME_URL : $uri;
            $uri = self::removeQueryString($uri);

            foreach (self::$routes as $route){
                if ($route['uri']==$uri && $route['method']==$method){

                    if (is_array($route['action'])){
                        self::invokeClassMethod($route['action']);
                    }

                    if (is_callable($route['action'])){
                        self::invokeCallable($route['action']);
                    }

                    return;
                }

                if ($route['uri']==$uri && $route['method']!=$method){
                    $methodNotAllowed = true;
                    $allowedMethod = $route['method'];
                }

                if ($route['uri']!=$uri && $route['method']!=$method){
                    $methodNotAllowed = null;
                }
            }

            if ($methodNotAllowed){
                throw new NotAllowedException("".$allowedMethod);
            }

            throw new NotFoundException();

        } catch (NotFoundException $e) {
            header('HTTP/1.1 404 Not Found');
            echo "<h1>HTTP/1.1 404 Not Found</h1>";
        } catch (NotAllowedException $e) {
            header('HTTP/1.1 405 Method Not Allowed');
            header('Allow: '. $e->getMessage());
            echo "<h1>HTTP/1.1 405 Method Not Allowed</h1>";
        } catch (ReflectionException $e) {}
    }

    /**
     * @throws ReflectionException
     * @throws NotFoundException
     */
    private static function invokeClassMethod($action): void
    {
        list($actionClass, $actionMethod) = $action;

        if (!class_exists($actionClass) || !method_exists($actionClass, $actionMethod))
            throw new NotFoundException();

        $actionClass = new \ReflectionClass($actionClass);
        $actionClassConstructor = $actionClass->getConstructor();
        $actionClassConstructorParams = self::getActionParams($actionClassConstructor);
        $actionClassInstance = $actionClass->newInstanceArgs($actionClassConstructorParams);

        $actionMethod = new \ReflectionMethod($actionClassInstance, $actionMethod);
        $actionMethodParams = self::getActionParams($actionMethod);
        $actionMethod->invokeArgs($actionClassInstance, $actionMethodParams);
    }

    /**
     * @throws ReflectionException
     */
    private static function invokeCallable($action): void
    {
        $actionFunction = new \ReflectionFunction($action);
        $actionFunctionParams = self::getActionParams($actionFunction);
        $actionFunction->invokeArgs($actionFunctionParams);
    }

    private static function getActionParams($action)
    {
        $params = $action->getParameters();

        foreach($params as &$param){
            if (!is_null($param->getType()) && class_exists($param->getType())){
                $obj = $param->getType()->getName();
                $param = new $obj;
            }
            else {
                $param = $param->getName();
            }
        }

        return $params;
    }

    public static function get(string $uri, callable|array|null $action=null): void
    {
        self::createRoute($uri, $action, 'GET');
    }

    public static function post(string $uri, callable|array|null $action=null): void
    {
        self::createRoute($uri, $action, 'POST');
    }
}
