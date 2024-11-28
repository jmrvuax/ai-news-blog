<?php
$scripts = ['../js/contact.js'];
session_start();

// Generate CSRF token
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<section>
  <h2>Contact us</h2>
  <div id="thankYouMessage" style="display: none;"></div>
  <form id="contactForm" class="commonForm">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Send</button>
  </form>
</section>