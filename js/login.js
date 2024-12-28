document.addEventListener('DOMContentLoaded', function() {
  var loginForm = document.getElementById('loginForm');
  var loginMessage = document.getElementById('loginMessage');

  if (loginForm) {
    loginForm.addEventListener('submit', function(event) {
      event.preventDefault();

      // Clear any previous messages
      loginMessage.style.display = 'none';
      loginMessage.textContent = '';

      // Client-side validation
      var email = document.getElementById('email').value.trim();
      var password = document.getElementById('password').value.trim();
      var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      if (email === '' || password === '') {
        loginMessage.style.display = 'block';
        loginMessage.style.color = 'red';
        loginMessage.textContent = 'All fields are required.';
        return;
      }

      if (!emailPattern.test(email)) {
        loginMessage.style.display = 'block';
        loginMessage.style.color = 'red';
        loginMessage.textContent = 'Please enter a valid email address.';
        return;
      }

      var formData = new FormData(this);

      fetch('/login', {
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
          loginMessage.style.display = 'block';
          loginMessage.style.color = 'green';
          loginMessage.textContent = 'Login successful. Redirecting...';
          setTimeout(() => {
            window.location.href = '/';
          }, 2000);
        } else {
          loginMessage.style.display = 'block';
          loginMessage.style.color = 'red';
          loginMessage.textContent = data.error;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        loginMessage.style.display = 'block';
        loginMessage.style.color = 'red';
        loginMessage.textContent = 'There was an error logging in. Please try again.';
      });
    });
  }
});