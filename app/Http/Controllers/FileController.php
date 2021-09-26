<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
   private $rules;
   private $place;
   private $var_name;
   private $name_file;


   public function __construct($rules,$place,$var_name,$name_file)
   {
       $this->rules = $rules;
       $this->place = $place;
       $this->var_name = $var_name;
       $this->name_file = $name_file;
   }



   public function UploadFile(Request $request){
       $this->validate($request,[
           $this->var_name =>$this->rules
       ]);
       if($request->hasFile($this->var_name) && $request->file($this->var_name)->isValid()) {//no problems uploading the file
           $var_name = $this->var_name;
           $request->$var_name->storeAs($this->place,$this->name_file);
           session([$this->name_file => 1]);

           return response()->json(['success' => true, 'file' => asset($this->place.$this->name_file),'name'=>$this->name_file],200);
       }else{
           return response()->json(['success' => false, 'msg' => __('there was problem with the file')],200);
       }
   }


    public function RemoveFile(Request $request){
        $this->validate($request,[
            $this->var_name =>$this->rules
        ]);

        $file = $this->place.basename($request[$this->var_name]);
        if(Storage::exists($file)){
            if(Storage::delete($file)){
                return response()->json(['success' => true],200);
            }else{
                return response()->json(__('could not delete file'),304);
            }
        }else{
            return response()->json( __('file not exists '),404);
        }
    }
}
