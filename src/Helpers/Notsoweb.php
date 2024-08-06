<?php

if (!function_exists('arrayToObject')) {
    /**
     * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
     */
    function arrayToObject(array $array)
    {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('isEnvironment')) {
    /**
     * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
     */
    function isEnvironment(string|array $environment)
    {
        return app()->environment($environment);
    }
}