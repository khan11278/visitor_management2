<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Logo;

class SettingController extends Controller
{
    public function setting(){
        $logo= new Logo();
        $url=route('register');
        $data=compact('logo','url');
        return view('settings')->with($data);
    }
    protected function imageupload(Request $request,$image_name,$userid_1) {
        $file=$request->file($image_name);
        // dd($file);
        $name = $file->getClientOriginalName();
        $extension=$file->getClientOriginalExtension();
        $filename='123'.'.jpg';
        $file->move('uploads/'.$userid_1,$filename);
        return $filename;
      }
    public function register(Request $request){
        $request->validate([
            'logo_upload'       =>  'required|mimes:png,jpg,jpeg'
            // 'contact_person'        =>  'required'
        ]);
        $logo=new Logo();
        $logo_file = $this->imageupload($request,'logo_upload',Auth::user()->id);
        $logo->folder_path=$logo_file;
        $logo->where('folder_path', 'LIKE', '123.jpg')->delete();
        $logo->save();
        return  redirect()->back()->with('settings', 'Logo Sucessfully Added');;
    }
}
