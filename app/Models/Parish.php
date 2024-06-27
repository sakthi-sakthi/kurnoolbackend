<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Parish extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    
    function getCategory(){
        return $this->hasOne('App\Models\Category','id','category_id');
    }
    function getMedia(){
        return $this->hasOne('App\Models\Media','id','media_id');
    }
    function getvicariates(){
        return $this->hasOne('App\Models\Vicariate','id','vicariate');
    }

}