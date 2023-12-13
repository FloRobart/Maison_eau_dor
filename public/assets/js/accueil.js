let currentIndex = 0;
const slidesContainer = document.querySelector('.carousel-accueil');
const totalSlides = 4;
const slidesToShow = 3;
const slideWidth = 480; // Largeur fixe de chaque slide en pixels

function showSlide(index) {
    const offset = -index * slideWidth + 'px';
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
    slidesContainer.style.width = totalSlides * slideWidth + 'px';
    document.querySelectorAll('.slide-accueil').forEach(function (slide) {
        slide.style.width = slideWidth + 'px';
    });
});
