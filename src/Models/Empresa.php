<?php

namespace Uasoft\Badaso\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{

    protected $table = 'empresas';

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
        'continente',
        'pais',
        'provincia',
        'descricao',
    ];
}
