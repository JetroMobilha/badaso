<?php

namespace Uasoft\Badaso\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table ='calgrupos';

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
        'responsavel',
    ];


    public function users()
    {
        return $this->belongsToMany('Uasoft\Badaso\Models\User',config('badaso.database.prefix').'user_calgrupos',
        'calgrupos_id',
        config('badaso.database.prefix').'users_id');
    }

    public function user()
    {
        return $this->belongsTo('Uasoft\Badaso\Models\User');
    }
}
