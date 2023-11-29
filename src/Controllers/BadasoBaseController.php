<?php

namespace Uasoft\Badaso\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Uasoft\Badaso\Events\EntityAdded;
use Uasoft\Badaso\Events\EntityDeleted;
use Uasoft\Badaso\Events\EntityUpdated;
use Uasoft\Badaso\Helpers\ApiResponse;
use Uasoft\Badaso\Helpers\Firebase\FCMNotification;
use Uasoft\Badaso\Helpers\GetData;
use Uasoft\Badaso\Models\DataType;

class BadasoBaseController extends Controller
{
    public function browse(Request $request)
    {
        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $only_data_soft_delete = $request->showSoftDelete == 'true';

            $data = $this->getDataList($slug, $request->all(), $only_data_soft_delete);

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function all(Request $request)
    {
        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $builder_params = [
                'order_field' => isset($request['order_field']) ? $request['order_field'] : $data_type->order_column,
                'order_direction' => isset($request['order_direction']) ? $request['order_direction'] : $data_type->order_direction,
            ];

            if ($data_type->model_name) {
                $records = GetData::clientSideWithModel($data_type, $builder_params);
            } else {
                $records = GetData::clientSideWithQueryBuilder($data_type, $builder_params);
            }

            return ApiResponse::onlyEntity($records);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function read(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required',
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $request->validate([
                'id' => 'exists:'.$data_type->name,
            ]);

            $data = [];

            $data = $this->getDataDetail($slug, $request->id);

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_READ, $table_name);

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function edit(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'data' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $slug = $this->getSlug($request);
                        $data_type = $this->getDataType($slug);
                        $table_entity = DB::table($data_type->name)->where('id', $request->data['id'])->first();
                        if (is_null($table_entity)) {
                            $fail(__('badaso::validation.crud.id_not_exist'));
                        }
                    },
                ],
            ]);

            // get slug by route name and get data type
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            // get data in request, validate, and update data
            $data = $request->input('data');
            $this->validateData($data, $data_type);
            $updated = $this->updateData($data, $data_type);

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            DB::commit();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties([
                    'old' => $updated['old_data'],
                    'attributes' => $updated['updated_data'],
                ])
                ->log($data_type->display_name_singular.' has been updated');

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_UPDATE, $table_name);

            event(new EntityUpdated($data_type, $updated['updated_data'], 'Updated'));

            return ApiResponse::onlyEntity($updated['updated_data']);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function add(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'data' => [
                    'required',
                ],
            ]);

            // get slug by route name and get data type in table
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            // get data from request
            $data = $request->input('data');

            // validate and store data to table
            $this->validateData($data, $data_type);
            $stored_data = $this->insertData($data, $data_type);

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties(['attributes' => $stored_data])
                ->log($data_type->display_name_singular.' has been created');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_CREATE, $table_name);

            event(new EntityAdded($data_type, $stored_data, 'Added'));

            return ApiResponse::onlyEntity($stored_data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $slug = $this->getSlug($request);
                        $data_type = $this->getDataType($slug);
                        $table_entity = DB::table($data_type->name)->where('id', $request->data[0]['value'])->first();

                        if (is_null($table_entity)) {
                            $fail(__('badaso::validation.crud.id_not_exist'));
                        }
                    },
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $is_hard_delete = $request->isHardDelete == 'true';

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);

            $this->deleteData($data, $data_type, $is_hard_delete);

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been deleted');

            DB::commit();

            // add event notification handle
            $table_name = $data_type->name;
            FCMNotification::notification(FCMNotification::$ACTIVE_EVENT_ON_DELETE, $table_name);

            event(new EntityDeleted($data_type, $data, 'Deleted'));

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function restore(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $this->restoreData($data, $data_type);

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been restore');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function deleteMultiple(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                    function ($attribute, $value, $fail) use ($request) {
                        $slug = $this->getSlug($request);
                        $data_type = $this->getDataType($slug);

                        $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
                        $ids = $data['ids'];
                        $id_list = explode(',', $ids);
                        foreach ($id_list as $id) {
                            $table_entity = DB::table($data_type->name)->where('id', $id)->first();
                            if (is_null($table_entity)) {
                                $fail(__('badaso::validation.crud.id_not_exist'));
                            }
                        }
                    },
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $is_hard_delete = $request->isHardDelete == 'true';

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $ids = $data['ids'];
            $id_list = explode(',', $ids);
            foreach ($id_list as $id) {
                $should_delete['id'] = $id;
                $this->deleteData($should_delete, $data_type, $is_hard_delete);
            }

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been bulk deleted');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function restoreMultiple(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
                'data.*.field' => ['required'],
                'data.*.value' => ['required'],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);

            $data = $this->createDataFromRaw($request->input('data') ?? [], $data_type);
            $ids = $data['ids'];
            $id_list = explode(',', $ids);
            foreach ($id_list as $id) {
                $should_delete['id'] = $id;
                $this->restoreData($should_delete, $data_type);
            }

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            activity($data_type->display_name_singular)
                ->causedBy($user_auth ?? null)
                ->withProperties($data)
                ->log($data_type->display_name_singular.' has been bulk deleted');

            DB::commit();

            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function sort(Request $request)
    {
        DB::beginTransaction();

        try {
            $request->validate([
                'slug' => 'required',
                'data' => [
                    'required',
                ],
            ]);

            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);
            $order_column = $data_type->order_column;

            $guard = config('badaso.authenticate.guard');
            $user_auth = Auth::guard($guard)->user();

            if ($data_type->model_name) {
                $model = app($data_type->model_name);
                foreach ($request->data as $index => $row) {
                    $single_data = $model::find($row['id']);
                    $single_data[$order_column] = $index + 1;
                    $single_data->save();

                    activity($data_type->display_name_singular)
                        ->causedBy($user_auth ?? null)
                        ->withProperties(['attributes' => $single_data])
                        ->log($data_type->display_name_singular.' has been sorted');
                }
            } else {
                foreach ($request->data as $index => $row) {
                    $updated_data[$order_column] = $index + 1;
                    DB::table($data_type->name)->where('id', $row['id'])->update($updated_data);

                    activity($data_type->display_name_singular)
                        ->causedBy($user_auth ?? null)
                        ->withProperties(['attributes' => $updated_data])
                        ->log($data_type->display_name_singular.' has been sorted');
                }
            }

            DB::commit();

            return ApiResponse::onlyEntity();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function setMaintenanceState(Request $request)
    {
        DB::beginTransaction();
        try {
            $request->validate([
                'slug' => 'required|exists:Uasoft\Badaso\Models\DataType,slug',
                'is_maintenance' => 'required',
            ]);

            $data_type = DataType::where('slug', $request->slug)->firstOrFail();
            $data_type->is_maintenance = $request->is_maintenance ? 1 : 0;
            $data_type->save();

            DB::commit();

            return ApiResponse::success();
        } catch (Exception $e) {
            DB::rollBack();

            return ApiResponse::failed($e);
        }
    }

    public function getRelationDataBySlug(Request $request)
    {
        try {
            $request->validate([
                'slug' => 'required|exists:Uasoft\Badaso\Models\DataType,slug',
            ]);
            $slug = $request->input('slug', '');
            $page = $request->input('page',1);
            $on_page = 50;
            $skip = $on_page * ($page - 1);
            $search = $request->input('query', '');
            $coluna = $request->input('coluna', false);
             
            $data_type = $this->getDataType($slug);
            $data_rows = $this->dataRowsTypeReplace($data_type->dataRows);
            $data = [];
            $relational_rows = collect($data_rows)->filter(function ($value, $key) {
                return $value->relation != null;
            })->all();

            foreach ($relational_rows as $key => $field) {
                $relation_detail = [];

                try {
                    $relation_detail = is_string($field->relation) ? json_decode($field->relation) : $field->relation;
                    $relation_detail = CaseConvert::snake($relation_detail);
                } catch (\Exception $e) {
                }

                $relation_type = array_key_exists('relation_type', $relation_detail) ? $relation_detail['relation_type'] : null;
                $destination_table = array_key_exists('destination_table', $relation_detail) ? $relation_detail['destination_table'] : null;
                $destination_table_column = array_key_exists('destination_table_column', $relation_detail) ? $relation_detail['destination_table_column'] : null;
                $destination_table_display_column = array_key_exists('destination_table_display_column', $relation_detail) ? $relation_detail['destination_table_display_column'] : null;
                $destination_table_display_more_column = array_key_exists('destination_table_display_more_column', $relation_detail) ? $relation_detail['destination_table_display_more_column'] : [];
                $modelRelation = array_key_exists('model', $relation_detail) ? $relation_detail['model'] : null;
                
                if ( $destination_table_display_column==$coluna) {
                    
                    if (isset($destination_table_display_more_column)) {
                        $destination_table_display_more_column =
                         is_string($destination_table_display_more_column) ? 
                         json_decode($destination_table_display_more_column) : $destination_table_display_more_column;
                    }
    
                    if (
                        $relation_type
                        && $destination_table
                        && $destination_table_column
                        && $destination_table_display_column
                    ) {
                        if (isset($modelRelation)) {
                           try {
                            $model = app($modelRelation);
                            $query = $model->query();
                            $details =null;
                            if (isset($field->details)) {
                                $details = is_string($field->details) ? json_decode($field->details) : $field->details;
                            }
    
                            $culunas = array_merge(
                                [
                                    $destination_table_column,
                                    $destination_table_display_column,
                                ], 
                                $destination_table_display_more_column
                            );
                             
                            if (isset($details) && isset($details->scope) && $details->scope != '' &&
                                method_exists($model, 'scope'.ucfirst($details->scope))) {
                                
                                $relation_data = $query->{$details->scope}()
                                    ->select($culunas)->take($on_page)->skip($skip)
                                    ->where($coluna, 'LIKE', '%' . $search . '%')->get();
                                $result = collect($relation_data);
                                $data = $result->map(function ($res) use ($destination_table_column, $destination_table_display_column) {
                                        $item = $res;
                                        $item->value = $res->{$destination_table_column};
                                        $item->label = $res->{$destination_table_display_column};
     
                                        return $item;
                                    }
                                )->toArray();
    
    
                            }else{
                                $result = collect($query ->select($culunas)->take($on_page)->skip($skip)
                                ->where($coluna, 'LIKE', '%' . $search . '%')->get());
                                $data = $result->map(function ($res) use ($destination_table_column, $destination_table_display_column) {
                                    $item = $res;
                                    $item->value = $res->{$destination_table_column};
                                    $item->label = $res->{$destination_table_display_column};
                    
                                    return $item;
                                })->toArray();
                            }
                           } catch (\Throwable $th) {
                             
                           }
                        } else {
                            $culunas = [
                                $destination_table_column,
                                $destination_table_display_column,
                            ];
    
                            $relation_data = DB::table($destination_table)->select(
                                array_merge($culunas, $destination_table_display_more_column)
                            )->take($on_page)->skip($skip)
                            ->where($coluna, 'LIKE', '%' . $search . '%')->get();
                            $result = collect($relation_data);
                            $data = $result->map(function ($res) use ($destination_table_column, $destination_table_display_column) {
                                $item = $res;
                                $item->value = $res->{$destination_table_column};
                                $item->label = $res->{$destination_table_display_column};
    
                                return $item;
                            })->toArray();
                        }
                    } 
                }
            }

            return ApiResponse::success($data);
        } catch (Exception $e) {
            return APIResponse::failed($e);
        }
    }

    public function relation(Request $request) {
       

        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);
            $page = $request->input('page');
            $on_page = 50;
            $search = $request->input('query', false);
            $coluna = $request->input('coluna', false);
             
             
            $model = app($data_type->model_name);
            $skip = $on_page * ($page - 1);
    
            // If search query, use LIKE to filter results depending on field label
            if (isset($search)) {
                
                if ($request->tipo!=null && $request->tipo!='null' ) {
                    $total_count = $model->{$request->tipo}()->where($coluna, 'LIKE', '%' . $search . '%')->count();
                    $relationshipOptions = $model->{$request->tipo}()->take($on_page)->skip($skip)
                    ->where($coluna, 'LIKE', '%' . $search . '%')->get();
                } else {
                    $total_count = $model->where($coluna, 'LIKE', '%' . $search . '%')->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)
                    ->where($coluna, 'LIKE', '%' . $search . '%')->get();
                }
                
            } else {

                if ($request->tipo!=null && $request->tipo!='null') {
                    $total_count = $model->{$request->tipo}()->count();
                    $relationshipOptions = $model->{$request->tipo}()->take($on_page)->skip($skip)->get();
                } else {
                    $total_count = $model->count();
                    $relationshipOptions = $model->take($on_page)->skip($skip)->get();
                }
            }
    
            $results = [];
    
    
    
            foreach ($relationshipOptions as $relationshipOption) {
                $results[] = [
                    'id' => $relationshipOption->id,
                    $coluna => $relationshipOption->{$coluna},
                    'dados' => $relationshipOption,
                ];
            }
    
            return response()->json([
                        'data' => $results,
                        'pagination' => [
                            'more' => ($total_count > ($skip + $on_page)),
                        ],
            ]);

        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function isexiste(Request $request) {
        
        try {
            $slug = $this->getSlug($request);
            $data_type = $this->getDataType($slug);
            $search = $request->input('query', false);
            $coluna = $request->input('coluna', false);
            $id = $request->input('id', false);
            $total_count =null;
             
            $model = app($data_type->model_name);
             
            // If search query, use LIKE to filter results depending on field label
            if (isset($search)) {
                $total_count = $model->{$request->tipo}()->where($coluna, $search )->get();
            } 

            $resposta = false;
            if (isset($total_count) && $total_count->count()) {
                $resposta = true;
                if($id && $resposta) $resposta = ($id==$total_count->id)? false:true;
            }  
            
     
            return response()->json([
                'data' => $resposta,      
            ]);
  
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function isremove(Request $request) {
        
        try {
            $resposta = true;
             
            return response()->json([
                'data' => $resposta,      
            ]);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }

    public function info(Request $request)
    {
        try {
            $data = "Emplemetra estecmetodo mano ";
            return ApiResponse::onlyEntity($data);
        } catch (Exception $e) {
            return ApiResponse::failed($e);
        }
    }
}
