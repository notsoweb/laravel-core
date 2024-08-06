<?php namespace Notsoweb\LaravelJetstream\Vuejs\Support;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

 /**
 * Notificaciones Vuejs
 * 
 * Genera un error de validación que puede ser interpretado como una notificación.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
class VueNotify
{
    /**
     * Notifica un error
     * 
     * El error se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * La variable puede variar si se desea.
     * 
     * Importante: No usar junto a los formularios.
     */
    public static function error(string $message) : void
    {
        throw new ValidationException(Validator::make([], [
            'errorMessage' => 'required',
            'type' => 'required'
        ], [
            'errorMessage' => $message,
            'type' => 'error'
        ]));
    }

    /**
     * Notifica un error especifico
     * 
     * El error se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * Importante: No usar junto a los formularios.
     */
    public static function errorIn(string $key, string $message) : void
    {
        throw new ValidationException(Validator::make([], [
            $key => 'required',
        ], [
            $key => $message,
        ]));
    }

    /**
     * Notifica una advertencia
     * 
     * Se genera un error voluntariamente para que inertia lo pueda interpretar mandando
     * un notificación tipo toast. 
     *
     * La advertencia se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * La variable puede variar si se desea.
     * 
     * Importante: No usar junto a los formularios.
     * 
     * @param string $message Mensaje de advertencia
     * @param string $varName Variable que se recibirá en el front para el error
     */
    public static function warning($message) : void
    {
        throw new ValidationException(Validator::make([], [
            'errorMessage' => 'required',
            'type' => 'required'
        ], [
            'errorMessage' => $message,
            'type' => 'warning'
        ]));
    }

    /**
     * Notifica una advertencia especifica
     * 
     * La advertencia se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
     * onError: (e) => Notify.fromBack(e),
     * 
     * Importante: No usar junto a los formularios.
     */
    public static function warningIn(string $attribute, string $message) : void
    {
        throw new ValidationException(Validator::make([], [
            $attribute => 'required',
        ], [
            $attribute => $message,
        ]));
    }
}
