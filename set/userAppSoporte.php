<?php
    include '../includes/config.php';
    extract($_POST);

    // Attempt to retrieve user data
    $userLogin = $wp->user_soporte(strtolower($email));

    // Check if the function call succeeded
    if ($userLogin === false) {
        // Log the error
        error_log('Failed to retrieve user data');
        
        // Return a JSON error response
        header('Content-Type: application/json');
        echo json_encode(array('error' => 'Failed to retrieve user data'));
    } else {
        // Return a JSON response with the user data
        header('Content-Type: application/json');
        echo json_encode(array("response" => $userLogin));
    }
?>
