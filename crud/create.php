<?php
// Include config file
require_once "connection.php";

// Define variables and initialize with empty values
$firstname = $lastname = $email = "";
$firstname_err = $lastname_err = $email_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	// Validate name
	$input_name = trim($_POST["firstname"]);
	if (empty($input_name)) {
		$firstname_err = "Please enter firstname.";
	} elseif (!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
		$firstname_err = "Please enter a valid name.";
	} else {
		$firstname = $input_name;
	}

	// Validate address
	$input_lastname = trim($_POST["lastname"]);
	if (empty($input_lastname)) {
		$lastname_err = "Please enter an lastname.";
	} else {
		$lastname = $input_lastname;
	}

	// Validate Email
	$input_email = trim($_POST["email"]);
	if (empty($input_email)) {
		$email_err = "Please enter the Email.";
		// } elseif(!ctype_digit($input_email)){
		//     $email_err = "Please enter a positive integer value.";
	} else {
		$email = $input_email;
	}

	// Check input errors before inserting in database
	if (empty($fistname_err) && empty($lastname_err) && empty($email_err)) {
		// Prepare an insert statement
		$sql = "INSERT INTO emp (firstname, lastname, email) VALUES (?, ?, ?)";

		if ($stmt = mysqli_prepare($conn, $sql)) {
			// Bind variables to the prepared statement as parameters
			mysqli_stmt_bind_param($stmt, "sss", $param_firstname, $param_lastname, $param_email);

			// Set parameters
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_email = $email;

			// Attempt to execute the prepared statement
			if (mysqli_stmt_execute($stmt)) {
				// Records created successfully. Redirect to landing page
				header("location: index.php");
				exit();
			} else {
				echo "Oops! Something went wrong. Please try again later.";
			}
		}

		// Close statement
		//mysqli_stmt_close($stmt);
	}

	// Close connection
	mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $firstname; ?>">
                            <span class="invalid-feedback"><?php echo $firstname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>

            <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">


                        <!--     <textarea name="address" class="form-control <?php //echo (!empty($address_err)) ? 'is-invalid' : ''; ?>"><?php //echo $address; ?></textarea> -->
                            <span class="invalid-feedback"><?php echo $lastname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                            <span class="invalid-feedback"><?php echo $email_err; ?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>