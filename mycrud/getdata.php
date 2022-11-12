<?php 
session_start();
require 'dbconnection.php';

if(isset($_POST['delete_student'])){
    $student_id = mysqli_real_escape_string($conn, $_POST['delete_student']);
    $query = "DELETE FROM mycrud2  WHERE id = '$student_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Student deleted successfully...";
        header('Location:  index2.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Student not deleted";
        header('Location:  index2.php');
        exit(0);
    }
}

if(isset($_POST['update_student'])){
    $student_id = $_POST['student_id'];

    $name =  $_POST['name'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    $query = "UPDATE mycrud2 SET name='$name', course='$course', email='$email' WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if($query_run){
        $_SESSION['message'] = "Student updated successfully...";
        header('Location:  code.php');
        exit(0);
    }
    else{
        $_SESSION['message'] = "Student not updated";
        header('Location:  code.php');
        exit(0);
    }
}

if(isset($_POST['add_student'])){
   $name =  $_POST['name'];
    $course = $_POST['course'];
    $email = $_POST['email'];

    $query = "INSERT INTO mycrud2(name, course, email) VALUES ('$name', '$course','$email')";
    $query_run = mysqli_query($conn, $query);
    if($query_run){
        $_SESSION['message'] = "Student created successfully...";
        header('Location:  index2.php');
        exit(0);
    }else{
        $_SESSION['message'] = "Student not created.";
        header('Location:  index2.php');
        exit(0);
    }
}

// header('Location: index2.php');
?>