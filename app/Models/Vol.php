<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vol extends Model
{
    use HasFactory;
    protected $fillable = ['type_vol', 'date_vol','numero_vol', 'terminal'];
     public function participants(){
        return  $this->belongsToMany(Participant::class,'vols_participants','vol_id','participant_id');
     }
}
