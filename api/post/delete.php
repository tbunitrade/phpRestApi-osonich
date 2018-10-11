<?php
/**
 * Created by PhpStorm.
 * User: sierra.sonich
 * Date: 11.10.2018
 * Time: 13:17
 */

// headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

//add hew headers
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, 
Access-Control-Allow-Methods, Authorization, X-Requested-With');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate DB & connect

$database = new Database();
$db = $database->connect();

// instantiate blog post object

$post = new Post($db);
//end of base

//need to get data
//start raw posted data

$data = json_decode(file_get_contents("php://input"));

// Set ID to update

$post->id = $data->id;
//
//$post->title        = $data->title;
//$post->body         = $data->body;
//$post->author       = $data->author;
//$post->category_id  = $data->category_id;

//Delete post
if ($post->delete()) {
    echo json_encode(
        array('message' => 'Post Delete')
    );

} else {
    echo json_encode(
        array('message' => 'Post not  ( Delete')
    );
}
