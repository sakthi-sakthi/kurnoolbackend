<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Vicariate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    
   
    function getMedia(){
        return $this->hasOne('App\Models\Media','id','media_id');
    }
   public function priest(){
    return $this->hasOne(Priest::class,'id','priest_id');
    }
}
