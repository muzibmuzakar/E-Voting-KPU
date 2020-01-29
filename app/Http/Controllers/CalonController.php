<?php

namespace App\Http\Controllers;

use App\Models\Calon;
use Illuminate\Http\Request;

class CalonController extends Controller
{
    // read
    public function index(Request $request)
    {
        $acceptHeader = $request->header('Accept');

        if ($acceptHeader === 'application/json' || $acceptHeader === 'application/xml'){
            $calon = Calon::OrderBy("id", "DESC")->paginate(10);

            if ($acceptHeader === 'application/json') {

                return response()->json($calon->items('data'), 200);
            }else {
                $xml = new \SimpleXMLElement('<posts/>');
                foreach($calon->items('data') as $item){

                    $xmlItem = $xml->addChild('calon');

                    $xmlItem->addChild('id', $item->id);
                    $xmlItem->addChild('no_urut', $item->no_urut);
                    $xmlItem->addChild('nama_CaGub', $item->nama_CaGub);
                    $xmlItem->addChild('nama_CaWaGub', $item->nama_CaWaGub);
                    $xmlItem->addChild('visi', $item->visi);
                    $xmlItem->addChild('misi', $item->misi);
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
                    'no_urut' => 'required',
                    'nama_CaGub' => 'required',
                    'nama_CaWaGub' => 'required',
                    'visi' => 'required',
                    'misi' => 'required'
                ];

                $validator = \Validator::make($input, $validationRules);

                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }
                // end validation

                $post = Calon::create($input);

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
            $calon = Calon::find($id);

            if(!$calon){
                abort(404);
            }
            return response()->json($calon, 200);
        } else {
            return response('Not Acceptable!', 406);
        }        
    }

    // update
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $calon = Calon::find($id);

        if(!$calon){
            abort(404);
        }

        // validation
        $validationRules = [
            'no_urut' => 'required',
            'nama_CaGub' => 'required',
            'nama_CaWaGub' => 'required',
            'visi' => 'required',
            'misi' => 'required'
        ];

        $validator = \Validator::make($input, $validationRules);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        // end validation

        $calon->fill($input);
        $calon->save();

        return response()->json($calon, 200);
    }

    // delete
    public function destroy($id)
    {
        $calon = Calon::find($id);

        if(!$calon){
            abort(404);
        }

        $calon->delete();
        $message = ['message' => 'delete succesfully', 'calon_id' => $id];

        return response()->json($message, 200);
    }
}

?>