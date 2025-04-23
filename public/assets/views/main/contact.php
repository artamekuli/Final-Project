<?php

$host = 'localhost/8888';
$dbname = 'contact_form';  // The name of your database
$username = 'your_username';  // Your database username
$password = 'your_password';  // Your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database: " . $e->getMessage());
}

$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';

$errors = [];
if (empty($name)) {
    $errors[] = 'Please enter your name.';
}
if (empty($email)) {
    $errors[] = 'Please enter your email.';
}
if (empty($comment)) {
    $errors[] = 'Please enter your message.';
}

if (empty($errors)) {
    $sql = "INSERT INTO submissions (name, email, comment) VALUES (:name, :email, :comment)";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':comment', $comment);

    if ($stmt->execute()) {
        echo 'Thank you! Your message has been saved.';
    } else {
        echo 'Sorry, there was an error saving your message.';
    }
} else {
    // If there are validation errors, display them
    foreach ($errors as $error) {
        echo $error . '<br>';
    }
    echo '<a href="contact.html">Back to contact form</a>';
}

?>
