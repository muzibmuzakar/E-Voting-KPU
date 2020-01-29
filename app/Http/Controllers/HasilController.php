<?php

namespace App\Http\Controllers;

use App\Models\Vote;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    // read
    public function index(Request $request)
    {
        $vote = Vote::where('pilihan', 'calon1')->count();
        $vote2 = Vote::where('pilihan', 'calon2')->count();

        return response()->json(['calon1'=>$vote, 'calon2'=>$vote2, 'total'=>$vote+$vote2], 200);
    }
}