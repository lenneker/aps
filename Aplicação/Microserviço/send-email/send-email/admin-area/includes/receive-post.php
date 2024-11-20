<?php

include_once('mailer-closed-ticket.php');

// Retrieve the raw POST data
$jsonData = file_get_contents('php://input');
print_r($jsonData);

// Decode the JSON data into a PHP associative array
$data = json_decode($jsonData, true);
error_log(print_r("No servidor, recebendo post, respondendo com : ".$jsonData, TRUE));

// Check if decoding was successful
if ($data !== null) {
   // Access the data and perform operations
   
   $user_email = $data["user_email"];
   $id = $data["ticket_id"];
   $description = $data["description"];
   $resolution_justification = $data["resolution_justification"];
   $attendant = $data["attendant"];
   $status = $data["status"];

   sendTicketClosedEmail($user_email, $id, $description, $resolution_justification, $attendant);

   // Perform further processing or respond to the request
} else {
   // JSON decoding failed
   http_response_code(400); // Bad Request
   echo "Invalid JSON data";
}
?>
