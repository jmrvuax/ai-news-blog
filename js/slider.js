document.addEventListener('DOMContentLoaded', function() {
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
      if (slidesContainer) {
        slidesContainer.style.transform = `translate3d(${offset}%, 0, 0)`;
        slidesContainer.style.webkitTransform = `translate3d(${offset}%, 0, 0)`;
      }
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
  });