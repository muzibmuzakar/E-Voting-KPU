<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    // read
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $tps = Tps::with('ketua:id,name')->OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {

                return response()->json($tps->items('data'), 200);
            }else {
                $xml = new \SimpleXMLElement('<posts/>');
                foreach($tps->items('data') as $item){

                    $xmlItem = $xml->addChild('tps');

                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('no_tps', $item->no_tps);
                    $xmlItem->addChild('alamat', $item->alamat);
                    $xmlItem->addChild('ketua_kpps', $item->ketua_kpps);
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
                    'no_tps' => 'required|max:2',
                    'alamat' => 'required|min:5',
                    'ketua_kpps' => 'required'
                ];

                $validator = \Validator::make($input, $validationRules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                } 
                // end validation
                $post = Tps::create($input);

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
            $tps = Tps::with('ketua')->find($id);

            if(!$tps){
                abort(404);
            }
            return response()->json($tps, 200);
        } else {
            return response('Not Acceptable!', 406);
        }        
    }

    // update
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $tps = Tps::find($id);

        if(!$tps){
            abort(404);
        }

        // validation
        $validationRules = [
            'no_tps' => 'required|max:2',
            'alamat' => 'required|min:5',
            'ketua_kpps' => 'required'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // end validation

        $tps->fill($input);
        $tps->save();

        return response()->json($tps, 200);
    }

    // delete
    public function destroy($id)
    {
        $tps = Tps::find($id);

        if(!$tps){
            abort(404);
        }

        $tps->delete();
        $message = ['message' => 'delete succesfully', 'tps_id' => $id];

        return response()->json($message, 200);
    }
}

?>