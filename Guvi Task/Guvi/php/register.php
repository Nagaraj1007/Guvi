<?php
// Check if the username is taken
if (isset($_POST['username'])) {
  // Connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'guvi');

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute query
  $stmt = mysqli_prepare($conn, "SELECT * FROM signup WHERE username = ?");
  mysqli_stmt_bind_param($stmt, "s", $_POST['username']);
  mysqli_stmt_execute($stmt);

  // Check if username is taken
  if (mysqli_stmt_fetch($stmt)) {
    echo 'taken';
  }
  else {
    echo 'available';
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Check if the email is taken
if (isset($_POST['email'])) {
  // Connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'guvi');

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute query
  $stmt = mysqli_prepare($conn, "SELECT * FROM signup WHERE email = ?");
  mysqli_stmt_bind_param($stmt, "s", $_POST['email']);
  mysqli_stmt_execute($stmt);

  // Check if email is taken
  if (mysqli_stmt_fetch($stmt)) {
    echo 'taken';
  }
  else {
    echo 'available';
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Insert new user into database
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
  // Connect to database
  $conn = mysqli_connect('localhost', 'root', '', 'guvi');

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Prepare and execute query
  $stmt = mysqli_prepare($conn, "INSERT INTO signup (username, email, password) VALUES (?, ?, ?)");
  mysqli_stmt_bind_param($stmt, "sss", $_POST['username'], $_POST['email'], $_POST['password']);
  mysqli_stmt_execute($stmt);
  

  // Check if insert was successful
  if (mysqli_affected_rows($conn) > 0) {
    echo 'success';
  }
  else {
    echo 'error';
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);
}

// Store form data in local storage
if (isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
  $data = array(
    "username" => $_POST["username"],
    "email" => $_POST["email"],
    "password" => $_POST["password"]  
  );
  $json_data = json_encode($data);
  echo "<script>localStorage.setItem('signup_data', '$json_data');</script>";
}
?>
