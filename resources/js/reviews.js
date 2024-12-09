let offset = 0;
const limit = 10;
const userId = {{ json_encode($user->id) }};

document.addEventListener('DOMContentLoaded', function() {
    loadReviews();

    document.getElementById('load-more').addEventListener('click', function() {
        loadReviews();
    });
});

function loadReviews() {
    fetch(`/api/reviews/${userId}?offset=${offset}&limit=${limit}`)
        .then(response => response.json())
        .then(data => {
            const container = document.getElementById('reviews-container');
            data.reviews.forEach(review => {
                const reviewElement = document.createElement('div');
                reviewElement.classList.add("border-b", "pb-2", "mb-2");
                reviewElement.innerHTML = `<strong>${review.fromUser.name}:</strong> ${review.comment} - Rating: ${'★'.repeat(review.rating)}${'☆'.repeat(5 - review.rating)}<br><small>${new Date(review.created_at).toLocaleString()}</small>`;
                container.appendChild(reviewElement);
            });
            offset += limit;
            if (data.reviews.length < limit) {
                document.getElementById('load-more').style.display = 'none'; // Hide button if no more reviews
            }
        });
}