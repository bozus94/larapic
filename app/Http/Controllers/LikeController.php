<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function like($image_id)
    {
        /* RECOGER DATOS DEL USUARIO Y LA IMAGEN AFECTADA */
        $user = \Auth::user();

        /* VERIFICAR SI LIKE EXITE */
        $isset_like = Like::where('user_id', $user->id)->where('image_id', $image_id)->count();
        //si no existe un registro con el mimsmo usuario_id e imagen_id entonces se ejecuta la accion del like
        if ($isset_like == 0) {
            /* SETEAR LAS PROPIEDADES DEL OBJECTO LIKE */
            $like = new Like();
            $like->user_id = $user->id;
            $like->image_id = (int)$image_id;
    
            /* EJECUTAR LA INSECION EN LA BD */
            $like->save();

            return response()->json([
                'like' => $like
            ]);
        } else {
            return response()->json([
                'message' => 'el like ya existe'
            ]);
        }
    }

    public function dislike($image_id)
    {
        /* RECOGER DATOS DEL USUARIO Y LA IMAGEN AFECTADA */
        $user = \Auth::user();

        /* VERIFICAR SI LIKE EXITE */
        $dislike = Like::where('user_id', $user->id)->where('image_id', $image_id)->first();
        
        if ($dislike) {
            /* EJECUTAR LA INSECION EN LA BD */
            $dislike->delete();
            return response()->json([
                'dislike' => $dislike,
                'message' => 'el like se elimino'
            ]);
        } else {
            return response()->json([
                'message' => 'el like no existe'
            ]);
        }
    }

    public function favorites()
    {
        $usuario = \Auth::user();
        $likes = Like::where('user_id', $usuario->id)->orderBy('id', 'DESC')
                                                ->paginate(5);

        return view('likes.favorites', [
            'likes' => $likes,
            'compact' => true
        ]);
    }
}
