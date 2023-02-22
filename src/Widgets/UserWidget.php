<?php

namespace Uasoft\Badaso\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;
use Uasoft\Badaso\Models\User;
use WeakReference;

class UserWidget implements WidgetInterface
{
    /**
     * Set permission for widget
     * set null to allow all role
     * multiple permission allowed, separate by comma.
     */
    public function getPermissions()
    {
        return 'browse_users';
    }

    public function getType(): string
    {
        return  WidgetInterface::PADRAO;
    }

    public function run($params = null)
    {
        return [
            'type' => $this->getType(),
            'label' => 'User',
            'icon' => 'person',
            'value' => User::count(),
        ];
    }
}
