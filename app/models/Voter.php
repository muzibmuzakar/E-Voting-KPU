<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voter extends Model
{
    
    protected $table = 'voter';
    protected $fillable = array('NIK', 'nama', 'tgl_lahir', 'id_tps');
    
    public $timestamps= true;

    public function tps()
    {
        return $this->belongsTo(Tps::class,'id_tps');
    }
}

?>