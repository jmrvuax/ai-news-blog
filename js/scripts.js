document.getElementById('year').textContent = new Date().getFullYear();

document.getElementById('contactForm').addEventListener('submit', function(event) {
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
      document.getElementById('contactForm').reset();
    } else {
      alert('There was an error submitting your message. Please try again.');
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('There was an error submitting your message. Please try again.');
  });
});