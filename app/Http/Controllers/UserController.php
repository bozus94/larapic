<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\facades\Storage;
use Illuminate\support\facades\File;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function config(){
        return view('user.config');
    }

    public function update(Request $request){

        

        $user = \Auth::user();
        $id = $user->id;

        /* VALIDAR LOS DATOS DE LA REQUEST */
        $validate = $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'nick' => ['required', 'string', 'max:255', 'unique:users,nick,'.$id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id]
        ]);
        
        /* RECIBIR LA INFORMACION */
        $name = $request->input('name');
        $surname = $request->input('surname');
        $email = $request->input('email');
        $nick = $request->input('nick');

        /* ASIGNAR LOS VALORES AL OBJETO DEL USUARIO */
        $user->name = $name;
        $user->surname = $surname;
        $user->email = $email;
        $user->nick = $nick;

        /* RECOGER LA IMAGEN */
        $image_path = $request->file('image_path');
        if($image_path){
            /* asingnar nombre unico */
            $image_name = time().$image_path->getClientOriginalName();

            /* guardar el archivo imagen en el disco */
            storage::disk('users')->put($image_name, File::get($image_path));

            /* setear el nombre de la imagen en el objeto */
            $user->image = $image_name;
        }


        /* EJECUTADO LA ACTUALIZACION Y ACCIONES POSTERIORES */
        $user->update();

        return redirect()->route('user.config')
                         ->with(['message' => 'Usuario actualizado correctamente']);
    }

    public function updatePassword(Request $request){
        $user = \Auth::user();
        
        /* VALIDAR DATOS DE LA REQUEST  */
        $validate = $this->validate($request, [
            'password' => ['required', 'min:8', 'confirmed']
        ]);

        /* RECOGIENDO LOS DATOS DE LA REQUEST */
        $password = $request->input('password');

        /* ASIGNANDO LOS VALORES A OBJETO USUARIO */
        $user->password = Hash::make($password);
        

        /* EJECTUANDO LA SENTENCIA SQL Y ACCIONES POSTERIORES */
        $save = $user->update();
       return redirect()->route('user.config')
                        ->with(['message' => 'Se actualizo tu contraseña existosamente']);
    }

    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
}
