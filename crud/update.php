<?php
// Include config file
require_once "connection.php";

// Define variables and initialize with empty values
$firstname = $lastname = $email = "";
$firstname_err = $lastname_err = $email_err = "";

// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
	// Get hidden input value
	$id = $_POST["id"];

	// Validate name
	$input_name = trim($_POST["firstname"]);
	if (empty($input_name)) {
		$name_err = "Please enter firstname.";
	} elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
		$firstname_err = "Please enter a valid firstname.";
	} else {
		$firstname = $input_name;
	}

	// Validate Last Name
	$input_lastname = trim($_POST["lastname"]);
	if (empty($input_lastname)) {
		$lastname_err = "Please enter lastname.";
	} else {
		$lastname = $input_lastname;
	}

	// Validate Email
	$input_email = trim($_POST["email"]);
	if (empty($input_email)) {
		$email_err = "Please enter the email.";
		// } elseif(!ctype_digit($input_salary)){
		//     $salary_err = "Please enter a positive integer value.";
		//
	} else {
		$email = $input_email;
	}

	// Check input errors before inserting in database
	if (empty($firstname_err) && empty($lastname_err) && empty($email_err)) {
		// Prepare an update statement
		$sql = "UPDATE workers SET firstname=?, lastname=?, email=? WHERE id=?";

		if ($stmt = mysqli_prepare($conn, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "sssi", $param_firstname, $param_lastname, $param_email, $param_id);

			// Set parameters
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_email = $email;
			$param_id = $id;

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Records updated successfully. Redirect to landing page
				header("location: index.php");
				exit();
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
		}

		// Close statement
		mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($conn);
} else {
	// Check existence of id parameter before processing further
	if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
		// Get URL parameter
		$id = trim($_GET["id"]);

		// Prepare a select statement
		$sql = "SELECT * FROM emp WHERE id = ?";
		if ($stmt = mysqli_prepare($conn, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "i", $param_id);

			// Set parameters
			$param_id = $id;

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				$result = mysqli_stmt_get_result($stmt);

				if (mysqli_num_rows($result) == 1) {
					/* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

					// Retrieve individual field value
					$firstname = $row["firstname"];
					$lastname = $row["lastname"];
					$email = $row["email"];
				} else {
					// URL doesn't contain valid id. Redirect to error page
					header("location: error.php");
					exit();
				}

			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
		}

		// Close statement
		mysqli_stmt_close($stmt);

		// Close connection
		mysqli_close($conn);
	} else {
		// URL doesn't contain id parameter. Redirect to error page
		header("location: error.php");
		exit();
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                          <!--   <textarea name="address" class="form-control <?php echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php echo $address; ?></textarea> -->
<input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">

                            <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>