<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Photo extends Model 
{

    protected $table = 'photos';
    public $timestamps = true;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $fillable = array('name', 'path', 'album_id');

    public function album()
    {
        return $this->belongsTo('App\Models\Album');
    }

}