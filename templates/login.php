<?php
$scripts = ['../js/login.js'];
?>
<section>
  <h2>Login</h2>
  <div id="loginMessage" style="display: none;"></div>
  <form id="loginForm">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    
    <button type="submit">Login</button>
  </form>
</section>