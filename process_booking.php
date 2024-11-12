<?php
// process_booking.php

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $route = $_POST['route'];
    $seats = $_POST['seats'];
    $name = htmlspecialchars(trim($_POST['name'])); // Sanitize user input
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL); // Sanitize email

    // Validate the data
    $errors = [];
    if (empty($name)) {
        $errors[] = "Name is required.";
    }
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (empty($seats) || !is_numeric($seats) || $seats < 1 || $seats > 10) {
        $errors[] = "Number of seats must be between 1 and 10.";
    }

    // Check for errors
    if (!empty($errors)) {
        // If there are errors, show them
        echo "<h1>Booking Failed</h1>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>" . $error . "</li>";
        }
        echo "</ul>";
        echo "<a href='index.html'>Go Back</a>"; // Link to go back to the form
        exit;
    }

    // Prepare the confirmation message
    $routeName = getRouteName($route);
    $confirmationMessage = "
        <h1>Booking Confirmation</h1>
        <p><strong>Route:</strong> $routeName</p>
        <p><strong>Seats:</strong> $seats</p>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Email:</strong> $email</p>
    ";

    // Display the confirmation message
    echo $confirmationMessage;
} else {
    // If the form is not submitted, redirect back to the form
    header("Location: index.html");
    exit;
}

// Function to get the route name based on route ID
function getRouteName($routeId) {
    switch ($routeId) {
        case "1":
            return "Pollachi-Chennai";
        case "2":
            return "Chennai-Karaikudi";
        case "3":
            return "Chennai-Mumbai";
        default:
            return "Unknown Route";
    }
}
?>
