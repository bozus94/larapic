<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function newComment(Request $request){

        $validator = $this->validate($request, [
            'image_id' => ['integer', 'required'],
            'comment_content' => ['string', 'required', 'max:250']
        ]);
        
        $user_id = Auth::user()->id;
        $image_id = $request->input('image_id');
        $comment_content = $request->input('comment_content');

        $comment = new Comment();
        $comment->user_id = $user_id;
        $comment->image_id = $image_id;
        $comment->content = $comment_content;
        $comment->save();

        return redirect()->route('image.detail', [
            'filename' => $image_id
        ])->with(['message' => 'Comentario publicado exitosamente']);
     }

     public function deleteComment($comment_id){
         /* verificamos si el comentario existe */
        $comment = Comment::find($comment_id);
        if($comment){
            /* capturamos el id del usuario logueado */
                $user = \Auth::user();
            /* 
                comprobamos que el id del usuario que creo el comentario sea igual a:
                    - usuario logueado actualmente
                    - usuario que publico la imagen
            */
            if($user && ($comment->user_id = $user->id || $comment->image->user_id = $user->id)){
                $comment->delete();
    
                return redirect()->route('image.detail', [
                    'filename' => $comment->image->id
                ])->with(['message' => 'El comentario se elimino correctamente!']);
            }else{
                return redirect()->route('image.detail', [
                    'filename' => $comment->image->id
                ])->with(['message' => 'El comentario no se pudo eliminar']);
            }
        }else{
            return redirect()->route('home');
        }
        
        

     }
     
}
