<?php
$scripts = ['../js/contact.js'];
?>
<section>
  <h2>Contact us</h2>
  <div id="thankYouMessage" style="display: none;"></div>
  <form id="contactForm" class="commonForm" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="message">Message:</label>
    <textarea id="message" name="message" required></textarea>
    
    <button type="submit">Send</button>
  </form>
</section>