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
    var slidesContainer = document.querySelector('.slides');
    slidesContainer.style.transform = `translate3d(${offset}%, 0, 0)`;
    slidesContainer.style.webkitTransform = `translate3d(${offset}%, 0, 0)`;
  }

  var prevButton = document.querySelector('.prev');
  var nextButton = document.querySelector('.next');

  if (prevButton) {
    prevButton.addEventListener('click', function () {
      showSlide(currentIndex - 1);
    });
  }

  if (nextButton) {
    nextButton.addEventListener('click', function () {
      showSlide(currentIndex + 1);
    });
  }

  setInterval(function () {
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
            li.classList.add('news-item'); // Aplica la clase de estilo
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