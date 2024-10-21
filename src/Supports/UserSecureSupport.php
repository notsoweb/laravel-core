<?php namespace Notsoweb\LaravelCore\Supports;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use stdClass;

 /**
 * Crea usuarios seguros
 * 
 * Permite crear usuarios en el seeder para que no queden guardadas contraseñas en el
 * git o en alguna parte del código.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.1
 */
class UserSecureSupport
{
    /**
     * Canal donde se guarda el registro
     */
    const LOG_CHANNEL = 'notsoweb:users';

    /**
     * Generar contraseña random para usuario determinado y registrar en el log.
     * 
     * Permite generar una contraseña para cualquier usuario, pero registra la contraseña en un log.
     * 
     * Esto tiene la finalidad de que las contraseñas generadas en los proyectos sean únicas y que
     * no queden plasmadas en el código.
     */
    public static function create(string $email, int $length = 12) : stdClass
    {
        $password = Str::random($length);
 
        Log::channel(self::LOG_CHANNEL)->info("SecurePassword: {$email} => {$password}");

        $hash = bcrypt($password);

        echo "\n  SecurePassword: {$email} => {$password}";
        echo "\n\n";

        return arrayToObject(compact('email', 'hash'));
    }
}
