<?php namespace Notsoweb\LaravelCore\Supports;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * Notificaciones para inertia
 * 
 * Se genera un error voluntariamente para que inertia lo pueda interpretar como una
 * notificación tipo toast. 
 *
 * El error se recibe dentro del método javascript perteneciente a router del paquete @inertiajs/vue3:
 * onError: (msg) => Notify.fromBack(msg),
 * 
 * Nota: Evitar usar junto con formularios
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
class NotifySupport
{
    /**
     * Notificar error general
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
     * Notificar error especifico
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
     * Notificar advertencia general
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
     * Notificar advertencia especifica
     */
    public static function warningIn(string $key, string $message) : void
    {
        throw new ValidationException(Validator::make([], [
            $key => 'required',
        ], [
            $key => $message,
        ]));
    }

    /**
     * Notificación informativa general
     */
    public static function info($message) : void
    {
        throw new ValidationException(Validator::make([], [
            'errorMessage' => 'required',
            'type' => 'required'
        ], [
            'errorMessage' => $message,
            'type' => 'info'
        ]));
    }

    /**
     * Notificación informativa especifica
     */
    public static function infoIn(string $key, string $message) : void
    {
        throw new ValidationException(Validator::make([], [
            $key => 'required',
        ], [
            $key => $message,
        ]));
    }
}
