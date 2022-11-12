<?php 
require 'dbconnection.php';
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data insertion</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
   <div class="container mt-4">
       <?php require 'message.php' ?>
       <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>STUDENT DETAILS
                        <a href="index2.php" class="btn btn-danger float-right">Add Student</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class=" table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Course</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                              $query = "SELECT * FROM mycrud2";
                              $query_run = mysqli_query($conn, $query);

                              if(mysqli_num_rows($query_run) > 0){
                                  foreach($query_run as $student){
                                    //   echo $student['name'];
                                    ?>
                                        <tr>
                                            <td><?= $student['id']; ?></td>
                                            <td><?= $student['name']; ?></td>
                                            <td><?= $student['course']; ?></td>
                                            <td><?= $student['email']; ?></td>
                                            <td>
                                                <a href="student_view.php?id= <?= $student['id']; ?>" class="btn btn-primary btn-sm">View</a>
                                                <a href="student_edit.php?id= <?= $student['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <form action="getdata.php" method="POST" class="d-inline">
                                                    <button type="submit" name="delete_student" value="<?= $student['id']; ?>" class="btn btn-danger">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php
                                  }
                              }else{
                                  echo "<h4>No records found</h4>";
                              }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
       </div>
   </div> 



<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
