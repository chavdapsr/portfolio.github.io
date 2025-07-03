<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Send Email with EmailJS and Gmail SMTP</title>
  <!-- EmailJS SDK -->
  <script src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
</head>
<body>
  <h2 style="text-align: center;">Contact Form</h2>
  <form id="contact-form" style="max-width: 400px; margin: auto; display: flex; flex-direction: column; gap: 12px;">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required />
    
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required />
    
    <label for="message">Message:</label>
    <textarea name="html_message" id="message" required></textarea>
    
    <button type="submit">Send Email</button>
  </form>

  <script>
    // Initialize EmailJS with your Public Key from EmailJS dashboard
    emailjs.init('gXgDqePCrg0m4E2Rw');

    // Handle form submission
    document.getElementById('contact-form').addEventListener('submit', function(event) {
      event.preventDefault();

      // Send email using EmailJS sendForm method
      emailjs.sendForm('service_g4luy68', 'template_73cybip', this)
        .then(function(response) {
          alert('Email sent successfully!');
          console.log('SUCCESS:', response.status, response.text);
          // Optionally reset form
          event.target.reset();
        }, function(error) {
          alert('Failed to send email. Please try again.');
          console.error('FAILED:', error);
        });
    });
  </script>
</body>
</html>
