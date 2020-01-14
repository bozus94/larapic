<?php

namespace App\Http\Controllers;

use App\Like;
use App\Image;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\support\facades\File;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('images.create');
    }

    public function upload(Request $request)
    {
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

        if ($image_path) {
            /* seteamos el nombre del archivo */
            $image_name = time().$image_path->getClientOriginalName();
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

    public function getImage($filename)
    {
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id)
    {
        $image = Image::find($id);

        return view('images.detail', [
            'image' => $image,
            'compact' => false
        ]);
    }

    public function delete($id){
        /* obetenemos el objeto de usuario y la imagen a eliminar */
        $user = \Auth::user();
        $image = Image::find($id);
        /* obtetemos los likes y los cometarios que pertenecen a la imagen */
        $comments = Comment::where('image_id', $id)->get();
        $likes = Like::where('image_id', $id)->get();

        /* comprobamos que el id del usuario logueado sea igual que el id del usuairo propietario de la imagen */
        if($user && $image && $user->id == $image->user_id){

            /* comprobamos que la imagen contenga likes si es asi se procede a eliminarlos */
            if($likes && count($likes)>1){
                foreach ($likes as $like) {
                    $like->delete();
                }
            }
            /* comprobamos que la imagen contenga comentarios si es asi se procede a eliminarlos */
            if($comments && count($comments)>1){
                foreach ($comments as $comment) {
                    $comment->delete();
                }
            }
            /* eliminaos el archivo de la imagen del disco */
            Storage::disk('images')->delete($image->image_path);

            /* eliminamos el objeto imagen */
            $image->delete();

            $message = array('message' => 'Imagen eliminada correctamente');


        }else{
            $message = array('message' => 'NO se pudo eliminar la imagen');
        }

        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $image = Image::findOrFail($id);
        $user = Auth::user();
        if($user && $image && $user->id == $image->user_id){
            return view('images.edit', compact('image'));
        }else{
            return redirect()->back();
        }

    }

    public function update(Request $request) {
        /* validar datos */
        $validate = $this->validate($request,[
            'image_path' => ['image'],
            'description' => ['required']
        ]);

        /* recoger los datos  */
        $image_path = $request->file('image_path') ?? false;
        $description = $request->input('description');
        $image_id = $request->input('image_id');

        /* asingar valores al objeto */
        $image = Image::find($image_id);
        $image->description = $description;
        
        if($image_path){
            /* eliminar imagen anterior del disco*/
            Storage::disk('images')->delete($image->image_path);

            /* preparar la nueva imagen */
            /* nombramos la image */
            $image_name = time() . $image_path->getClientOriginalName();
            /* insertamos la nieva imagen en el directorio */
            Storage::disk('images')->put($image_name, File::get($image_path));
            /* seteamos el nombre la imagen en el objeto imagen */
            $image->image_path = $image_name;
        }

        /* ejecutamos la cosulta y la accion posterior */

        $image->save();

        return redirect()->route('image.edit', ['id' => $image->id])->with([
            'message'=>'imagen actuazada exitosamnete'
        ]);
    }
}
