<?php
/**
 * Created by PhpStorm.
 * User: felix
 * Date: 8/24/2023
 * Time: 8:05 AM
 */
require "../vendor/predis/predis/autoload.php";
 class RedisConnect {
    public function connectRedis(){
        Predis\Autoloader::register();
        $redis = new Predis\Client();

    }
 }