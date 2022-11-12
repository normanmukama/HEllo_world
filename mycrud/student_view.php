<?php
    require 'dbconnection.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View student details</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>
<body>
   <div class="container">
       <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>Student view details
                        <a href="code.php" class="btn btn-danger float-right">Back</a>
                    </h3>
                </div>
                <div class="card-body">

                <?php 
                    if(isset($_GET['id'])){
                        $student_id = mysqli_real_escape_string($conn, $_GET['id']);
                        $query = "SELECT * FROM mycrud2 WHERE id = '$student_id'";
                        $query_run = mysqli_query($conn, $query);

                        if(mysqli_num_rows($query_run) > 0){
                            $student = mysqli_fetch_array($query_run);

                            ?>
                                <div class="m-2">
                                    <label for="Name">Name</label>
                                    <p class="form-control">
                                        <?= $student['name']; ?>
                                    </p>
                                </div>
                                <div class="m-2">
                                    <label for="course">Course</label>
                                    <p class="form-control">
                                        <?= $student['course']; ?>
                                    </p>
                                </div>
                                <div class="m-2">
                                    <label for="email">Email</label>
                                    <p class="form-control">
                                        <?= $student['email']; ?>
                                    </p>
                                </div>
                            <?php
                        }else{
                            echo "<h4>No data found</h4>";
                        }
                    }
                ?>   
                </div>
            </div>
          </div>
       </div>
   </div> 


<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>