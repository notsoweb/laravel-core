<?php namespace Notsoweb\LaravelJetstream\Vuejs\Traits;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Inertia\Inertia;
use Inertia\Response;

/**
 * Funciones vue
 * 
 * Conjunto de funciones para automatizar el manejo de rutas de vistas de vue en los 
 * controladores asemejando la forma de llamar a las vistas a la de blade.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
trait Vuew
{
    /**
     * Raíz de las vistas
     */
    protected $vueRoot = '';

    /**
     * Datos que son agregados por otros operadores que serán enviados
     * a la vista de vue.
     */
    protected $otherData = [];

    /**
     * Retorna la vista con el formato requerido por vue.
     */
    public function vuew($view, $data = []) : Response
    {
        $route = (!empty($this->vueRoot))
            ? $this->withRootRoute($view)
            : $this->stringToViewFormat($view);

        return Inertia::render(
            $route,
            array_merge($data, $this->getAllData())
        );
    }

    /**
     * Convierte vista blade a formato vue de inertia
     * 
     * Convierte los puntos y palabras en minúsculas en diagonales
     * y palabras que comienzan su primer letra en mayúscula.
     * 
     * @param string $route Ruta
     */
    private function stringToViewFormat($view)
    {
        $elements = explode('.', $view);
        $route = [];

        foreach ($elements as $element) {
            $route[] = $this->toBladeFormat($element);
        }

        return implode('/', $route);
    }

    /**
     * Convierte vista al formato de vue de inertia
     * 
     * Transforma las palabras con guiones según el estándar de Blade
     * para vistas conformadas por varias palabras a palabras juntas
     * iniciando con mayúsculas usadas en Vue.
     * 
     * @param string $string String a transformar
     * 
     * @return string
     */
    private function toBladeFormat($view) : string
    {
        $elements = explode('-', $view);
        $words = [];

        foreach ($elements as $element) {
            $words[] = ucfirst($element);
        }

        return implode('', $words);
    }

    /**
     * Con una ruta Raíz
     * 
     * Transforma la vista raíz y después la añade a la vista.
     * 
     * @param string $view Vista a transformar
     * 
     * @return string
     */
    private function withRootRoute($view) : string
    {
        $root = $this->stringToViewFormat($this->vueRoot);
        $view = $this->stringToViewFormat($view);

        return $root.'/'.$view;
    }

    /**
     * Agrega otros datos
     * 
     * Es usado cuando en multiples funciones envían recurrente un mismo dato
     * en el mismo controlador.
     * 
     * @param array $data Datos a enviar
     * 
     * @return void
     */
    protected function addOtherData(array $data) : void
    {
        $this->otherData += $data;
    }

    /**
     * Permite añadir la ruta raíz o verla
     * 
     * @param string $root Raíz escrita en el formato blade
     * 
     * @return void
     */
    public function vueRoot($root) : void
    {
        $this->vueRoot = $root;
    }

    /**
     * Obtiene todos las datos independientemente desde donde se hallan registrado
     * 
     * @return array
     */
    protected function getAllData() : array
    {
        if (method_exists($this, 'withOtherData'))
        {
            $this->otherData += $this->withOtherData();
        }

        return $this->otherData;
    }
}