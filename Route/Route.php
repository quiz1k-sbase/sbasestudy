<?php

class Route
{
    private static $routes = [];
    public static $currentRoute;

    public static function init()
    {
        self::$routes = [
            ["url" => "/logout", "controller" => "User", "action" => "logout"],
            ["url" => "/login", "controller" => "User", "action" => "login"],
        ];
    }


}