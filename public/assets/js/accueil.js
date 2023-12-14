let currentIndex = 0;
const slidesContainer = document.querySelector('.carousel-accueil');
const totalSlides = 7; // Modifiez le total des slides à 6
const slidesToShow = 3;
let slideWidth;

function calculateSlideWidth() {
    slideWidth = slidesContainer.offsetWidth / slidesToShow;
}

function showSlide(index) {
    const offset = -index * slideWidth + 'px';
    slidesContainer.style.transform = 'translateX(' + offset + ')';
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;

    // Si l'index atteint (totalSlides - slidesToShow), réinitialisez l'index à zéro
    if (currentIndex === (totalSlides - slidesToShow)) {
        currentIndex = 0;
    }

    showSlide(currentIndex);
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + 4) % 4;

    // Si l'index atteint la première position, réinitialisez l'index à (totalSlides - slidesToShow)
    if (currentIndex === (totalSlides - slidesToShow)) {
        currentIndex = totalSlides - slidesToShow;
    }

    showSlide(currentIndex);
}



document.addEventListener('DOMContentLoaded', function () {
    calculateSlideWidth();
    
    // Recalculer la largeur des slides lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        calculateSlideWidth();
        showSlide(currentIndex);
    });

    slidesContainer.style.width = totalSlides * slideWidth + 'px';
    
    document.querySelectorAll('.slide-accueil').forEach(function (slide) {
        slide.style.width = slideWidth + 'px';
    });
});
