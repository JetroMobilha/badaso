<?php

namespace Uasoft\Badaso\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;

use Exception;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

use Uasoft\Badaso\Facades\Badaso;

use Uasoft\Badaso\Helpers\GetData;


class TarefaPendenteWidget extends TabelaWidget
{
      
    public function getTabela(): string
    {
         
        return 'caleventos';
    }

    public function getModel($model)
    {
        return  $model->where('status','pendente')
        ->whereIn('id',function($query){
            $query->select('caleventos_id')->from('user_caleventos')->where('badaso_users_id',auth()->id());
        });   
    }

    public function getNome():string{
        return 'caleventosPendentes';
    }

    public function getNomeDisplay():string{
        return 'Tarefas Pendentes';
    }
 
}
