<?php

namespace Uasoft\Badaso\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{

    protected $table = 'caleventos';

    /**
     * Constructor for setting the table name dynamically.
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nome',
        'descricao',
        'data_inicio',
        'data_fim',
        'localizacao',
        'categoria_id',
        'status',
        'autor',
    ]; 
}
