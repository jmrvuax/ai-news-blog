<section>
  <h2>Login</h2>
  <div class="message" style="display: none;"></div>
  <form class="common-form" method="POST">
    <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
    <label for="email">Email:</label>
    <input type="email" name="email" required>
        
    <label for="password">Password:</label>
    <input type="password" name="password" required>
        
    <button type="submit">Login</button>
  </form>
</section>