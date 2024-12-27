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
});