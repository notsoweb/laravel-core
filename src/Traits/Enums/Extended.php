<?php namespace Notsoweb\LaravelCore\Traits\Enums;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Collection;

 /**
 * Extensión de los enums
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait Extended
{
    /**
     * Obtener todos los casos
     * 
     * Retorna todos los casos en una matrix
     */
    public static function all(string $sort = 'name') : Collection
    {
        $cases = static::cases();
        $models = new Collection();

        foreach ($cases as $case) {
            $models->push($case->asModel());
        }

        return $models->sortBy($sort)->values();
    }

    /**
     * Obtener todos excepto coincidencias
     */
    public static function allExcept(array $keys = [], string $sort = 'name') : Collection
    {
        $cases = static::cases();
        $models = new Collection();

        foreach ($cases as $case) {
            if(!in_array($case, $keys)) {
                $models->push($case->asModel());
            }
        }

        return $models->sortBy($sort)->values();
    }

    /**
     * Obtener array de valores
     */
    public static function values() : array
    {
        return array_map(fn($case) => $case->value, static::cases());
    }
}