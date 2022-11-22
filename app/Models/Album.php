<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model 
{

    protected $table = 'albums';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name','directory_name');

    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }

}