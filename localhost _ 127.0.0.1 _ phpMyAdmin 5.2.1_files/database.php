<?php
// Database connection parameters

// Database connection parameters
$servername = '127.0.0.1';
$username = 'root';
$password = '';
$dbname = 'account';

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function executeQuery($sql, $successMessage = "Query executed successfully") {
    global $conn;
    
    if ($conn->query($sql) === TRUE) {
        echo $successMessage;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}



// Check if the form is submitted for login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['login'])) {
        $username = sanitizeInput($_POST['username']);
        $password = sanitizeInput($_POST['password']);

        // Perform your authentication logic here
        // For example, query the database for the user credentials
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        
            if ($user['role'] == 'admin') {
                // Redirect to admin dashboard
                header("Location: admin_dashboard.php");
            } else {
                // Redirect to regular user dashboard
                header("Location: dashboard.php");
            }
        
            // Store user information in session
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user['user_id']; // Adjust according to your user ID column
            $_SESSION['role'] = $user['role']; // Store user role in the session
            exit();
        }
        
    }

    // Check if the form is submitted for signup
    elseif (isset($_POST['signup'])) {
        $username = sanitizeInput($_POST['username']);
        $email = sanitizeInput($_POST['email']);
        $password = sanitizeInput($_POST['password']);

        // Perform your user registration logic here
        // For example, insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($conn->query($sql) === TRUE) {
            echo "User registered successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
