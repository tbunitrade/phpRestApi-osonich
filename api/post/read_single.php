<?php
/**
 * Created by PhpStorm.
 * User: sierra.sonich
 * Date: 11.10.2018
 * Time: 10:17
 */
// base
// headers

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate DB & connect

$database = new Database();
$db = $database->connect();

// instantiate blog post object

$post = new Post($db);

//end of base
//getID  -- something.com?id=3

$post->id = isset($_GET['id']) ? $_GET['id'] : die();

// get post
$post->read_single();

//create array

$post_arr = array(
    'id'            => $post->id,
    'title'         => $post->title,
    'body'          => $post->body,
    'author'        => $post->author,
    'category_id'   => $post->category_id,
    'category_name' => $post->category_name
);

print_r(json_encode($post_arr));

