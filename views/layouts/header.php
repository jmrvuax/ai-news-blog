<header>
  <nav>
    <div class="menu-icon" id="menu-icon">
      &#9776;
    </div>
    <a href="/" class="home-link"><h1>AI News</h1></a>
    <ul id="nav-menu">
      <li><a href="/">Home</a></li>
      <li><a href="/about">About</a></li>
      <li><a href="/contact">Contact</a></li>
      <?php if (isset($_SESSION['user'])): ?>
        <li><a href="/messages">Messages</a></li>
        <li><a href="/logout">Logout</a></li>
      <?php else: ?>
        <li><a href="/login">Login</a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>