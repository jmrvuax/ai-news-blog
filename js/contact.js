document.addEventListener('DOMContentLoaded', function() {
  var contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function(event) {
      event.preventDefault();

      // Client-side validation
      var name = document.getElementById('name').value.trim();
      var email = document.getElementById('email').value.trim();
      var message = document.getElementById('message').value.trim();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (name === '' || email === '' || message === '') {
        alert('All fields are required.');
        return;
      }

      if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return;
      }

      var formData = new FormData(this);

      fetch('/contact', {
        method: 'POST',
        credentials: 'same-origin',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.json();
      })
      .then(data => {
        if (data.success) {
          document.getElementById('thankYouMessage').innerHTML = 'Thank you, ' + data.name + '. Your message has been received.';
          document.getElementById('thankYouMessage').style.display = 'block';
          contactForm.reset();
        } else {
          alert('There was an error submitting your message. Please try again.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('There was an error submitting your message. Please try again.');
      });
    });
  }
});