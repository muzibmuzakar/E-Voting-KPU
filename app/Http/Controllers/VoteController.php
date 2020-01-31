<?php

namespace App\Http\Controllers;

use App\Models\vote;
use App\Models\Voter;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    // read
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $vote = Vote::with('voter:id,nama')->OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {

                return response()->json($vote->items('data'), 200);
            }else {
                $xml = new \SimpleXMLElement('<posts/>');
                foreach($vote->items('data') as $item){

                    $xmlItem = $xml->addChild('vote');

                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('id_voter', $item->id_voter);
                    $xmlItem->addChild('pilihan', $item->pilihan);
                    $xmlItem->addChild('created_at', $item->created_at);
                    $xmlItem->addChild('updated_at', $item->updated_at);
                }
                return $xml->asXML();
            }
        } else {
            return response('Not Acceptable!', 406);
        }
    }

    // create
    public function store(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){

            $contentTypeHeader = $request->header('Content-Type');

            if ($contentTypeHeader === 'application/json'){
                $input = $request->all();

                // validation
                $validationRules = [
                    'NIK' => 'required',
                    'pilihan' => 'required|in:calon1,calon2'
                ];

                $validator = \Validator::make($input, $validationRules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                } 
                // end validation
                $voter=Voter::where('NIK', $input['NIK'])->first();
                if (! $voter ) abort (403, 'voter tidak terdaftar');

                $post = new Vote;
                $post->id_voter=$voter->id;
                $post->pilihan=$input['pilihan'];
                $post->save();

                return response()->json($post, 200);
            } else{
                return response('Unsupported Media Type', 415);
            }
        }else{
            return response('Not Acceptable!', 406);
        }

    }

    // read by id
    public function show(Request $request, $id)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $vote = Vote::with('voter')->find($id);

            if(!$vote){
                abort(404);
            }
            return response()->json($vote, 200);
        } else {
            return response('Not Acceptable!', 406);
        }        
    }

    // update
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $vote = Vote::find($id);

        if(!$vote){
            abort(404);
        }

        // validation
        $validationRules = [
            'no_vote' => 'required|max:2',
            'alamat' => 'required|min:5',
            'voter_kpps' => 'required'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // end validation

        $vote->fill($input);
        $vote->save();

        return response()->json($vote, 200);
    }

    // delete
    public function destroy($id)
    {
        $vote = Vote::find($id);

        if(!$vote){
            abort(404);
        }

        $vote->delete();
        $message = ['message' => 'delete succesfully', 'vote_id' => $id];

        return response()->json($message, 200);
    }
}

?>