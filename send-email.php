<?php
// SMTP Email Handler for Tarryn Manley Contact Form

header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// SMTP Configuration
$smtp_host = 'mail.tarrynmanley.com'; // or smtp.tarrynmanley.com
$smtp_port = 587; // or 465 for SSL
$smtp_username = 'tarryn@tarrynmanley.com';
$smtp_password = 'StanDaMan,123.';
$smtp_secure = 'tls'; // or 'ssl'

// Email settings
$to_email = 'tarryn@tarrynmanley.com';
$to_name = 'Tarryn Manley';

// Validate form data
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
	echo json_encode(['success' => false, 'message' => 'Invalid request method']);
	exit;
}

$senderName = trim($_POST['senderName'] ?? '');
$senderEmail = trim($_POST['senderEmail'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

// Basic validation
if (empty($senderName) || empty($senderEmail) || empty($subject) || empty($message)) {
	echo json_encode(['success' => false, 'message' => 'All fields are required']);
	exit;
}

if (!filter_var($senderEmail, FILTER_VALIDATE_EMAIL)) {
	echo json_encode(['success' => false, 'message' => 'Invalid email address']);
	exit;
}

// Create email content
$email_subject = "Contact Form: " . $subject;
$email_body = "
<html>
<head>
    <title>Contact Form Submission</title>
</head>
<body>
    <h2>New Contact Form Submission</h2>
    <p><strong>Name:</strong> " . htmlspecialchars($senderName) . "</p>
    <p><strong>Email:</strong> " . htmlspecialchars($senderEmail) . "</p>
    <p><strong>Subject:</strong> " . htmlspecialchars($subject) . "</p>
    <p><strong>Message:</strong></p>
    <div style='background: #f5f5f5; padding: 15px; border-left: 4px solid #fbff00;'>
        " . nl2br(htmlspecialchars($message)) . "
    </div>
    <hr>
    <p><small>This email was sent from the contact form on tarrynmanley.com</small></p>
</body>
</html>
";

// Try to send email using PHP's mail() function first (simpler approach)
$headers = [
	'MIME-Version: 1.0',
	'Content-type: text/html; charset=UTF-8',
	'From: ' . $senderName . ' <' . $senderEmail . '>',
	'Reply-To: ' . $senderEmail,
	'X-Mailer: PHP/' . phpversion()
];

try {
	$mail_sent = mail($to_email, $email_subject, $email_body, implode("\r\n", $headers));

	if ($mail_sent) {
		echo json_encode(['success' => true, 'message' => 'Email sent successfully']);
	} else {
		echo json_encode(['success' => false, 'message' => 'Failed to send email']);
	}
} catch (Exception $e) {
	echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
}
