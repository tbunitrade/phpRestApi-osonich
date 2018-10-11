<?php
/**
 * Created by PhpStorm.
 * User: sierra.sonich
 * Date: 11.10.2018
 * Time: 10:17
 */

// headers

header('Access-Controll-Allow-Origin: *');
header('Content-Type: application/json');


include_once '../../config/Database.php';
include_once '../../models/Post.php';

// instantiate DB & connect

$database = new Database();
$db = $database->connect();

// instantiate blog post object

$post = new Post($db);

//Blog post query

$result = $post->read();

//get row count
$num = $result->rowCount();

//check if any posts
if ($num > 0) {
    //Post array start loop
    $posts_arr = array();
    $posts_arr['data'] = array();


    //loop
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        //$row['title']
        extract($row);

        $post_item = array(
            'id' => $id,
            'title' => $title,
            'body' => html_entity_decode($body),
            'author' => $author,
            'category_id' => $category_id,
            'category_name' => $category_name

        );

        // Push to 'data'
        array_push($posts_arr['data'], $post_item);
        //now its php array
    }

    // turn to json & output
    echo json_encode($posts_arr);


} else {

    // no Posts
    echo json_encode(
        array('message' => 'no message found')
    );

}
