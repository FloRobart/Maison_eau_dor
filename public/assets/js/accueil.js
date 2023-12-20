let currentIndex = 0;
const slidesContainer = document.querySelector('.carousel-accueil');
const totalSlides = 7;
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


//Deuxième carrousel : 
let currentIndex_bs = 0;
const slidesContainer_bs = document.querySelector('.carousel_bestsales-accueil');
const totalSlides_bs = 7; // Modifiez le total des slides à 6
const slidesToShow_bs = 3;
let slideWidth_bs;

function calculateSlideWidth_bs() {
    slideWidth_bs = slidesContainer_bs.offsetWidth / slidesToShow_bs;
}

function showSlide_bs(index) {
    const offset_bs = -index * slideWidth_bs + 'px';
    slidesContainer_bs.style.transform = 'translateX(' + offset_bs + ')';
}

function nextSlide_bs() {
    currentIndex_bs = (currentIndex_bs + 1) % totalSlides_bs;

    // Si l'index atteint (totalSlides_bs - slidesToShow_bs), réinitialisez l'index à zéro
    if (currentIndex_bs === (totalSlides_bs - slidesToShow_bs)) {
        currentIndex_bs = 0;
    }

    showSlide_bs(currentIndex_bs);
}

function prevSlide_bs() {
    currentIndex_bs = (currentIndex_bs - 1 + 4) % 4;

    // Si l'index atteint la première position, réinitialisez l'index à (totalSlides_bs - slidesToShow_bs)
    if (currentIndex_bs === (totalSlides_bs - slidesToShow_bs)) {
        currentIndex_bs = totalSlides_bs - slidesToShow_bs;
    }

    showSlide_bs(currentIndex_bs);
}

document.addEventListener('DOMContentLoaded', function () {
    calculateSlideWidth_bs();
    
    // Recalculer la largeur des slides lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        calculateSlideWidth_bs();
        showSlide_bs(currentIndex_bs);
    });

    slidesContainer_bs.style.width = totalSlides_bs * slideWidth_bs + 'px';
    
    document.querySelectorAll('.slidebs-accueil').forEach(function (slide) {
        slide.style.width = slideWidth_bs + 'px';
    });
});

