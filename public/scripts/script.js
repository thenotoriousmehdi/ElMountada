document.addEventListener('DOMContentLoaded', function() {
    setupDiaporama();
});


function setupDiaporama() {
    let currentIndex = 0;
    const slides = document.querySelectorAll('#diaporama .flex-shrink-0');
    const totalSlides = slides.length;

    function showNextSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        const diaporama = document.getElementById('diaporama');
        diaporama.style.transform = `translateX(-${currentIndex * 100}%)`;
    }

    setInterval(showNextSlide, 3000);
}