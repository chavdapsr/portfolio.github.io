<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chavda Psr - Portfolio</title>
    <!-- External Libraries -->
    <link href="neumorphism.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/choreographer-js/1.0.0/choreographer.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/multiple.js/0.0.1/multiple.min.js"></script>
    <style>
        /* ...existing code... */
    </style>
</head>
<body>
    <div class="particles" id="particles"></div>
    <div class="container">
        <!-- ...existing code... -->
        <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php'; // Make sure to install PHPMailer via Composer

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_submit'])) {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'chavda096@gmail.com'; // Your Gmail address
        $mail->Password = 'zews mjvf zqee hoqa'; // Your Gmail App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;
        $mail->setFrom($email, $name);
        $mail->addAddress('chavda096@gmail.com'); // Your receiving email
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body = "<h3>New Message from Portfolio Contact Form</h3>"
            ."<p><strong>Name:</strong> $name</p>"
            ."<p><strong>Email:</strong> $email</p>"
            ."<p><strong>Message:</strong> $message</p>";
        $mail->send();
        $success = "Message sent successfully!";
    } catch (Exception $e) {
        $error = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
        <div class="contact-form glow-border" id="contact" data-aos="fade-up" data-aos-duration="1000">
            <h2 class="card-title">Get In Touch</h2>
            <?php if (isset($success)): ?>
                <div class="message success" style="background:#dff0d8;color:#3c763d;padding:10px;border-radius:4px;margin-bottom:15px;">
                    <?php echo $success; ?>
                </div>
            <?php elseif (isset($error)): ?>
                <div class="message error" style="background:#f2dede;color:#a94442;padding:10px;border-radius:4px;margin-bottom:15px;">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            <form method="post" action="#contact">
                <div class="form-group" data-aos="slide-right" data-aos-delay="100">
                    <label class="form-label" for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-input" required>
                </div>
                <div class="form-group" data-aos="slide-left" data-aos-delay="200">
                    <label class="form-label" for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-input" required>
                </div>
                <div class="form-group" data-aos="slide-right" data-aos-delay="300">
                    <label class="form-label" for="message">Message</label>
                    <textarea id="message" name="message" class="form-textarea" rows="5" required></textarea>
                </div>
                <button type="submit" name="contact_submit" class="form-button morph-button tooltip" data-tooltip="Send your message" data-aos="zoom-in" data-aos-delay="400">Send Message</button>
            </form>
        </div>
        <!-- ...existing code... -->
    </div>
    <script>
        /* ...existing code... */
    </script>
    <script src="script.js"></script> 
</body>
</html>
