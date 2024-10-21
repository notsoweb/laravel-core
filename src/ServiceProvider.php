<?php namespace Notsoweb\LaravelCore;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Composer\InstalledVersions;
use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider as LaravelServiceProvider;

/**
 * Proveedor de servicio
 * 
 * Permite registrar el paquete dentro de laravel para usar funciones precargadas.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
class ServiceProvider extends LaravelServiceProvider
{
    /**
     * Versión de aplicación
     */
    const VERSION = '0.0.1';

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerAbout();
    }

    /**
     * Servicios registrados
     *
     * @return void
     */
    public function register()
    {
        $this->config();
    }

    /**
     * Fusiona las configuraciones
     */
    private function config()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/logging/channels.php', 'logging.channels'
        );
    }

    /**
     * Detalles del paquete
     */
    public function registerAbout() : void
    {
        AboutCommand::add('Notsoweb\\LaravelCore', fn () => [
            'Version' => InstalledVersions::getPrettyVersion('notsoweb/LaravelCore')
        ]);
    }
}
