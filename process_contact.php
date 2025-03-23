<?php
// Set header to return JSON
header('Content-Type: application/json');

// Include database configuration
require_once "config/database.php";

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get form data
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $message = mysqli_real_escape_string($conn, $_POST['message']);
        
        // Prepare SQL statement
        $sql = "INSERT INTO contact_messages (name, email, phone, message, created_at) 
                VALUES ('$name', '$email', '$phone', '$message', NOW())";
        
        // Execute the query
        if(mysqli_query($conn, $sql)){
            // Send email notification
            $to = "realtysurakshya@gmail.com";
            $subject = "New Contact Form Submission";
            $email_body = "Name: $name\nEmail: $email\nPhone: $phone\nMessage: $message";
            $headers = "From: $email";
            
            mail($to, $subject, $email_body, $headers);
            
            echo json_encode(["success" => true, "message" => "Message sent successfully!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Database error: " . mysqli_error($conn)]);
        }
    } catch (Exception $e) {
        echo json_encode(["success" => false, "message" => "Error: " . $e->getMessage()]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method"]);
}

// Close connection
mysqli_close($conn);
?> 