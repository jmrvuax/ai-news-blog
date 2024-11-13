document.addEventListener('DOMContentLoaded', function() {
  var yearElement = document.getElementById('year');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }

  var contactForm = document.getElementById('contactForm');
  if (contactForm) {
    contactForm.addEventListener('submit', function(event) {
      event.preventDefault();

      var formData = new FormData(this);

      fetch('includes/functions/contact.php', {
        method: 'POST',
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error('Network response was not ok');
        }
        return response.text();
      })
      .then(text => {
        console.log('Response Text:', text);
        return JSON.parse(text);
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

  var menuIcon = document.getElementById('menu-icon');
  if (menuIcon) {
    menuIcon.addEventListener('click', function() {
      var navMenu = document.getElementById('nav-menu');
      if (navMenu) {
        navMenu.classList.toggle('show');
      }
    });
  }
});