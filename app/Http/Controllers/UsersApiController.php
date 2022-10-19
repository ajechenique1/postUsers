<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Services\ApiService;

class UsersApiController extends Controller
{
    
    public function insertUser(){

        try {
            $dataUsers = ApiService::getDataApi(env('URL_GET_USER'), "GET");

            $posts = Post::all();
            $userIds = [];

            foreach($posts as $post){
                array_push($userIds, $post->user_id);
            }
                
            $userIds = array_unique($userIds);
            $numUser = 50;
            $count = 0;

            foreach($dataUsers as $user){
            
                if($count < $numUser){
                    
                    $dataUser = [
                        'id' => $user["id"],
                        'name' => $user["name"],
                        'email' => $user["email"],
                        'password' => md5('123456'),
                        'city' => $user["address"]["city"],
                    ];

                    if (!User::where('id', $user["id"])->exists() && (in_array($user["id"], $userIds)) ) {
                        User::create($dataUser);
                    }
                }
                $count++;
            }

            $response = '';
        } catch (Exception $e) {
            //echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            $response = [
                'response' => $e->getMessage()
            ];
        }


        return response()->json($response);
    }

    public function getAll(Request $request){

        try {
            
            $dataUser =  User::all();
            $dataUserPost = [];
            $mediaRating = [];
            $response = [];

            foreach($dataUser as $user)
            {
                $posts = [];
                $sumRatingPost = 0;
                $countPost = 0;

                foreach($user->posts as $post)
                {
                    $dataPost = [
                        "id" => $post->id,
                        "user_id" => $post->user_id, 
                        "body" => $post->body,
                        "title" =>  $post->title,
                    ];

                    $sumRatingPost = $sumRatingPost + $post->rating;
                    $countPost++;
                    array_push($posts, $dataPost);
                }
                $mediaPost = $sumRatingPost / $countPost;

                $data = [
                    "id" => $user->id,
                    "nombre" => $user->name, 
                    "email" => $user->email,
                    "ciudad" =>  $user->city,
                    //"media" => $mediaPost,
                    "posts" => $posts
                ];

                array_push($dataUserPost, $data);
            }

            $response = $dataUserPost;

        } catch (Exception $e) {
            $response = [
                'response' => $e->getMessage()
            ];
        }


        return response()->json($response);
    }

}
