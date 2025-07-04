<?php
session_start();
require_once __DIR__ . '/../config/database.php';

// Initialize response array
$response = [
    'success' => false,
    'message' => 'An error occurred',
    'redirect' => ''
];

try {
    // Create database connection
    $db = getDBConnection();
    
    // Only process POST requests
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method');
    }

    // Get form data (already validated client-side)
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $password = $_POST['password'] ?? '';
    $otp = $_POST['otp'] ?? '';

    // Basic sanitization (without duplicating validation)
    $firstName = htmlspecialchars(trim($firstName));
    $lastName = htmlspecialchars(trim($lastName));
    $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    $mobile = preg_replace('/[^0-9]/', '', $mobile);

    // Verify OTP if in verification step
    if (!empty($_POST['otp_verification'])) {
        if (empty($_SESSION['otp_data']) || 
            $_SESSION['otp_data']['otp'] !== $otp || 
            strtotime($_SESSION['otp_data']['expires_at']) < time()) {
            throw new Exception('Invalid or expired OTP');
        }
    }

    // Hash password
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    if ($passwordHash === false) {
        throw new Exception('Password hashing failed');
    }

    // Begin transaction
    $db->beginTransaction();

    try {
        // Insert customer data
        $stmt = $db->prepare("
            INSERT INTO customers 
            (first_name, last_name, email, mobile, password_hash, created_at, updated_at) 
            VALUES (?, ?, ?, ?, ?, NOW(), NOW())
        ");
        $stmt->execute([$firstName, $lastName, $email, $mobile, $passwordHash]);
        $customerId = $db->lastInsertId();
        
        // Mark OTP as used if verification was done
        if (!empty($_POST['otp_verification'])) {
            $stmt = $db->prepare("
                UPDATE customers 
                SET mobile_verified = 1 
                WHERE id = ?
            ");
            $stmt->execute([$customerId]);
            
            // Clear OTP session data
            unset($_SESSION['otp_data']);
        }

        // Commit transaction
        $db->commit();

        // Set session variables
        $_SESSION['user_id'] = $customerId;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $firstName . ' ' . $lastName;
        $_SESSION['logged_in'] = true;

        $response['success'] = true;
        $response['message'] = 'Registration successful!';
        $response['redirect'] = 'dashboard.php';

    } catch (PDOException $e) {
        $db->rollBack();
        
        // Handle duplicate entries
        if ($e->errorInfo[1] === 1062) { // MySQL duplicate entry error code
            $response['message'] = 'Email or mobile number already registered';
        } else {
            $response['message'] = 'Database error: ' . $e->getMessage();
        }
    }
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);