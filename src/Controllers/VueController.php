<?php namespace Notsoweb\LaravelCore\Controllers;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use App\Http\Controllers\Controller;
use Notsoweb\LaravelCore\Traits\Controllers\WithVue;
use Notsoweb\LaravelCore\Traits\WithPermission;

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
        WithVue;
}
