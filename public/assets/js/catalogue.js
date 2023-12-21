/*
+---------+
| DONNÉES | (brutes à remplacer par des appels via Symfony) [direct dans le code via PHP j'imagine]
+---------+ 
*/
// +----------------------+
// | Données des produits |
// +----------------------+


var produits = [
	{ id: "produit1", image: "images/ahlam.png", nom: "Produit 1", desc: "...", prix: "10.99" , tag: ["tag1", "tag2"], date: "2021-01-01" },
	{ id: "produit2", image: "images/ahlam.png", nom: "Produit 2", desc: "...", prix: "12.99" , tag: ["tag1", "tag3"], date: "2021-01-02" },
	{ id: "produit3", image: "images/ahlam.png", nom: "Produit 3", desc: "...", prix: "14.99" , tag: ["tag1", "tag4"], date: "2021-01-03" },
	{ id: "produit4", image: "images/ahlam.png", nom: "Produit 4", desc: "...", prix: "16.99" , tag: ["tag2", "tag3"], date: "2021-01-04" },

	{ id: "produit5", image: "images/ahlam.png", nom: "Produit 5", desc: "...", prix: "18.99" , tag: ["tag2", "tag4"], date: "2021-01-05" },
	{ id: "produit6", image: "images/ahlam.png", nom: "Produit 6", desc: "...", prix: "20.99" , tag: ["tag3", "tag4"], date: "2021-01-06" },
	{ id: "produit7", image: "images/ahlam.png", nom: "Produit 7", desc: "...", prix: "22.99" , tag: ["tag1", "tag2", "tag3"], date: "2021-01-07" },
	{ id: "produit8", image: "images/ahlam.png", nom: "Produit 8", desc: "...", prix: "24.99" , tag: ["tag1", "tag2", "tag4"], date: "2021-01-08" },
	{ id: "produit9", image: "images/ahlam.png", nom: "Produit 9", desc: "...", prix: "26.99" , tag: ["tag1", "tag3", "tag4"], date: "2021-01-09" },
	{ id: "produit10", image: "images/ahlam.png", nom: "Produit 10", desc: "...", prix: "28.99" , tag: ["tag2", "tag3", "tag4"], date: "2021-01-10" },
	{ id: "produit11", image: "images/ahlam.png", nom: "Produit 11", desc: "...", prix: "30.99" , tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-11" },
	{ id: "produit12", image: "images/ahlam.png", nom: "Produit 12", desc: "...", prix: "32.99" , tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-12" },
	{ id: "produit13", image: "images/ahlam.png", nom: "Produit 13", desc: "...", prix: "34.99" , tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-13" },
	
	// choisi une image au hasard parmi les 4 pour les produits suivants
	// { id: "produit5", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 5", desc: "...", prix: "18,99", tag: ["tag2", "tag4"], date: "2021-01-05" },
	// { id: "produit6", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 6", desc: "...", prix: "20,99", tag: ["tag3", "tag4"], date: "2021-01-06" },
	// { id: "produit7", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 7", desc: "...", prix: "22,99", tag: ["tag1", "tag2", "tag3"], date: "2021-01-07" },
	// { id: "produit8", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 8", desc: "...", prix: "24,99", tag: ["tag1", "tag2", "tag4"], date: "2021-01-08" },
	// { id: "produit9", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 9", desc: "...", prix: "26,99", tag: ["tag1", "tag3", "tag4"], date: "2021-01-09" },
	// { id: "produit10", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 10", desc: "...", prix: "28,99", tag: ["tag2", "tag3", "tag4"], date: "2021-01-10" },
	// { id: "produit11", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 11", desc: "...", prix: "30,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-11" },
	// { id: "produit12", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 12", desc: "...", prix: "32,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-12" },
	// { id: "produit13", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 13", desc: "...", prix: "34,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-13" },
	// { id: "produit14", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 14", desc: "...", prix: "36,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-14" },
	// { id: "produit15", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 15", desc: "...", prix: "38,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-15" },
	// { id: "produit16", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 16", desc: "...", prix: "40,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-16" },
	// { id: "produit17", image: "images/" + Math.floor(Math.random() * 4 + 1) + ".png", nom: "Produit 17", desc: "...", prix: "42,99", tag: ["tag1", "tag2", "tag3", "tag4"], date: "2021-01-17" },
];

/*
+-----------+
| RECHERCHE |
+-----------+ 
*/
// Listener pour la recherche (Enter ou clic sur l'icon)
document.getElementById("recherche").addEventListener("keyup", function(event) {
	if (event.key === "Enter") {
		rechercherProduit();
	}
});

document.getElementById("searchSubmitIcon").addEventListener("click", function() {
	rechercherProduit();
});

// Afficher le texte de la recherche dans le champ de recherche
var urlParams = new URLSearchParams(window.location.search);
var search = urlParams.get('search');
if (search != null) {
	document.getElementById("recherche").value = search;
}

// Fonction pour rechercher un produit en JS pour le moment (à remplacer par une requête PHP à la base de donnée)
// function rechercherProduit() {
// 	var recherche = document.getElementById("recherche").value.toLowerCase();
// 	var produits = document.getElementsByClassName("produit");

// 	for (var i = 0; i < produits.length; i++) {
// 		var produit = produits[i];
// 		var titre = produit.getElementsByClassName("description")[0].getElementsByTagName("h2")[0].textContent.toLowerCase();

// 		if (titre.indexOf(recherche) == -1) {
// 			produit.style.display = "none";
// 		} else {
// 			produit.style.display = "flex";
// 		}
// 	}
// }

// Fonction pour rechercher un produit (URL pour PHP)
function rechercherProduit() {
	var recherche = document.getElementById("recherche").value.toLowerCase();

	if (recherche == "") {
		window.location.href = window.location.href.split("?")[0];
	} else {
		window.location.href = window.location.href.split("?")[0] + "?search=" + recherche + "&sortField=name&sortDirection=asc"; 
	}
}













/*
+------------------+
|   FILTRE (TRI)   |
+------------------+ 
*/
// +---------------------+
// | Données des filtres |
// +---------------------+
var filtres = [
	{ id: "a-z",              nom: "A-Z",              actif: false, sort: "name",      direction: "asc"  },
	{ id: "z-a",              nom: "Z-A",              actif: false, sort: "name",      direction: "desc" },
	{ id: "prix-croissant",   nom: "Prix croissant",   actif: false, sort: "price",     direction: "asc"  },
	{ id: "prix-decroissant", nom: "Prix décroissant", actif: false, sort: "price",     direction: "desc" },
	// { id: "plus-recent",      nom: "Plus récent",      actif: false, sort: "createdAt", direction: "desc" }, // Pas de date pour le moment
	// { id: "plus-ancien",      nom: "Plus ancien",      actif: false, sort: "createdAt", direction: "asc"  }, // Pas de date pour le moment
];

// Détermine l'actif via l'URL
var urlParams = new URLSearchParams(window.location.search);
var sortField = urlParams.get('sortField');


// Si pas d'argument, c'est le filtre par défaut (peut être activé en décommentant les lignes ci-dessous)
/*if (sortField == null) {
	sortField = "name"; // filtre par défaut (filtres[0].id)
	sortDirection = "asc"; // ordre par défaut (filtres[0].id)
	filtres[0].actif = true;
}
else {
	sortDirection = urlParams.get('sortDirection');
}*/
sortDirection = urlParams.get('sortDirection');


// Détermine le filtre actif
filtres.forEach(function(filtre) {
	if (filtre.sort == sortField && filtre.direction == sortDirection) {
		filtre.actif = true;
	}
});

// +------------+
// | Traitement |
// +------------+
// Ajouter les filtres au menu
var tri = document.getElementById("tri");
filtres.forEach(function(filtre) {
	var a = document.createElement("a");
	

	// PERMET DE CREER LE LIEN EN GARDANT LES AUTRES PARAMETRES DE L'URL (ex: search)
	var url = window.location.href;
	if ( urlParams.get('search') != null ) { // si il y a un parametre search dans l'url
		url = window.location.href.split("?")[0] + "?search=" + urlParams.get('search') + "&sortField=" + filtre.sort + "&sortDirection=" + filtre.direction;
	}
	else {
		url = window.location.href.split("?")[0] + "?sortField=" + filtre.sort + "&sortDirection=" + filtre.direction;
	}
	a.href = url; 
	
	//a.href = window.location.href.split("?")[0] + "?sortField=" + filtre.sort + "&sortDirection=" + filtre.direction; // TODO : changer le lien pour qu'il renvoie vers la page avec le filtre PHP dans l'URL


	a.textContent = filtre.nom;
	a.id = filtre.id;

	if (filtre.actif) { a.className = "filtre-actif"; } 
	a.onclick = function() { trierProduits(); }; 

	tri.appendChild(a);
});

// si filtre actif, on affiche le nom du filtre actif dans le bouton
var filtresBtnText = document.getElementById("tri-btn-text");
let filtreActif = filtres.find(filtre => filtre.actif);
if (filtreActif != undefined) {
	filtresBtnText.textContent = filtres.find(filtre => filtre.actif).nom;
	filtresBtnText.style.fontWeight = "900"; 
}

// Ouvrir / fermer le menu des filtres (et nom si filtre actif)
document.getElementById("tri-btn").addEventListener("click", function(event) {
	var filtres = document.getElementById("tri");

	if (filtres.style.display == "none") {
		filtres.style.display = "block";
	} else {
		filtres.style.display = "none";
	}

	// Arrêter la propagation de l'événement pour éviter la fermeture immédiate
	event.stopPropagation();
});

/*
A-Z
Z-A
Prix croissant
Prix décroissant
Plus récent
Plus ancien
*/







/*
+----------+
| PRODUITS |
+----------+ 
*/
// Ajouter un écouteur de clic aux boutons générés
document.querySelectorAll('.produit button').forEach(function(button) {
	button.addEventListener('click', function(event) {
		var produitId = event.target.getAttribute('data-produit-id');
		ajouterAuPanier(produitId);
		event.stopPropagation();
	});
});

// Ajouter des écouteurs de clic aux éléments de produit pour rediriger vers la page du produit
document.querySelectorAll('.produit .image-container, .produit .description').forEach(function(element) {
	element.addEventListener('click', function(event) {
		var produitId = event.currentTarget.parentNode.id;
		window.location.href = 'produit.html?id=' + produitId;
		event.stopPropagation();
	});
});

// Ajouter produit au panier
function ajouterAuPanier(id) {
	/*var panier = JSON.parse(localStorage.getItem("panier"));

	if (panier == null) {
		panier = [];
	}

	panier.push(id);

	localStorage.setItem("panier", JSON.stringify(panier));*/
	console.log("Ajouté au panier : " + id);
}

// Fonction pour ajouter les catégories au menu









/* 
+--------------+
| WINDOW EVENT |
+--------------+ 
*/
// Fermer le menu des filtres si on clique ailleurs
window.addEventListener("click", function(event) {
	var filtres = document.getElementById("tri");
	
	if (event.target != filtres && event.target.parentNode != filtres) {
		filtres.style.display = "none";
	}
});
