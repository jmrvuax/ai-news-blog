<?php
$scripts = ['../js/login.js'];
session_start();

// Generate CSRF token
$csrf_token = bin2hex(random_bytes(32));
$_SESSION['csrf_token'] = $csrf_token;
?>
<section>
  <h2>Login</h2>
  <div id="loginMessage" style="display: none;"></div>
  <form id="loginForm" class="commonForm" action="includes/functions/login.php" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $csrf_token; ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
  </form>
</section>