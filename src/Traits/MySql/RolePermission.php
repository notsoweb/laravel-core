<?php namespace Notsoweb\LaravelCore\Traits\MySql;
/**
 * @copyright 2024 Notsoweb (https://notsoweb.com) - All rights reserved.
 */

use Spatie\Permission\Models\Permission;

 /**
 * Permite facilitar el sembrado de permisos
 * 
 * Requiere el paquete Spatie\Permission.
 * 
 * @author Moisés Cortés C. <moises.cortes@notsoweb.com>
 * 
 * @version 1.0.0
 */
trait RolePermission
{
    /**
     * Permite crear un permiso arbitrario
     * 
     * @param string $code Código del permiso que será usado para programar
     */
    protected function onPermission(string $code, string $description, $type = null, $guardName = 'web') : Permission
    {
        return Permission::create([
            'name' => $code,
            'guard_name' => $guardName,
            'description' => $description,
            'permission_type_id' => $type?->id
        ]);
    }
    
    /**
     * Permiso tipo Index
     */
    protected function onIndex($code, $description = 'Mostrar datos', $type = null, $guardName = 'web') : Permission
    {
        return $this->onPermission("{$code}.index", $description, $type, $guardName);
    }
    
    /**
     * Permiso para crear un registro
     */
    protected function onCreate($code, $description = "Crear registros", $type = null, $guardName = 'web') : Permission
    {
        return $this->onPermission("{$code}.create", $description, $type, $guardName);
    }
    
    /**
     * Permiso para editar un registro
     */
    protected function onEdit($code, $description = "Actualizar registro", $type = null, $guardName = 'web') : Permission
    {
        return $this->onPermission("{$code}.edit", $description, $type, $guardName);
    }
    
    /**
     * Permiso para eliminar un registro
     */
    protected function onDestroy($code, $description = "Eliminar registro", $type = null, $guardName = 'web') : Permission
    {
        return $this->onPermission("{$code}.destroy", $description, $type, $guardName);
    }
    
    /**
     * CRUD de permisos
     */
    protected function onCRUD($code, $type = null, $guardName = 'web') : array
    {
        return [
            $this->onIndex(
                code: $code,
                type: $type,
                guardName: $guardName
            ),
            $this->onCreate(
                code: $code,
                type: $type,
                guardName: $guardName
            ),
            $this->onEdit(
                code: $code,
                type: $type,
                guardName: $guardName
            ),
            $this->onDestroy(
                code: $code,
                type: $type,
                guardName: $guardName
            )
        ];
    }
}
