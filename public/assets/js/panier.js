// Attente du chargement du DOM
document.addEventListener('DOMContentLoaded', function () {

// Récupérer le bouton du panier dans le header
const cartButton = document.getElementsByClassName('fa-cart-shopping')[0]; 
 // Récupérer le canvas (dans le bloc panier.html.twig)
const canvas = document.getElementById('canvas-overlay');
// Récupérer l'overlay du panier (dans le bloc panier.html.twig)
const cartOverlay = document.getElementById('cart-overlay'); 
// Récupérer le bouton de paiement
const payButton = document.getElementById('pay-button'); 
// Récupérer le message du client
const messageInput = document.getElementById('message-input');


/* +---------------------------+
   |   Ouverture / Fermeture   |
   +---------------------------+ */
// Ouvrir le panier
// Ajouter un événement pour ouvrir le panier lors du clic sur le bouton du panier
cartButton.addEventListener('click', function () {
	cartOverlay.style.right = '0';
	canvas.style.opacity = '1';
	canvas.style.width = '100%';
	updateCart();
});

// Fermer le panier
// Ajouter un événement pour fermer le panier lors du clic en dehors du panier
document.addEventListener('click', function (event) {
	// Si l'élément cliqué n'est pas le bouton d'ouverture du panier et n'est pas dans le panier, on ferme le panier
	if (!cartOverlay.contains(event.target) && !cartButton.contains(event.target)) {
		cartOverlay.style.right = '-100%';
		canvas.style.opacity = '0';
		canvas.style.width = '0';
	}
});

// Ajouter un événement pour fermer le panier lors du clic sur le bouton de fermeture
document.getElementById('close-cart').addEventListener('click', function () {
	cartOverlay.style.right = '-100%';
	canvas.style.opacity = '0';
	canvas.style.width = '0';
});






/* +---------------------------+
   |   Gestion du panier       |
   +---------------------------+ */
// Fonction pour mettre à jour l'affichage du panier
function updateCart() {
	// Récupérer les Id des articles dans le panier
	var panier = JSON.parse(localStorage.getItem('panier')) || [];
	let ids = [];
	panier.forEach(function (item) {
		ids.push(parseInt(item.id));
	});

	// Récupérer les articles via la requête AJAX
	fetch('/panier', {
		method: 'POST',
		headers: {
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({idsPanier: ids}),
	})
	.then(response => response.json())
	.then(data => {
		console.log(panier, ids, data);

		// Recreer un panier avec les articles récupérés et leur quantité avec un index
		var tmp = fusionnerTableaux(panier, data);
		panier = [...tmp]
		console.log("tmp", tmp, panier, panier.length);

		// Code pour afficher les articles du panier
		// Mettez à jour le total et autres informations nécessaires
		var cartContent = document.getElementById('cart-content');
		var totalAmountElement = document.getElementById('total-amount');

		// Afficher les articles du panier
		cartContent.innerHTML = '';
		panier.forEach(function (item, index) {
			console.log("panier", index, item);
			cartContent.innerHTML += `
				<div class="cart-item">
					<div class="cart-item-image-container">
						<img src="${item.image}" alt="${item.title}">
					</div>
					<div class="cart-item-content">
						<h4>${item.title}</h4>
						<p>${item.price}€</p>
						<div class="cart-item-quantity">
							<button class="cart-item-quantity-button" data-action="decrease" data-index="${index}">-</button>
							<input type="text" class="cart-item-quantity-input" value="${item.quantity}">
							<button class="cart-item-quantity-button" data-action="increase" data-index="${index}">+</button>
						</div>
						<button class="cart-item-remove-button" data-index="${index}">Supprimer</button>
					</div>
				</div>
			`;
		});

		// Afficher le total
		let totalAmount = 0;
		panier.forEach(function (item) {
			totalAmount += item.prix * item.quantite;
		});

		totalAmountElement.innerText = totalAmount.toFixed(2); // toFixed(2) pour afficher 2 chiffres après la virgule



		console.log('Réponse reçue:', data);
	})
	.catch(error => {
		console.error('Erreur lors de la récupération des objets du panier:', error);
	});
}







/* +--------------------------------+
   |   Gestion des événements       |
   +--------------------------------+ */
// Gérer la suppression d'un article du panier
// Mettez à jour le localStorage et l'affichage du panier
function removeCartItem(index) {
	var panier = JSON.parse(localStorage.getItem('panier')) || [];

	panier.splice(index, 1); // Supprimer l'article du panier à l'index donné

	localStorage.setItem('panier', JSON.stringify(panier));

	updateCart();
}

// Ecouter le clic sur le bouton de suppression d'un article du panier
document.addEventListener('click', function (event) {
	if (event.target.classList.contains('cart-item-remove-button')) {
		removeCartItem(event.target.getAttribute('data-index'));
	}
});


// Gérer la modification de la quantité d'un article du panier
// Mettez à jour le localStorage et l'affichage du panier
function updateCartItemQuantity(index, quantity) {
	var panier = JSON.parse(localStorage.getItem('panier')) || [];

	panier[index].quantite = quantity; // Modifier la quantité de l'article à l'index donné

	localStorage.setItem('panier', JSON.stringify(panier));

	updateCart();
}

// Ecouter le clic sur les boutons de modification de la quantité d'un article du panier
document.addEventListener('click', function (event) {
	if (event.target.classList.contains('cart-item-quantity-button')) {
		var index = event.target.getAttribute('data-index');
		var action = event.target.getAttribute('data-action');
		var quantityElement = event.target.parentNode.querySelector('.cart-item-quantity-input');

		var quantity = parseInt(quantityElement.value);

		if (action === 'decrease') {
			quantity--;
			if (quantity < 1) {
				removeCartItem(index);
				return;
			}
		} else if (action === 'increase') {
			quantity++;
		}

		updateCartItemQuantity(index, quantity);
	}
});



// Écouter le clic sur le bouton de paiement
payButton.addEventListener('click', function () {
	//const totalAmount = totalAmountElement.innerText;
	const totalAmount = 0;
	for (let i = 0; i < cartItems.length; i++) {
		totalAmount += cartItems[i].price * cartItems[i].quantity;
	}

	const message = messageInput.value;

	// Enregistrer le message dans le localStorage (on pourra recalculer le total dans la page de paiement)
	localStorage.setItem('message', message);

	// Code pour renvoyer vers la page de paiement
	// window.location.href = 'paiement';

	console.log(totalAmount, message);
});

// Initialiser le panier lors du chargement de la page
updateCart();
});



// Fonction pour fusionner deux tableaux d'objets
function fusionnerTableaux(tableau1, tableau2) {
	return tableau1.map(element1 => {
		const correspondance = tableau2.find(element2 => element2.id === element1.id);

		console.log(correspondance, element1, tableau2, element1.id);

		// Si une correspondance est trouvée, fusionnez les propriétés
		if (correspondance) {
			return { ...element1, ...correspondance };
		}

		// Sinon, retournez simplement l'élément du premier tableau
		return element1;
	});
}