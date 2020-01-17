<?php

namespace App\Http\Controllers;

use App\User;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\support\facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\support\facades\Storage;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($search = null)
    {
        if (trim($search)) {
            $users = User::where('nick', 'LIKE', '%'.$search.'%')
                            ->orWhere('name', 'LIKE', '%'.$search.'%')
                            ->orWhere('surname', 'LIKE', '%'.$search.'%')
                            ->orderBy('id', 'desc')
                            ->paginate(16);
        } else {
            $users = User::orderBy('id', 'desc')->paginate(16);
        }

        return view('user.index', ['users' => $users]);
    }
    
    public function config()
    {
        return view('user.config');
    }

    public function update(Request $request)
    {
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
        if ($image_path) {
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

    public function updatePassword(Request $request)
    {
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

    public function getImage($filename)
    {
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }
    
    public function profile($user_name)
    {
        $user = User::where('nick', $user_name)->first();
        $images = Image::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('user.profile', [
            'user' => $user,
            'images' => $images,
            'compact' => false
        ]);
    }
}
