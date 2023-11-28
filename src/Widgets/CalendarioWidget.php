<?php

namespace Uasoft\Badaso\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;

use Exception;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

use Uasoft\Badaso\Facades\Badaso;

use Uasoft\Badaso\Models\Grupo;
use Uasoft\Badaso\Helpers\GetData;

use Illuminate\Support\Facades\Auth;

class CalendarioWidget implements WidgetInterface
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
        return  WidgetInterface::CALENDARIO;
    }

    public function getTabela(): string
    {
        return 'caleventos';
    }

    public function getModel($model)
    {
        return  $model->whereIn('id',function($query){
            $query->select('caleventos_id')->from('user_caleventos')->where('badaso_users_id',auth()->id());
        })->orWhere('autor',auth()->id());   
    }

    public function getNome():string{
        return  'calendario';
    }

    public function getNomeDisplay():string{
        return 'Calendário';
    }

    public function getLimit(){return 0;}

    public function getPage(){return 1;}

    public function getOrderField(){return '';}

    public function getOrderDirection(){return '';}

    public function run($params = null)
    {
        return [
            'type' => $this->getType(),
            'nome' => $this->getNome(),
            'label' => $this->getNomeDisplay(),
            'table' => $this->getTabela(),
            'icon' => 'person',
        ];
    }

    public function getDados() 
    {
        // get data type by slug
        $data_type = Badaso::model('DataType')::where('slug', $this->getTabela())->first();
        $data_type->data_rows = $data_type->dataRows;

        $builder_params = [
            'limit'           => $this->getLimit()> 0 ? $this->getLimit() :4,
            'page'            => $this->getPage()> 1 ? $this->getPage() : 1,
            'order_field'     => empty($this->getOrderField()) ? $this->getOrderField() : $data_type->order_column,
            'order_direction' => empty($this->getOrderDirection()) ? $this->getOrderDirection() : $data_type->order_direction,
            'filter_key'      =>  null,
            'filter_operator' => 'containts',
            'filter_value'    => '',
        ];

        $data_rows = collect($data_type->dataRows);
        $fields = collect($data_type->dataRows)->pluck('field')->all();
        $field_manytomany = [];

        foreach ($data_rows as $key => $data_row) {
            if (isset($data_row['relation']) && $data_row['relation']['relation_type'] == 'belongs_to_many') {
                $field_manytomany[] = $data_row['field'];
            }
        }

        $fields = array_diff($fields, $field_manytomany);

        $ClassNome = $data_type->model_name;
        $model = new  $ClassNome();
        $order_field = $builder_params['order_field'];
        $order_direction = $builder_params['order_direction'];

        $records = [];

        if ($order_field) {
            $data = $model::query()->select($fields)->orderBy($order_field, $order_direction);
        } else {
            $data = $model::query()->select($fields);
        }
        // soft delete implement
        $is_soft_delete = $data_type->is_soft_delete;

        if ($is_soft_delete) {
            $data = $data->whereNotNull('deleted_at');
        }
        // end

        $data = $this->getModel($data);
        $data = $data->get();

        foreach ($data as $row) {
            $class = new ReflectionClass(get_class($row));
            $class_methods = $class->getMethods();

            $record = $row;
            foreach ($class_methods as $class_method) {
                if ($class_method->class == $class->name) {
                    try {
                        $record->{$class_method->name} = json_decode(json_encode($row->{$class_method->name}));
                    } catch (Exception $e) {
                        // $record->{$class_method->name} = json_decode(json_encode($row->{$class_method->name}()));
                    }
                }
            }
            $records[] = GetData::getRelationData($data_type, $record);
        }

        // add field data form table polymoriphims
        $records = collect($records)->map(function ($record) use ($data_rows) {
            foreach ($data_rows as $index => $data_row) {
                if (isset($data_row->relation) && $data_row->relation['relation_type'] == 'belongs_to_many') {
                    $table_manytomany = $data_row['field'];
                    $data_relation = DB::table($table_manytomany)
                        ->get();
                    $record->$table_manytomany = $data_relation;
                }
            }

            return $record;
        });

        $retorno = [];
        foreach ($records as $row) {
            $retorno[] = GetData::getRelationData($data_type, $row);
        }

        $data =[];
        $splits =[];

        foreach ($retorno as $row) {

            $reto['id'] =$row->id; 
            $reto['start'] =$row->data_inicio; 
            $reto['end'] =$row->data_fim;
            $reto['title'] =$row->nome;
            $reto['model'] =$row->models;
            $reto['class'] =$this->getClass($row->status); 
            $data[] = $reto;
        }

        $useres = $this->getUsers();
        if (count($useres)> 0) {
            $contClass = 0;
            $prop['id'] =1; 
            $prop['class'] = $this->getClassUser($contClass);
            $prop['label'] ='você';
            
            $contClass=$contClass+1;
             
            $splits[] = $prop;
           $data = array_map(function($value){
              $value['split']=1;
            return  $value;
           },$data);

            foreach ($useres as  $key=>$user) {

                $sub['id'] =($key + 2); 
                $sub['class'] =$this->getClassUser($contClass);

                if ($this->getClassUser($contClass)=='cla2') {
                    $contClass=0;
                } else {
                    $contClass=$contClass+1;
                }

                $sub['label'] =$user->username;
                $splits[] = $sub;
                 $eventoUser = $this->getEventosUser($user->id);

                 foreach ($eventoUser as $value) {
                    $value['split']=($key + 2);
                    $data[] = $value;
                }
            }
        }

        $entities['data'] = $data;
        $entities['splits'] = $splits;
         
        return $entities;
    }

    public function isDados(){
        return null;
    }

    public function getEventosUser($id) 
    {
        // get data type by slug
        $data_type = Badaso::model('DataType')::where('slug', $this->getTabela())->first();
        $data_type->data_rows = $data_type->dataRows;

        $builder_params = [
            'limit'           => $this->getLimit()> 0 ? $this->getLimit() :4,
            'page'            => $this->getPage()> 1 ? $this->getPage() : 1,
            'order_field'     => empty($this->getOrderField()) ? $this->getOrderField() : $data_type->order_column,
            'order_direction' => empty($this->getOrderDirection()) ? $this->getOrderDirection() : $data_type->order_direction,
            'filter_key'      =>  null,
            'filter_operator' => 'containts',
            'filter_value'    => '',
        ];

        $data_rows = collect($data_type->dataRows);
        $fields = collect($data_type->dataRows)->pluck('field')->all();
        $field_manytomany = [];

        foreach ($data_rows as $data_row) {
            if (isset($data_row['relation']) && $data_row['relation']['relation_type'] == 'belongs_to_many') {
                $field_manytomany[] = $data_row['field'];
            }
        }

        $fields = array_diff($fields, $field_manytomany);

        $ClassNome = $data_type->model_name;
        $model = new  $ClassNome();
        $order_field = $builder_params['order_field'];
        $order_direction = $builder_params['order_direction'];

        $records = [];

        if ($order_field) {
            $data = $model::query()->select($fields)->orderBy($order_field, $order_direction);
        } else {
            $data = $model::query()->select($fields);
        }
        // soft delete implement
        $is_soft_delete = $data_type->is_soft_delete;

        if ($is_soft_delete) {
            $data = $data->whereNotNull('deleted_at');
        }
        // end

        $data->whereIn('id',function($query) use($id){
            $query->select('caleventos_id')->from('user_caleventos')->where(config('badaso.database.prefix').'users_id',$id);
        })->orwhere('autor',$id);
    
        $data = $data->get();

        foreach ($data as $row) {
            $class = new ReflectionClass(get_class($row));
            $class_methods = $class->getMethods();

            $record = $row;
            foreach ($class_methods as $class_method) {
                if ($class_method->class == $class->name) {
                    try {
                       // $record->{$class_method->name} = json_decode(json_encode($row->{$class_method->name}));
                    } catch (Exception $e) {
                        // $record->{$class_method->name} = json_decode(json_encode($row->{$class_method->name}()));
                    }
                }
            }
            $records[] = GetData::getRelationData($data_type, $record);
        }

        // add field data form table polymoriphims
        $records = collect($records)->map(function ($record) use ($data_rows) {
            foreach ($data_rows as $index => $data_row) {
                if (isset($data_row->relation) && $data_row->relation['relation_type'] == 'belongs_to_many') {
                    $table_manytomany = $data_row['field'];
                    $data_relation = DB::table($table_manytomany)
                        ->get();
                    $record->$table_manytomany = $data_relation;
                }
            }

            return $record;
        });

        $retorno = [];
        foreach ($records as $row) {
            $retorno[] = GetData::getRelationData($data_type, $row);
        }

        $data =[];

        foreach ($retorno as $row) {

            $reto['id'] =$row->id; 
            $reto['start'] =$row->data_inicio; 
            $reto['end'] =$row->data_fim;
            $reto['title'] =$row->nome;
            $reto['model'] =$row->models;
            $reto['class'] =$this->getClass($row->status);
            $data[] = $reto;
        }

        return $data;
    }

    public function getUsers() 
    {
        $users = [];
        $grupos = Grupo::where('responsavel',auth()->id())->get();

       foreach ($grupos as $grupo) {
        foreach ($grupo->users as $user) {
            $users[]= $user;
        }
       }

       return $users;
    }

    public function getClass($status) 
    {
        if ($status=='pendente') {
            return 'sport';
        }if ($status=='concluido') {
            return 'health';
        } else {
            return 'leisure';
        }
    }

    public function getClassUser($status) 
    {
        if ($status==0) {
            return 'cla1';
        } else {
            return 'cla2';
        }
    }
}
