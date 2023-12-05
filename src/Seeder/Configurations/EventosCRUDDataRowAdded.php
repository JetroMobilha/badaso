<?php

namespace Database\Seeders\Badaso;

use Illuminate\Database\Seeder;
use Uasoft\Badaso\Facades\Badaso;

class EventosCRUDDataRowAdded extends Seeder
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

            $data_type = Badaso::model('DataType')::where('name', 'caleventos')->first();

            $relacao = '{"relation_type":"belongs_to_many","model":"Uasoft\\\\Badaso\\\\Models\\\\User","destination_table":"'.config('badaso.database.prefix').'users","destination_table_column":"id","destination_table_display_column":"name"}';

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
                    'field' => 'categoria_id',
                    'type' => 'relation',
                    'display_name' => 'Categoria',
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"6",
                        "scope":"empresa"
                    }',
                    'relation' => '{"relation_type":"belongs_to","destination_table":"calcategorias","destination_table_column":"id","destination_table_display_column":"nome"}',
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
                        "size":"6"
                    }',
                    'relation' => NULL,
                    'order' => 3,
                ),
                3 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'status',
                    'type' => 'select',
                    'display_name' => 'Status',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"4",
                        "items":[
                            {
                                "label":"Pendente",
                                "value":"pendente"
                            },
                            {
                            "label":"Em Progresso",
                            "value":"em progresso"
                            },
                            {
                            "label":"Concluido",
                            "value":"concluido"
                            }
                        ]
                    }',
                    'relation' => NULL,
                    'order' => 4,
                ),
                4 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'data_inicio',
                    'type' => 'datetime',
                    'display_name' => 'Data Inicio',
                    'required' => 1,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"4"
                    }',
                    'relation' => NULL,
                    'order' => 5,
                ),
                5 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'data_fim',
                    'type' => 'datetime',
                    'display_name' => 'Data Fim',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{
                        "size":"4"
                    }',
                    'relation' => NULL,
                    'order' => 6,
                ),
                6 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'localizacao',
                    'type' => 'textarea',
                    'display_name' => 'Localizacao',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 7,
                ),
                7 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'descricao',
                    'type' => 'editor',
                    'display_name' => 'Descrição',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 8,
                ),
                8 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'user_caleventos',
                    'type' => 'relation',
                    'display_name' => 'Usuarios',
                    'required' => 0,
                    'browse' => 1,
                    'read' => 1,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 1,
                    'details' => '{"scope":"empresa"}',
                    'relation' => $relacao,
                    'order' => 9,
                ),
                9 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'autor',
                    'type' => 'data_identifier',
                    'display_name' => 'Autor',
                    'required' => 1,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 1,
                    'add' => 1,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 10,
                ),
                10 => 
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
                    'order' => 11,
                ),
                11 => 
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
                    'order' => 12,
                ),
                12 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'models',
                    'type' => 'hidden',
                    'display_name' => 'Models',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 1,
                    'edit' => 0,
                    'add' => 1,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 13,
                ),
                13 => 
                array (
                    'data_type_id' => $data_type->id,
                    'field' => 'empresa_id',
                    'type' => 'empresa',
                    'display_name' => 'Empresa',
                    'required' => 0,
                    'browse' => 0,
                    'read' => 0,
                    'edit' => 0,
                    'add' => 1,
                    'delete' => 0,
                    'details' => '{}',
                    'relation' => NULL,
                    'order' => 14,
                ),
            ));

            \DB::commit();
        } catch(Exception $e) {
            \DB::rollBack();

            throw new Exception('exception occur ' . $e);
        }
    }
}

