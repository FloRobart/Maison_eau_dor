// Fonction pour obtenir la largeur de la fenêtre
// Variable globale pour stocker la largeur de la fenêtre
var largeurFenetreActuelle;

// Fonction pour obtenir la largeur de la fenêtre
function obtenirLargeurFenetre() {
  // Retourne la largeur actuelle de la fenêtre
  return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
}

// Fonction de mise à jour de la largeur de la fenêtre
function mettreAJourLargeurFenetre() {
  // Obtient la largeur de la fenêtre
  largeurFenetreActuelle = obtenirLargeurFenetre();
  
  // Mettez ici le code que vous souhaitez exécuter avec la nouvelle largeur
  
  // Exemple : Affiche la largeur dans la console
  console.log("Largeur de la fenêtre : " + largeurFenetreActuelle);

  // Vous pouvez appeler d'autres fonctions et leur passer la largeur de la fenêtre
  //autreFonctionUtilisantLargeur(largeurFenetreActuelle);
}

// Ajouter un gestionnaire d'événements pour le redimensionnement de la fenêtre
window.addEventListener('resize', mettreAJourLargeurFenetre);

// Appel initial pour définir la largeur au chargement de la page
mettreAJourLargeurFenetre();

let currentIndex_bs = 0;
const slidesContainer_bs = document.querySelector('.carousel_bestsales-accueil');
const totalSlides_bs = 7;
let slidesToShow_bs = 3; // Nombre initial de slides à afficher
let slideWidth_bs;
const slideMargin_bs = 20; // Espacement entre les slides

function calculateSlideWidth_bs() {
    slideWidth_bs = (largeurFenetreActuelle - (slidesToShow_bs - 1) * slideMargin_bs) / slidesToShow_bs;
}

function calculateSlidesToShow_bs() {
    // Ajustez le nombre de slides à afficher en fonction de la largeur de la fenêtre
    if (largeurFenetreActuelle < 500) {
        slidesToShow_bs = 1;
    } else if (largeurFenetreActuelle < 1000) {
        slidesToShow_bs = 2;
    } else {
        slidesToShow_bs = 3;
    }
}

function showSlide_bs(index) {
    const offset_bs = -index * (slideWidth_bs + slideMargin_bs) + 'px';
    slidesContainer_bs.style.transform = 'translateX(' + offset_bs + ')';
}

function updateSlideWidth_bs() {
    calculateSlideWidth_bs();
    slidesContainer_bs.style.width = totalSlides_bs * (slideWidth_bs + slideMargin_bs) - slideMargin_bs + 'px';
    document.querySelectorAll('.slidebs-accueil').forEach(function (slide) {
        slide.style.width = slideWidth_bs + 'px';
        slide.style.marginRight = slideMargin_bs + 'px';
    });
}

function updateSlidesToShow_bs() {
    calculateSlidesToShow_bs();
    updateSlideWidth_bs();
    showSlide_bs(currentIndex_bs);
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
    calculateSlidesToShow_bs();
    updateSlideWidth_bs();

    // Recalculer la largeur des slides lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        largeurFenetreActuelle = obtenirLargeurFenetre();
        requestAnimationFrame(updateSlidesToShow_bs);
    });
});

//Deuxième carousel
let currentIndex = 0;
const slidesContainer = document.querySelector('.carousel-accueil');
const totalSlides = 7;
let slidesToShow = 3; // Nombre initial de slides à afficher
let slideWidth;
const slideMargin = 20; // Espacement entre les slides

function calculateSlideWidth() {
    slideWidth = (largeurFenetreActuelle - (slidesToShow - 1) * slideMargin) / slidesToShow;
}

function calculateSlidesToShow() {
    // Ajustez le nombre de slides à afficher en fonction de la largeur de la fenêtre
    if (largeurFenetreActuelle < 500) {
        slidesToShow = 1;
    } else if (largeurFenetreActuelle < 1000) {
        slidesToShow = 2;
    } else {
        slidesToShow = 3;
    }
}

function showSlide(index) {
    const offset = -index * (slideWidth + slideMargin) + 'px';
    slidesContainer.style.transform = 'translateX(' + offset + ')';
}

function updateSlideWidth() {
    calculateSlideWidth();
    slidesContainer.style.width = totalSlides * (slideWidth + slideMargin) - slideMargin + 'px';
    document.querySelectorAll('.slide-accueil').forEach(function (slide) {
        slide.style.width = slideWidth + 'px';
        slide.style.marginRight = slideMargin + 'px';
    });
}

function updateSlidesToShow() {
    calculateSlidesToShow();
    updateSlideWidth();
    showSlide(currentIndex);
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
    calculateSlidesToShow();
    updateSlideWidth();

    // Recalculer la largeur des slides lors du redimensionnement de la fenêtre
    window.addEventListener('resize', function () {
        largeurFenetreActuelle = obtenirLargeurFenetre();
        requestAnimationFrame(updateSlidesToShow);
    });
});




  