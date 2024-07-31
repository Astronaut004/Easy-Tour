
window.addEventListener('scroll', function() {
    const navbar = document.querySelector('.navbar');
    const myHeading = document.querySelector('.myheading');
    const myScrollHeading = document.querySelector('.my-scroll-heading');
    
    if (window.scrollY > 50) { // Adjust the value as needed
        navbar.classList.add('navbar-scrolled');
        myHeading.classList.add('hidden');
        myScrollHeading.classList.add('visible');
        myHeading.classList.remove('visible');
        // myScrollHeading.classList.remove('hidden');
    } else {
        navbar.classList.remove('navbar-scrolled');
        myHeading.classList.remove('hidden');
        myScrollHeading.classList.add('hidden');
        myScrollHeading.classList.remove('visible');
    }
});