<?php
// Handle the callback from SeerBit API after successful payment
// Verify the payment status and process accordingly
$paymentStatus = $_POST['paymentStatus'];

if ($paymentStatus === '08') {
  // Payment was successful
  // Send notification to the customer and process the order
  sendNotification($_POST['email'], 'Payment Successful', 'Your payment has been processed successfully.');
  processOrder($_POST);
} else {
  // Payment was not successful
  // Handle accordingly
  sendNotification($_POST['email'], 'Payment Failed', 'Your payment was not successful.');
}

// Function to send notification
function sendNotification($email, $subject, $message) {
  try {
    // Implement your notification logic here
    // For example, sending an email using PHPMailer library

    require 'vendor/autoload.php'; // Include PHPMailer library

    // Create a new PHPMailer instance
    $mailer = new PHPMailer\PHPMailer\PHPMailer();

    // SMTP configuration
    $mailer->isSMTP();
    $mailer->Host = 'smtp.example.com'; // Replace with your SMTP host
    $mailer->SMTPAuth = true;
    $mailer->Username = 'your_smtp_username'; // Replace with your SMTP username
    $mailer->Password = 'your_smtp_password'; // Replace with your SMTP password
    $mailer->Port = 587; // Replace with your SMTP port (e.g., 587 for TLS)

    // Email configuration
    $mailer->setFrom('noreply@example.com', 'Your Website'); // Replace with your email address and website name
    $mailer->addAddress($email);
    $mailer->Subject = $subject;
    $mailer->Body = $message;

    // Send the email
    if ($mailer->send()) {
      // Email sent successfully
      echo 'Notification email sent to: ' . $email;
      // Log the successful notification
      logMessage('Notification email sent to: ' . $email);
    } else {
      // Failed to send email
      echo 'Failed to send notification email.';
      echo 'Error details: ' . $mailer->ErrorInfo;
      // Log the error message
      logMessage('Failed to send notification email: ' . $mailer->ErrorInfo);
    }
  } catch (Exception $e) {
    // Exception occurred
    echo 'An error occurred while sending notification email.';
    echo 'Error details: ' . $e->getMessage();
    // Log the error message
    logMessage('An error occurred while sending notification email: ' . $e->getMessage());
  }
}

// Function to process the order
function processOrder($orderData) {
  try {
    // Implement your order processing logic here
    // For example, save the order details to a database

    // Connect to the database
    $conn = new mysqli('localhost', 'username', 'password', 'database');

    // Check the database connection
    if ($conn->connect_error) {
      throw new Exception('Database connection failed: ' . $conn->connect_error);
    }

    // Prepare the SQL statement
    $sql = "INSERT INTO orders (amount, currency, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind the parameters
    $stmt->bind_param('sss', $orderData['amount'], $orderData['currency'], $orderData['email']);

    // Execute the statement
    if ($stmt->execute()) {
      // Order saved successfully
      echo 'Order processed successfully.';
      // Log the successful order processing
      logMessage('Order processed successfully.');
    } else {
      // Failed to save order
      echo 'Failed to process the order.';
      // Log the error message
      logMessage('Failed to process the order.');
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
  } catch (Exception $e) {
    // Exception occurred
    echo 'An error occurred while processing the order.';
    echo 'Error details: ' . $e->getMessage();
    // Log the error message
    logMessage('An error occurred while processing the order: ' . $e->getMessage());
  }
}

// Function to log messages
function logMessage($message) {
  $logFile = 'log.txt'; // Specify the log file path

  // Append the message to the log file
  file_put_contents($logFile, $message . PHP_EOL, FILE_APPEND);
}

// Run unit tests (optional)
runUnitTests();

// Function to run unit tests
function runUnitTests() {
  // Implement your unit tests here
  // For example, using PHPUnit framework
  // Ensure that the code is tested in isolation and expected results are verified
  // This can help ensure that the code is working correctly and catch any issues early
}
?>
