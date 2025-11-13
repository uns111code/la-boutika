    // console.log('Cart counter script loaded');
    
    // function updateCartCount() {
    //     fetch('/panier/compteur')
    //         .then(response => response.json())
    //         .then(data => {
    //             const cartCountElement = document.getElementById('cart-count');
    //             if (cartCountElement) {
    //                 cartCountElement.textContent = data.count;
    //             }
    //         });
    // }

    // // Mettre à jour après ajout au panier
    // document.getElementById('add-to-cart').addEventListener('click', function () {
    //     const productId = this.dataset.productId;

    //     fetch(`/panier/ajouter/${productId}`, {
    //         method: 'POST',
    //         headers: {
    //             'X-Requested-With': 'XMLHttpRequest'
    //         }
    //     })
    //     .then(response => response.json())
    //     .then(data => {
    //         document.getElementById('flash-message').innerHTML =
    //             `<div class="alert alert-success">${data.message}</div>`;
    //         updateCartCount(); // ✅ Mise à jour du compteur
    //     });
    // });

    // // Facultatif : mettre à jour au chargement de la page
    // updateCartCount();