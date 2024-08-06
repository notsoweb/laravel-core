<?php namespace Notsoweb\LaravelJetstream\Vue\Controllers;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Illuminate\Routing\Controller;
use Notsoweb\LaravelJetstream\Vuejs\Traits\Vuew;
use Notsoweb\LaravelJetstream\Vuejs\Traits\WithPermission;

/**
 * Controlador orientado a vue
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
abstract class VueController extends Controller
{
    use WithPermission,
        Vuew;
}
