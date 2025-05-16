    document.getElementById('add-to-cart').addEventListener('click', function () {
        const productId = this.dataset.productId;

        fetch(`/panier/ajouter/${productId}`, {
            method: 'POST',
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            const messageDiv = document.getElementById('flash-message');
            if (data.success) {
                messageDiv.innerHTML = `<div class="alert alert-success">${data.message}</div>`;
            } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">Erreur lors de l’ajout au panier.</div>`;
            }
        })
        .catch(error => {
            console.error('Erreur AJAX :', error);
        });
    });
