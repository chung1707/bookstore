<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThumbnailController extends Controller
{
    public function uploads(Request $request){

        if($request->file('file')){
            $files =$request->file('file');
            foreach($files as $file){
                $fileName = $file->hashName();
                $fileName = time().'_'.$fileName;
                $file->storeAs('public/thumbnails',$fileName);
                $fileNames[] = $fileName;
            }
            return response()->json(['fileNames' => $fileNames]);
        }else{
            return response()->json(['massage' => ' error uploading file',],503);
        }

    }
}
