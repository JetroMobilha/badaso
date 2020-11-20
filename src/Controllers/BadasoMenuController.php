<?php

namespace Uasoft\Badaso\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Models\Menu;
use Uasoft\Badaso\Models\MenuItem;

class BadasoMenuController extends Controller
{
    public function browseMenu(Request $request)
    {
        try {
            $menus = Menu::all();

            return ApiResponse::success(collect($menus)->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function readMenu(Request $request)
    {
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
            ]);
            $menu = Menu::find($request->menu_id);

            return ApiResponse::success($menu);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function browseMenuItem(Request $request)
    {
        try {
            $request->validate([
                'menu_id' => ['required'],
            ]);

            $menu_items = MenuItem::where('menu_id', $request->menu_id)->orderBy('order', 'asc')->get();

            return ApiResponse::success(collect($menu_items)->toArray());
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function readMenuItem(Request $request)
    {
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'menu_item_id' => ['required', 'exists:menu_items,id'],
            ]);

            $menu_items = MenuItem::where('menu_id', $request->menu_id)->where('id', $request->menu_item_id)->first();

            return ApiResponse::success($menu_items);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function addMenu(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'key' => ['required', 'unique:menus'],
                'display_name' => ['required'],
            ]);

            $new_menu = new Menu();
            $new_menu->key = $request->get('key');
            $new_menu->display_name = $request->get('display_name');
            $new_menu->save();

            DB::commit();

            return ApiResponse::success($new_menu);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function addMenuItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'title' => ['required'],
                'url' => ['required'],
                'target' => ['required'],
            ]);

            $new_menu_item = new MenuItem();
            $new_menu_item->menu_id = $request->get('menu_id');
            $new_menu_item->title = $request->get('title');
            $new_menu_item->url = $request->get('url');
            $new_menu_item->target = $request->get('target');
            $new_menu_item->icon_class = $request->get('icon_class');
            $new_menu_item->color = $request->get('color');
            $new_menu_item->parent_id = $request->get('parent_id');
            $new_menu_item->order = $request->get('order');
            $new_menu_item->save();

            DB::commit();

            return ApiResponse::success($new_menu_item);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function editMenu(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'key' => ['required', "unique:menus,id,{$request->menu_id}"],
                'display_name' => ['required'],
            ]);

            $menu = Menu::find($request->menu_id);
            $menu->key = $request->get('key');
            $menu->display_name = $request->get('display_name');
            $menu->save();

            DB::commit();

            return ApiResponse::success($menu);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function editMenuItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'menu_item_id' => ['required', 'exists:menu_items,id'],
                'title' => ['required'],
                'url' => ['required'],
            ]);

            $menu_item = MenuItem::find($request->menu_item_id);
            $menu_item->menu_id = $request->get('menu_id');
            $menu_item->title = $request->get('title');
            $menu_item->url = $request->get('url');
            $menu_item->target = $request->get('target');
            $menu_item->icon_class = $request->get('icon_class');
            $menu_item->color = $request->get('color');
            $menu_item->parent_id = $request->get('parent_id');
            $menu_item->order = $request->get('order');
            $menu_item->save();

            DB::commit();

            return ApiResponse::success($menu_item);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function editMenuItemOrder(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'menu_item_id' => ['required', 'exists:menu_items,id'],
            ]);
            $menu_item = MenuItem::find($request->menu_item_id);
            $order = $request->get('order');

            $old_order = $menu_item->order;
            $new_order = $order;

            if (is_null($old_order)) {
                $old_order = 0;
            }

            if ($new_order > $old_order) {
                $menu_items = MenuItem::where('order', '<=', $new_order)
                    ->where('order', '>', $old_order)
                    ->where('menu_id', $request->menu_id)
                    ->get();
                foreach ($menu_items as $item) {
                    $other_menu_item = MenuItem::find($item->id);
                    $other_menu_item->order = $other_menu_item->order - 1;
                    $other_menu_item->save();
                }
            } else {
                $menu_items = MenuItem::where('order', '>=', $new_order)
                    ->where('order', '<', $old_order)
                    ->where('menu_id', $request->menu_id)
                    ->get();
                foreach ($menu_items as $item) {
                    $other_menu_item = MenuItem::find($item->id);
                    $other_menu_item->order = $other_menu_item->order + 1;
                    $other_menu_item->save();
                }
            }

            $menu_item->order = $order;
            $menu_item->save();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMenu(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
            ]);

            Menu::find($request->menu_id)->delete();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMenuItem(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'menu_id' => ['required', 'exists:menus,id'],
                'menu_item_id' => ['required', 'exists:menu_items,id'],
            ]);

            MenuItem::find($request->menu_item_id)->delete();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }
}