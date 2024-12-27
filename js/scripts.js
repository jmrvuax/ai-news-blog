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

  // Slider functionality
  var slides = document.querySelectorAll('.slide');
  var currentIndex = 0;

  function showSlide(index) {
    if (index >= slides.length) {
      currentIndex = 0;
    } else if (index < 0) {
      currentIndex = slides.length - 1;
    } else {
      currentIndex = index;
    }
    var offset = -currentIndex * 100;
    document.querySelector('.slides').style.transform = 'translateX(' + offset + '%)';
  }

  document.querySelector('.prev').addEventListener('click', function() {
    showSlide(currentIndex - 1);
  });

  document.querySelector('.next').addEventListener('click', function() {
    showSlide(currentIndex + 1);
  });

  // Auto slide every 5 seconds
  setInterval(function() {
    showSlide(currentIndex + 1);
  }, 5000);

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
            li.innerHTML = '<h3>' + post.title + '</h3>' +
                           '<p>' + post.content.replace(/\n/g, '<br>') + '</p>' +
                           '<p><strong>Author:</strong> ' + post.author + '</p>' +
                           '<p><strong>Date:</strong> ' + post.created_at + '</p>';
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