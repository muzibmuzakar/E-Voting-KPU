<?php

namespace App\Http\Controllers;

use App\Models\Voter;
use Illuminate\Http\Request;

class VoterController extends Controller
{
    // read
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $voter = Voter::with('tps:id,no_tps,alamat')->OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {

                return response()->json($voter->items('data'), 200);
            }else {
                $xml = new \SimpleXMLElement('<posts/>');
                foreach($voter->items('data') as $item){

                    $xmlItem = $xml->addChild('voter');

                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('NIK', $item->NIK);
                    $xmlItem->addChild('nama', $item->nama);
                    $xmlItem->addChild('pilihan', $item->pilihan);
                    $xmlItem->addChild('id_tps', $item->id_tps);
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
                    'NIK' => 'required|max:16|min:16',
                    'nama' => 'required',
                    'tgl_lahir' => 'required',
                    'id_tps' => 'required'
                ];

                $validator = \Validator::make($input, $validationRules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                // end validation

                $post = Voter::create($input);

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
            $voter = Voter::with('tps')->find($id);

            if(!$voter){
                abort(404);
            }
            return response()->json($voter, 200);
        } else {
            return response('Not Acceptable!', 406);
        }        
    }

    // update
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $voter = Voter::find($id);

        if(!$voter){
            abort(404);
        }

        $voter->fill($input);
        $voter->save();

        return response()->json($voter, 200);
    }

    // delete
    public function destroy($id)
    {
        $voter = Voter::find($id);

        if(!$voter){
            abort(404);
        }

        $voter->delete();
        $message = ['message' => 'delete succesfully', 'voter_id' => $id];

        return response()->json($message, 200);
    }
}

?>