<?php
require 'dbaseconnection.php';

 if(isset($_POST['add-student'])){
     $name = mysqli_real_escape_string(	$_POST['name']);
     $name = mysqli_real_escape_string($_POST['course']);
     $name = mysqli_real_escape_string($_POST['email']);


     $query = "SELECT * FROM mycrud(name, course, emaiL) VALUES ('$name','$course','$email')";
     $query_run = mysqli_query($conn, $query);

     if($query_run){
         header('location: index.php');
         exit(0);
     }else{
        header('location: index.php');
        exit(0); 
     }
 }


?>