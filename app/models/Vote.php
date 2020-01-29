<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    
    protected $table = 'vote';
    protected $fillable = array('id_voter', 'pilihan');
    
    public $timestamps= true;


    public function voter()
    {
        return $this->belongsTo(Voter::class,'id_voter');
    }
}

?>