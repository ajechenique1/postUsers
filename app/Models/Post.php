<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $connection = 'sqlite';
    protected $table ='posts';
    protected $primaryKey = 'id';
    //public $timestamps = false;

    protected $fillable = [
        'id',
        'user_id',
        'title',
        'body',
        'rating',
        'updated_at',
        'created_at'
    ];

    /*
     * Get the betters post.
     */
    public function getTopPost(){
        $sql = "SELECT A.id,A.title, A.body, A.user_id, B.name, MAX(A.rating) as rating
                FROM posts A INNER JOIN users B ON A.user_id = B.id
                GROUP BY A.user_id
                ORDER BY A.rating DESC;";
        
        $result = DB::connection('sqlite')->select(DB::raw($sql));

        return $result;
    }

    /*
     * Get the user for the post.
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id');
    }
}
