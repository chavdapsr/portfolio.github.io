
  
    // Initialize EmailJS with your Public Key from EmailJS dashboard
    emailjs.init('gXgDqePCrg0m4E2Rw');

    // Handle form submission
    document.getElementById('contact-form').addEventListener('submit', function(event) {
      event.preventDefault();

      // Send email using EmailJS sendForm method
      emailjs.sendForm('service_g4luy68', 'template_nsczfxd', this)
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
  