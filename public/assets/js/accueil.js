let currentIndex = 0;
const slidesContainer = document.querySelector('.carousel-accueil');
const totalSlides = 4;
const slidesToShow = 3;
const slideWidth = 480; // Largeur fixe de chaque slide en pixels
const windowWidth = window.innerWidth;

function showSlide(index) {
    const offset = -index * (windowWidth / 3) + 'px';
    slidesContainer.style.transform = 'translateX(' + offset + ')';
}

function prevSlide() {
    currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
    showSlide(currentIndex);
}

function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    showSlide(currentIndex);
}

document.addEventListener('DOMContentLoaded', function () {
    console.log('Largeur de la fenêtre :', (windowWidth/3));
    slidesContainer.style.width = totalSlides * (windowWidth/3) + 'px';
    document.querySelectorAll('.slide-accueil').forEach(function (slide) {
        slide.style.width = (windowWidth/3) + 'px';
    });
});
