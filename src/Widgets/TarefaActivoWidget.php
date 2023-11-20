<?php

namespace Uasoft\Badaso\Widgets;

use Uasoft\Badaso\Interfaces\WidgetInterface;

use Exception;
use Illuminate\Support\Facades\DB;
use ReflectionClass;

use Uasoft\Badaso\Facades\Badaso;

use Uasoft\Badaso\Helpers\GetData;


class TarefaActivoWidget extends TabelaWidget
{

    public function getType(): string
    {
        return  WidgetInterface::TABELA;
    }

    public function getTabela(): string
    {
         
        return 'caleventos';
    }

    public function getModel($model)
    {
        return  $model->where('status','em progresso')
        ->whereIn('id',function($query){
            $query->select('caleventos_id')->from('user_caleventos')->where('badaso_users_id',auth()->id());
        }); 
    }

    public function getNome():string{
        return 'caleventosActivos';
    }

    public function getNomeDisplay():string{
        return 'Tarefas em  Progresso';
    }
}
