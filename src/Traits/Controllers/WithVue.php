<?php namespace Notsoweb\LaravelCore\Traits\Controllers;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Inertia\Inertia;
use Inertia\Response;

/**
 * Manipulador de vistas vue inertia como si fuera blade
 * 
 * Funciones para automatizar el manejo de rutas de vistas de vue inertia en los 
 * controladores asemejando la forma de llamar las vistas a la de blade.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait WithVue
{
    /**
     * Raíz de las vistas
     */
    protected $root = '';

    /**
     * Propiedades globales
     */
    protected $globalProps = [];

    /**
     * Retornar vista Vue Inertia
     */
    public function view($view, $data = []) : Response
    {
        return Inertia::render(
            component: (!empty($this->root))
                ? $this->stringToViewFormat("{$this->root}.{$view}")
                : $this->stringToViewFormat($view),
            props: array_merge($data, $this->getAllData())
        );
    }

    /**
     * Convertir ruta con notación vista blade a vue inertia
     * 
     * Llamar vistas de vue con inertia, como si de vistas blade se tratase.
     */
    private function stringToViewFormat(string $view) : string
    {
        $elements = explode('.', $view);
        $route = [];

        foreach ($elements as $element) {
            $route[] = $this->toBladeFormat($element);
        }

        return implode('/', $route);
    }

    /**
     * Convertir nombre componente con notación blade a vue inertia
     * 
     * Transforma estándar del nombre de las vistas blade a estándar
     * utilizado por vue inertia.
     */
    private function toBladeFormat(string $view) : string
    {
        $elements = explode('-', $view);
        $words = [];

        foreach ($elements as $element) {
            $words[] = ucfirst($element);
        }

        return implode('', $words);
    }

    /**
     * Agregar dato global
     * 
     * Permite agregar un dato que serán enviados por multiples vistas.
     */
    protected function addGlobalProp(array $data) : void
    {
        $this->globalProps += $data;
    }

    /**
     * Permite añadir la ruta raíz
     * 
     * La ruta base de la raíz es ./resources/js/pages, a partir de ahi se declara
     * (con notación blade) la ruta donde inician las vistas utilizadas por
     * las funciones del controlador.
     * 
     * @return void
     */
    public function root(string $path) : void
    {
        $this->root = $path;
    }

    /**
     * Obtener datos globales
     * 
     * Si se declararon datos globales, se obtiene para enviarlos a la vista.
     * 
     * @return array
     */
    protected function getAllData() : array
    {
        if (method_exists($this, 'globalProps')) {
            $this->globalProps += $this->globalProps();
        }

        return $this->globalProps;
    }
}