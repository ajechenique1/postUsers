<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Services\ApiService;

class PostsApiController extends Controller
{
    public function insertPost(){

        try {
            
            $data = ApiService::getDataApi(env('URL_GET_POST'), "GET");

            $numPost = 50;
            $count = 0;
            $posts = [];
            foreach($data as $post){
                
                if($count < $numPost){
                    $rating = ((str_word_count($post["title"], 0)) * 2) + (str_word_count($post["body"], 0));

                    $dataPost = [
                        'id' => $post["id"],
                        'user_id' => $post["userId"],
                        'title' => $post["title"],
                        'body' => $post["body"],
                        'rating' => $rating
                    ];

                    if (Post::where('id', $post["id"])->exists()) {
                        $postUpdate = Post::find($post["id"]);
                        $postUpdate->body = $post["body"];
                        $postUpdate->update();
                    }else{
                        $postCreate = Post::create($dataPost);
                    }
                }
                $count++;
            }

            $response = true;
        } catch (Exception $e) {
            $response = [
                'response' => $e->getMessage()
            ];
        }


        return $response;
    }
    
    public function getTop(Request $request){

        try {
            $response = Post::getTopPost();

        } catch (Exception $e) {
            $response = [
                'response' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

    public function getById(Request $request){

        try {
            $id = $request["id"];
            
            $dataPost =  Post::find($id);
            
            if(!empty($dataPost)){
                $response = [
                    "id" => $dataPost->id,
                    "body" => $dataPost->body, 
                    "title" => $dataPost->title,
                    "name" => $dataPost->user[0]->name,
                ];
            }else{
                return response(['error' => true, 'error-msg' => 'Not found'], 404);
            }

        } catch (Exception $e) {
            $response = [
                'response' => $e->getMessage()
            ];
        }

        return response()->json($response);
    }

}
