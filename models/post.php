<?php
/**
 * Created by PhpStorm.
 * User: sierra.sonich
 * Date: 11.10.2018
 * Time: 10:05
 */

 class Post {
     //DB stuff

     private $conn;
     private $table = 'post';

     //Post Properties

     public $id;
     public $category_id;
     public $category_name;
     public $title;
     public $body;
     public $author;
     public $created_at;

     // constructor with db

     public function __construct($db)
     {
         $this->conn = $db;
     }
     //get Post

     public function read () {
         //create query
         $query =   'SELECT 
                    c.name as category_name,
                    p.id,
                    p.category_id,
                    p.title,
                    p.boby,
                    p.author,
                    p.created_at
                    
                    FROM
                    ' . $this->table . ' p
                    
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                        
                    ORDER BY
                    p.created_at DESC';

         //  Prepare statement

         $stmt = $this->conn->prepare($query);

         //execute query

         $stmt->execute();
         return $stmt;
     }
 }