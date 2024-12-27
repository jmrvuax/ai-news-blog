document.addEventListener('DOMContentLoaded', function() {
  var registerForm = document.getElementById('registerForm');
  if (registerForm) {
    registerForm.addEventListener('submit', function(event) {
      event.preventDefault();

      // Client-side validation
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value.trim();
      var confirmPassword = document.getElementById('confirm_password').value.trim();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email === '' || password === '' || confirmPassword === '') {
        alert('All fields are required.');
        return;
      }

      if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return;
      }

      if (password !== confirmPassword) {
        alert('Passwords do not match.');
        return;
      }

      var formData = new FormData(this);

      fetch('/register', {
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
          document.getElementById('registerMessage').innerHTML = 'Registration successful. Redirecting to login...';
          document.getElementById('registerMessage').style.display = 'block';
          setTimeout(() => {
            window.location.href = '/login';
          }, 2000);
        } else {
          alert(data.error);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('There was an error registering. Please try again.');
      });
    });
  }
});