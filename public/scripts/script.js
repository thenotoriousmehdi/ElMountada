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


document.addEventListener('DOMContentLoaded', function() {
    const container = document.querySelector('.container');
    const gridContainer = container.querySelector('.grid');
    const cards = Array.from(gridContainer.children);

    // If there are 3 or fewer cards, no need for carousel
    if (cards.length <= 3) return;

    // Create carousel navigation
    const carouselNav = document.createElement('div');
    carouselNav.className = 'flex justify-center items-center space-x-4 mt-6';
    
    const prevButton = document.createElement('button');
    prevButton.innerHTML = '&larr;';
    prevButton.className = 'bg-primary text-white px-4 py-2 rounded';
    
    const nextButton = document.createElement('button');
    nextButton.innerHTML = '&rarr;';
    nextButton.className = 'bg-primary text-white px-4 py-2 rounded';
    
    carouselNav.appendChild(prevButton);
    carouselNav.appendChild(nextButton);
    container.appendChild(carouselNav);

    // Initial setup
    let currentIndex = 0;
    const cardsPerView = {
        mobile: 1,
        tablet: 2,
        desktop: 3
    };

    function updateCarousel() {
        // Determine cards per view based on screen width
        let viewCount = window.innerWidth < 640 ? cardsPerView.mobile 
                      : window.innerWidth < 1024 ? cardsPerView.tablet 
                      : cardsPerView.desktop;

        // Hide all cards
        cards.forEach(card => {
            card.classList.add('hidden');
        });

        // Show correct cards
        for (let i = 0; i < viewCount; i++) {
            const index = (currentIndex + i) % cards.length;
            cards[index].classList.remove('hidden');
        }
    }

    // Next button functionality
    nextButton.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % cards.length;
        updateCarousel();
    });

    // Previous button functionality
    prevButton.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + cards.length) % cards.length;
        updateCarousel();
    });

    // Initial display and responsive updates
    updateCarousel();
    window.addEventListener('resize', updateCarousel);
});


