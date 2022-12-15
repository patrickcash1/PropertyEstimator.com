<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class ImageController extends Controller
{
    public function temporaryUpload(Request $request){
   		$validator = Validator::make($request->all(), [
	        'uploaded_file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:8192',
	      ]);

   		if ($validator->passes()) {
			$input = $request->all();
			$input['uploaded_file'] = time().'.'.$request->uploaded_file->extension();
        	$request->uploaded_file->move(public_path('uploaded_file'), $input['uploaded_file']);

        	//insert into db here
        	//Propertyimages::create($input);
        	return response()->json(['success'=>'done', 'newPictureId' => 1, 'imgsrc' => $input['uploaded_file']]);
   		}    
   		return response()->json(['error'=>$validator->errors()->all()]);	
    }
}
