<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css">

<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>
<style>
    .red-color {
        color:red;
    }
    .blue-color {
        color:blue;
    }

</style>
</head>
<body>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Employees Details</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Employee</a>
                    </div>
                    <?php
// Include config file
require_once "connection.php";

// Attempt select query execution
$sql = "SELECT * FROM emp";
if ($result = mysqli_query($conn, $sql)) {
	if (mysqli_num_rows($result) > 0) {
		echo '<table id="example" class="table table-bordered table-striped">';
		echo "<thead>";
		echo "<tr>";
		echo "<th>Id</th>";
		echo "<th>First Name</th>";
		echo "<th>Last Name</th>";
		echo "<th>Email</th>";
		echo "<th>Action</th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
		while ($row = mysqli_fetch_array($result)) {
			echo "<tr>";
			echo "<td>" . $row['id'] . "</td>";
			echo "<td>" . $row['firstname'] . "</td>";
			echo "<td>" . $row['lastname'] . "</td>";
			echo "<td>" . $row['email'] . "</td>";
			echo "<td>";
			echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye blue-color"></span></a>';
			echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
			echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash red-color"></span></a>';
			echo "</td>";
			echo "</tr>";
		}
		echo "</tbody>";
		echo "</table>";
		// Free result set
		mysqli_free_result($result);
	} else {
		echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
	}
} else {
	echo "Oops! Something went wrong. Please try again later.";
}

// Close connection
mysqli_close($conn);
?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    $(document).ready(function() {
    $('#example').DataTable();
} );
</script>