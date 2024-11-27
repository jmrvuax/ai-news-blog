document.addEventListener('DOMContentLoaded', function() {
  var loginForm = document.getElementById('loginForm');
  if (loginForm) {
    loginForm.addEventListener('submit', function(event) {
      event.preventDefault();

      // Client-side validation
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value.trim();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email === '' || password === '') {
        alert('All fields are required.');
        return;
      }

      if (!emailPattern.test(email)) {
        alert('Please enter a valid email address.');
        return;
      }

      var formData = new FormData(this);

      fetch('includes/functions/login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        console.log('Response Status:', response.status); // Log the response status
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(text => {
        console.log('Raw Response Text:', text); // Log the raw response
        return JSON.parse(text);
      })
      .then(data => {
        if (data.success) {
          document.getElementById('loginMessage').innerHTML = 'Login successful. Redirecting...';
          document.getElementById('loginMessage').style.display = 'block';
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        } else {
          alert(data.error);
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('There was an error logging in. Please try again.');
      });
    });
  }
});