document.addEventListener("DOMContentLoaded", function() {
    // Sélectionnez les éléments du DOM
    var burgerIcon = document.getElementById('burger-icon');
    var closeIcon = document.getElementById('close-icon');
    var navHeader = document.querySelector('.nav-header');

            function updateDisplay() {
            var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            // Vérifiez si la largeur de la fenêtre dépasse 768px
            if (windowWidth > 768) {
                burgerIcon.style.display = 'none';
                closeIcon.style.display = 'none';
                navHeader.classList.remove('nav-active'); // Assurez-vous que la classe est retirée
            } else {
                
                if (navHeader.classList.contains('nav-active')) {
                    closeIcon.style.display = 'block';
                    burgerIcon.style.display = 'none';
                } else {
                    burgerIcon.style.display = 'block';
                    closeIcon.style.display = 'none';
                }
            }
        }

        // Appelez la fonction au chargement de la page
        updateDisplay();

        // Ajoutez un écouteur d'événement au redimensionnement de la fenêtre
        window.addEventListener('resize', updateDisplay);

    // Ajoutez un écouteur d'événement au clic sur le burger icon
    burgerIcon.addEventListener('click', function() {
        // Cachez le burger icon
        burgerIcon.style.display = 'none';
        // Affichez le close icon
        closeIcon.style.display = 'block';

        navHeader.classList.add('nav-active');
    });

    // Ajoutez un écouteur d'événement au clic sur le close icon
    closeIcon.addEventListener('click', function() {
        // Cachez le close icon
        closeIcon.style.display = 'none';
        // Affichez le burger icon
        burgerIcon.style.display = 'block';

        navHeader.classList.remove('nav-active');
    });
});