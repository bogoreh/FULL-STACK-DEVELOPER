// Movie filtering functionality
document.addEventListener('DOMContentLoaded', function() {
    const genreFilter = document.getElementById('genreFilter');
    const languageFilter = document.getElementById('languageFilter');
    const movieCards = document.querySelectorAll('.movie-card');
    
    function filterMovies() {
        const selectedGenre = genreFilter.value;
        const selectedLanguage = languageFilter.value;
        
        movieCards.forEach(card => {
            const cardGenre = card.getAttribute('data-genre');
            const cardLanguage = card.getAttribute('data-language');
            
            const genreMatch = !selectedGenre || cardGenre.includes(selectedGenre);
            const languageMatch = !selectedLanguage || cardLanguage === selectedLanguage;
            
            if (genreMatch && languageMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
    
    if (genreFilter) genreFilter.addEventListener('change', filterMovies);
    if (languageFilter) languageFilter.addEventListener('change', filterMovies);
});

// Booking seat selection simulation
function simulateSeatSelection() {
    const seats = document.querySelectorAll('.seat');
    seats.forEach(seat => {
        seat.addEventListener('click', function() {
            this.classList.toggle('selected');
            updateTotalPrice();
        });
    });
}

function updateTotalPrice() {
    const selectedSeats = document.querySelectorAll('.seat.selected').length;
    const pricePerSeat = 200; // Example price
    document.getElementById('totalPrice').textContent = selectedSeats * pricePerSeat;
}