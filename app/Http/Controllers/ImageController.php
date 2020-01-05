<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\support\facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __constructor(){
        $this->middleware('auth');
    }

    public function create(){
        return view('images.create');
    }

    public function upload(Request $request){
        /* 
            VALIDAMOS LOS DATOS DE LA REQUEST 
        **/
        $validate = $this->validate($request, [
            'description' => ['required', 'min:8'],
            'image_path' => ['required', 'image'],
        ]);

        /* 
           RECOGEMOS LOS DATOS DE LA REQUEST
        **/
        $image_path = $request->file('image_path');
        $description = $request->input('description');

        /* 
            ASIGNAMOS LOS LOS VALORES LA OBEJETO IMAGEN 
        **/
                $idUser = \Auth::user()->id;
        $image = new Image();
        $image->user_id = $idUser;
        $image->image_path = null;
        $image->description = $description;

        /* 
            GUARDAMOS LA IMAGEN EN EL DISCO
        **/    

        if($image_path){
            /* seteamos el nombre del archivo */
            $image_name = time().$image_path->getClientOriginalName();
            var_dump($image_name);
            Storage::disk('images')->put($image_name, File::get($image_path));
            $image->image_path = $image_name;
        }


        /* 
            EJECUTADO LA INSERCION Y ACCIONES POSTERIORES 
        **/
        $image->save();

        return redirect()->route('home')->with([
            'message' => 'La foto se publico exitosamente'
        ]);

    }

    public function getImage($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        $image = Image::find($id);

        return view('images.detail', [
            'image' => $image,
            'home' => false
        ]);
    }
}
