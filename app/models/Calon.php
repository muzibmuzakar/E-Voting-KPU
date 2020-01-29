<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    
    protected $table = 'calon';
    protected $fillable = array('no_urut', 'nama_CaGub', 'nama_CaWaGub', 'visi', 'misi');
    
    public $timestamps= true;
}

?>