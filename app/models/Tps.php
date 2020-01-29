<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tps extends Model
{
    
    protected $table = 'tps';
    protected $fillable = array('no_tps', 'alamat', 'ketua_kpps');
    
    public $timestamps= true;


    public function ketua()
    {
        return $this->belongsTo(User::class,'ketua_kpps');
    }
}

?>