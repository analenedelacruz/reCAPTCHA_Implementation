<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // reCAPTCHA verified
        $recaptcha_secret = "6LfF5kwqAAAAAHUeuMS7tqHK-MW7Rp6ev0HNcak1";
        $recaptcha_response = $_POST['g-recaptcha-response'];
        
        $verify_response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
        $response_data = json_decode($verify_response);

        if ($response_data->success) {
            // reCAPTCHA verification successful, and the form inputs are valid
            $client = htmlspecialchars($_POST['customer']);
            $phone = htmlspecialchars($_POST['cellphone']);
            $email = htmlspecialchars($_POST['email']);
            $msg = htmlspecialchars($_POST['message']);

            // Message successfully
            echo "<script>alert('Message submitted successfully!'); window.location.href='index.php';</script>";
            exit();
        } else {
            // The reCAPTCHA message you entered is incorrect
            echo "<script>alert('reCAPTCHA verification failed. Please try again.'); window.location.href='contact.php';</script>";
            exit();
        }
    } 
?>



<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>reCAPTCHA Implementation</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="styles.css">

        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    </head>
    <body>
        <div class="container">
            <h1>Contact Us</h1>
            <form action="contact.php" method="POST">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>  
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="3" required></textarea>
                </div>
                <div class="g-recaptcha" data-sitekey="6LfF5kwqAAAAACUCFSDWK9lD27VJIyiqQN7IQtgG"></div>
                <center><input type="submit" value="Send Message" class="submit"></center>
            </form>
            <center><a href="index.php" class="box">Back</a></center>
        </div>
        


    </body>
</html>