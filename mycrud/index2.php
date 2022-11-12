<?php
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
   <div class="container">
       <?php  include('message.php'); ?>
       <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>ADD STUDENT DETAILS
                        <a href="code.php" class="btn btn-danger float-right">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    <form action="getdata.php" method="post">
                      <div class="m-2">
                          <label for="Name">Name</label>
                          <input type="text" class="form-control" name="name" required>
                      </div>
                      <div class="m-2">
                          <label for="course">Course</label>
                          <input type="text" class="form-control" name="course" required>
                      </div>
                      <div class="m-2">
                          <label for="email">Email</label>
                          <input type="text" class="form-control" name="email" required>
                      </div>

                      <input type="submit" name="add_student" class="btn btn-primary">
                    </form>
                </div>
            </div>
          </div>
       </div>
   </div> 


<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>