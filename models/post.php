<?php

 class Post {
     //DB stuff
     private $conn;
     private $table = 'posts';

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

     public function read() {
         //create query

         $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                FROM ' . $this->table . ' p
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
     //get single post

     public function read_single() {
         //again query
         $query = 'SELECT c.name as category_name, p.id, p.category_id, p.title, p.body, p.author, p.created_at
                    
                    FROM
                        ' . $this->table . ' p
                    
                    LEFT JOIN
                        categories c ON p.category_id = c.id
                    WHERE
                        p.id = ?
                        LIMIT 0,1
                    ';

         //end query

         //prepare statement

         $stmt = $this->conn->prepare($query);

         //bind ID

         $stmt->bindParam(1, $this->id);
         //execute query
         $stmt->execute();

         $row = $stmt->fetch(PDO::FETCH_ASSOC);

         //set properties
         $this->title = $row['title'];
         $this->body = $row['body'];
         $this->author = $row['author'];
         $this->category_id = $row['caregory_id'];
         $this->category_name = $row['category_name'];


     }// end of fuction single read


     //start function area
     //Create Post


     public function create() {

         $query = 'INSERT INTO ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id';

            //

            //Prepate statement
            $stmt = $this->conn->prepare($query);

            //Clean data
            $this->title = htmlspecialchars(strip_tags($this->title));
            $this->body = htmlspecialchars(strip_tags($this->body));
            $this->author = htmlspecialchars(strip_tags($this->author));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            //Bind data
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':body', $this->body);
            $stmt->bindParam(':author', $this->author);
            $stmt->bindParam(':category_id', $this->category_id);

            // Execute query

             if ($stmt->execute()) {
                 return true;
             }
            //print error if something goes down (
             printf("Error: %s.\n", $stmt->error);

            return false;

        //end of create function
     }

     // update post
     public function update() {

         $query = 'UPDATE ' . $this->table . ' SET title = :title, body = :body, author = :author, category_id = :category_id
         WHERE
         id = :id';

         //

         //Prepate statement
         $stmt = $this->conn->prepare($query);

         //Clean data
         $this->title = htmlspecialchars(strip_tags($this->title));
         $this->body = htmlspecialchars(strip_tags($this->body));
         $this->author = htmlspecialchars(strip_tags($this->author));
         $this->category_id = htmlspecialchars(strip_tags($this->category_id));
         $this->id = htmlspecialchars(strip_tags($this->id));

         //Bind data
         $stmt->bindParam(':title', $this->title);
         $stmt->bindParam(':body', $this->body);
         $stmt->bindParam(':author', $this->author);
         $stmt->bindParam(':category_id', $this->category_id);
         $stmt->bindParam(':id', $this->id);

         // Execute query

         if ($stmt->execute()) {
             return true;
         }
         //print error if something goes down (
         printf("Error: %s.\n", $stmt->error);

         return false;

         //end of create function
     }
 }