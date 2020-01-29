<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hasil extends Model
{
    
    protected $table = 'hasil';
    protected $fillable = array('pasangan1', 'jml_suara_pasangan1', 'pasangan2', 'jml_suara_pasangan2', 'total_suara_masuk');
    
    public $timestamps= true;
}

?>