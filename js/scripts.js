document.addEventListener('DOMContentLoaded', function() {
  // Set the current year in the footer
  var yearElement = document.getElementById('year');
  if (yearElement) {
    yearElement.textContent = new Date().getFullYear();
  }

  // Toggle the hamburger menu
  var menuIcon = document.getElementById('menu-icon');
  if (menuIcon) {
    menuIcon.addEventListener('click', function() {
      var navMenu = document.getElementById('nav-menu');
      if (navMenu) {
        navMenu.classList.toggle('show');
      }
    });
  }

  // Load More functionality
  var loadMoreButton = document.getElementById('load-more');
  if (loadMoreButton) {
    loadMoreButton.addEventListener('click', function() {
      var page = parseInt(this.getAttribute('data-page')) + 1;
      var xhr = new XMLHttpRequest();
      xhr.open('GET', '/posts/loadMore?page=' + page, true);
      xhr.onload = function() {
        if (xhr.status === 200) {
          var posts = JSON.parse(xhr.responseText);
          var postList = document.getElementById('post-list');
          posts.forEach(function(post) {
            var li = document.createElement('li');
            li.classList.add('news-item');
            li.innerHTML = `
              <a href="/posts/${post.id}" class="news-link">
                <h3 class="news-title">${post.title}</h3>
                <p class="news-content">${post.content.replace(/\n/g, '<br>').substring(0, 100)}...</p>
                <p class="news-meta">
                  <span class="news-author"><strong>Author:</strong> ${post.author}</span> |
                  <span class="news-date"><strong>Date:</strong> ${post.created_at}</span>
                </p>
              </a>
            `;
            postList.appendChild(li);
          });
          loadMoreButton.setAttribute('data-page', page);
          if (posts.length < 5) {
            loadMoreButton.style.display = 'none';
          }
        }
      };
      xhr.send();
    });
  }
});