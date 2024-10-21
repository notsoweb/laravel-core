<?php namespace Notsoweb\LaravelCore\Traits;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

 use Illuminate\Routing\Controllers\Middleware;

 /**
 * Permite controlar los permisos de un controlador
 * 
 * Es especialmente util para validar permiso por permiso en los controladores por recursos
 * o todos los por default de una sola vez.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.1
 */
trait WithPermission
{
    /**
     * Nombre del role usado para los permisos
     */
    public $rolePermission = 'default';

    /**
     * Middlewares registrados en el controlador
     */
    protected $middleware = [];

    /**
     * Agregar permiso
     */
    public function addPermission(string $name, $fn = null)
    {
        $this->middleware[] = (new Middleware("permission:{$this->rolePermission}.{$name}"))->only($fn ?? $name);
    }

    /**
     * Permiso de ver la vista principal
     * 
     * @since 1.0.1
     */
    public function withIndexPermission() : void
    {
        $this->addPermission('index');
    }

    /**
     * Permiso de creación
     * 
     * @since 1.0.1
     */
    public function withCreatePermission() : void
    {
        $this->addPermission('create', ['create', 'store']);
    }

    /**
     * Permiso de edición
     * 
     * @since 1.0.1
     */
    public function withEditPermission() : void
    {
        $this->addPermission('edit', ['edit', 'update']);
    }

    /**
     * Permiso de eliminar
     * 
     * @since 1.0.1
     */
    public function withDestroyPermission() : void
    {
        $this->addPermission('destroy',);
    }

    /**
     * Un permiso adicional que se sigue extendiendo de rolePermission
     * 
     * @param string $name Nombre del permiso
     * 
     * @since 1.0.1
     */
    public function withPermission($name) : void
    {
        $this->middleware[] = new Middleware("permission:{$this->rolePermission}.{$name}");
    }

    /**
     * Un permiso arbitrario
     * 
     * @param string $name Nombre del permiso
     * 
     * @since 1.0.1
     */
    public function withOtherPermission($name) : void
    {
        $this->middleware[] = (new Middleware("permission:{$name}"));
    }

    /**
     * Solicita los permisos por default de un CRUD
     * 
     * @param string $rolePermission Permiso raíz
     * 
     * @since 1.0.0 Creación
     * @since 1.0.1 Cambio de nombre de withCRUDPermission
     */
    public function withDefaultPermissions($rolePermission = null) : void
    {
        $this->setRolePermission($rolePermission);

        $this->withIndexPermission();
        $this->withCreatePermission();
        $this->withEditPermission();
        $this->withDestroyPermission();
    }

    /**
     * Obtener los middlewares asignados al controlador
     */
    public function getMiddleware() : array
    {
        return $this->middleware;
    }

    /**
     * Guarda el role
     * 
     * @since 1.0.1
     */
    public function setRolePermission($rolePermission = null) : void
    {
        if ($rolePermission) {
            $this->rolePermission = $rolePermission;
        }
    }
}