<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class CategoriasCRUDDataRowAdded extends Seeder
{
    /**
     * Auto generated seed file
     *
     * @return void
     *
     * @throws Exception
     */
    public function run()
    {
        \DB::beginTransaction();

        try {

            $data_type = Badaso::model('DataType')::where('name', 'calcategorias')->first();

            \DB::table(config('badaso.database.prefix').'data_rows')->insert(array (
                0 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'id',
                    'type' => 'number',
                    'display_name' => 'Id',
                    'required' => 1,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 1,
                ),
                1 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'icon',
                    'type' => 'text',
                    'display_name' => 'Icon',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"4"
                    }',
                    'relation' => NULL,
                    'order' => 2,
                ),
                2 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'nome',
                    'type' => 'text',
                    'display_name' => 'Nome',
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"8"
                    }',
                    'relation' => NULL,
                    'order' => 3,
                ),
                3 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'descricao',
                    'type' => 'editor',
                    'display_name' => 'Descrição',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 4,
                ),
                4 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'created_at',
                    'type' => 'datetime',
                    'display_name' => 'Created At',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 5,
                ),
                5 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'updated_at',
                    'type' => 'datetime',
                    'display_name' => 'Updated At',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 0,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 6,
                ),
                6 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'empresa_id',
                    'type' => 'empresa',
                    'display_name' => 'Empresa',
                    'required' => 1,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 1,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 7,
                ),
            ));

            $tarefas = Badaso::model('Categoria')->where('nome', 'Tarefas')->first();

            if ($tarefas) {
                Badaso::model('Categoria')->where('nome', 'Tarefas')->delete();
            }

            \DB::table('calcategorias')->insert(array (
                'id' => 1,
                'nome' => 'Tarefas',
                'descricao' => '<p>Categorias para os eventos de calendario do tipo tarefa a ser executada por um ou varios indevidous.</p>',
                'icon' => 'task',
                'empresa_id' => '1', 
            ));

            $lembrete = Badaso::model('Categoria')->where('nome', 'Lembretes')->first();

            if ($lembrete) {
                Badaso::model('Categoria')->where('nome', 'Lembretes')->delete();
            }

            \DB::table('calcategorias')->insert(array (
                'id' => 2,
                'nome' => 'Lembretes',
                'descricao' => '<p>Categoria para lembretes o casional que n&atilde;o precis&atilde;o de uma data de terminio que so pressi&atilde;o de uma tada e oura para ser natificado na aria de trabalho</p>',
                'icon' => 'circle_notifications', 
                'empresa_id' => '1', 
            ));

            $eventos = Badaso::model('Categoria')->where('nome', 'Eventos')->first();

            if ($eventos) {
                Badaso::model('Categoria')->where('nome', 'Eventos')->delete();
            }

            \DB::table('calcategorias')->insert(array (
                'id' => 3,
                'nome' => 'Eventos',
                'descricao' => '<p>Categoria para datas de calendario como forma&ccedil;&atilde;o ou reuni&otilde;es e etc...</p>',
                'icon' => 'date_range', 
                'empresa_id' => '1', 
            ));

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

            throw new Exception('exception occur ' . $e);
        }
    }
}

