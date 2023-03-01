<?php

namespace Uasoft\Badaso\Controllers;

use Exception;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\AuthenticatedUser;
use Uasoft\Badaso\Interfaces\WidgetInterface;
use Illuminate\Http\Request;

class BadasoDashboardController extends Controller
{
    public function index()
    {
        try {
            $widgets = config('badaso.widgets');
            $data = [];
            foreach ($widgets as $widget) {
                $widget_class = new $widget();
                if ($widget_class instanceof WidgetInterface) {
                    $permissions = $widget_class->getPermissions();
                    if (is_null($permissions)) {
                        $widget_data = $widget_class->run();
                        $data[] = $widget_data;
                    } else {
                        $allowed = AuthenticatedUser::isAllowedTo($permissions);
                        if ($allowed) {
                            $widget_data = $widget_class->run();
                            $data[] = $widget_data;
                        }
                    }
                }
            }

            return ApiResponse::success(collect($data)->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function getDataWidget(Request $request)
    {
        try {
            $widgets = config('badaso.widgets');
            $data = [];
            foreach ($widgets as $widget) {
                $widget_class = new $widget();
                if ($widget_class instanceof WidgetInterface && isset($request->nome) && $widget_class->getNome()==$request->nome ) {
                    $permissions = $widget_class->getPermissions();
                    if (is_null($permissions)) {
                        $data[] = $widget_class->getDados();
                    } else {
                        $allowed = AuthenticatedUser::isAllowedTo($permissions);
                        if ($allowed) {
                            $data[] = $widget_class->getDados();
                        }
                    }
                }
            }

            return ApiResponse::success(collect($data)->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function manifest()
    {
        $pwa_manifest = config('badaso.manifest');

        return response($pwa_manifest, 200, [
            'Content-Type' => 'application/json',
        ]);
    }
}
