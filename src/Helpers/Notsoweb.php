<?php
/**
 * Funciones globales
 */

if (!function_exists('arrayToObject')) {
    /**
     * Convertir un array en Objecto
     * 
     * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
     */
    function arrayToObject(array $array) {
        return json_decode(json_encode($array));
    }
}

if (!function_exists('isEnvironment')) {
    /**
     * Verificar entorno de desarrollo
     * 
     * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
     */
    function isEnvironment(string|array $environment) {
        return app()->environment($environment);
    }
}

if (!function_exists('hasPermission')) {
    /**
     * Verificar si el usuario tiene un permiso
     */
    function hasPermission(string $permission) {
        return auth()->user()->hasPermissionTo($permission);
    }
}

if (!function_exists('hasRole')) {
    /**
     * Verificar si el usuario tiene un rol
     */
    function hasRole(string $role) {
        return auth()->user()->hasRole($role);
    }
}