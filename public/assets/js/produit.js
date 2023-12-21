
/* +------------+
   |   Panier   |
   +------------+ */




/* +-----------------------+
   |   Acheter un produit  |
   +-----------------------+ */
// Ajouter un produit au panier
function ajouterAuPanier(id) {
	var panier = JSON.parse(localStorage.getItem("panier"));

	if (panier == null) {
		panier = [];
	}

	panier.push(id);

	localStorage.setItem("panier", JSON.stringify(panier));
	console.log("Ajouté au panier : " + id);
}

// click event (ajouter au panier et redirection vers paiement)
document.getElementById("ajouter-au-panier").addEventListener("click", function() {
	ajouterAuPanier(document.getElementById("id").value);
	window.location.href = "paiement";
});




/* +-----------------------+
   |   Quantité de produit |
   +-----------------------+ */
// Le bouton + et - pour augmenter ou diminuer la quantité de produit dans le panier
var plus = document.getElementById("plus");
var moins = document.getElementById("moins");

console.log(plus, moins);

// Modification de la quantité de produit dans le panier
plus.addEventListener("click", function() {
	quantite.value = parseInt(quantite.value) + 1;
	triggerChangeEvent(quantite);
});

moins.addEventListener("click", function() {
	if (quantite.value > 1) {
		quantite.value = parseInt(quantite.value) - 1;
		triggerChangeEvent(quantite);
	}
});

// Si la quantité de produit est supérieure à 1, on affiche le bouton - pour diminuer la quantité de produit dans le panier
var quantite = document.getElementById("quantite");

quantite.addEventListener("change", function() {
	let tmp = parseInt(quantite.value);
	// Si la quantité est inférieure à 1, on la remet à 1 
	if (isNaN(tmp) || tmp < 1) { quantite.value = 1; }

	console.log(quantite.value);
	// Si la quantité est supérieure à 1, on affiche le bouton -
	if (quantite.value > 1) {
		document.getElementById("moins").style.display = "inline-block";
	} else {
		document.getElementById("moins").style.display = "none";
	}
});

// Fonction pour déclencher manuellement l'événement "change" sur un élément (n'est pas déclenché si fait programmatiquement)
function triggerChangeEvent(element) {
	var event = new Event("change");
	element.dispatchEvent(event);
}


// onload on remet la quantité à 1 si elle ne l'est pas déjà
window.onload = function() {
	if (quantite.value != 1) {
		quantite.value = 1;
		triggerChangeEvent(quantite);
	}
}








