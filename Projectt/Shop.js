document.querySelector('form[role="search"]').addEventListener('submit', function (e) {
    e.preventDefault();

    const query = document.querySelector('input[name="query"]').value;

    fetch(`search.php?query=${encodeURIComponent(query)}`)
    .then(response => response.json())
    .then(products => {
        const cards = document.querySelectorAll('.card');
        const pages = document.querySelectorAll('.page');
        
        // Hide all cards and pages
        cards.forEach(card => card.style.display = 'none');
        pages.forEach(page => page.style.display = 'none');
        
        if (products.length > 0) {
            // Loop through the results and show matching cards
            products.forEach((product, index) => {
                const matchingCard = [...cards].find(card =>
                    card.querySelector('.card-title').textContent.trim() === product.name
                );
                if (matchingCard) {
                    matchingCard.style.display = 'block';
                    // Ensure matching cards are visible on the right page
                    const pageNum = Math.floor(index / 6) + 1;  // Show 6 items per page
                    document.getElementById(`page-${pageNum}`).style.display = 'block';
                }
            });
            generatePagination();  // Adjust pagination to match new results
        } else {
            alert("No products found");
        }
    })});