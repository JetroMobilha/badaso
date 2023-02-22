<?php

namespace Uasoft\Badaso\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;
use Uasoft\Badaso\Models\Permission;

class PermissionWidget implements WidgetInterface
{
    /**
     * Set permission for widget
     * set null to allow all role
     * multiple permission allowed, separate by comma.
     */
    public function getPermissions()
    {
        return 'browse_permissions';
    }

    public function getType(): string
    {
        return  WidgetInterface::PADRAO;
    }

    public function run($params = null)
    {
        return [
            'type' => $this->getType(),
            'label' => 'Permission',
            'icon' => 'lock',
            'value' => Permission::count(),
        ];
    }
}
