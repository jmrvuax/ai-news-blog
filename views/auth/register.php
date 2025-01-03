<section>
  <h2>Register</h2>
  <div id="registerMessage" class="message" style="display: none;"></div>
  <form class="common-form" id="registerForm" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
        
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
        
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" id="confirm_password" name="confirm_password" required>
        
    <button type="submit">Register</button>
  </form>
</section>