<?php namespace Notsoweb\LaravelJetstream\Vuejs\Traits;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 /**
 * Extensión de los enums
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait ExtendedEnum
{
    /**
     * Obtener todos los casos
     */
    public static function all() : array
    {
        $cases = static::cases();
        $models = [];

        foreach ($cases as $case) {
            $models[] = $case->asModel();
        }

        return $models;
    }

    /**
     * Obtener todos los casos excepto
     */
    public static function allExcept($key)
    {
        $cases = static::cases();
        $models = [];

        foreach ($cases as $case) {
            if($case != $key) {
                $models[] = $case->asModel();
            }
        }

        return $models;
    }
}