document.addEventListener("DOMContentLoaded", function() {
    var burgerIcon = document.getElementById('burger-icon');
    var closeIcon = document.getElementById('close-icon');
    var navHeader = document.querySelector('.nav-header');

            function updateDisplay() {
            var windowWidth = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;

            if (windowWidth > 768) {
                burgerIcon.style.display = 'none';
                closeIcon.style.display = 'none';
                navHeader.classList.remove('nav-active');
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

        updateDisplay();

        window.addEventListener('resize', updateDisplay);

    burgerIcon.addEventListener('click', function() {
        burgerIcon.style.display = 'none';
        closeIcon.style.display = 'block';

        navHeader.classList.add('nav-active');
    });

    closeIcon.addEventListener('click', function() {
        closeIcon.style.display = 'none';
        burgerIcon.style.display = 'block';

        navHeader.classList.remove('nav-active');
    });
});