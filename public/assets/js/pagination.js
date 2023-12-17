/* select nb d'object dans la base */
var nbObj = 50;

// ###########################################################
// TODO: Les donées sont à récupérer depuis la base de donnée 
// ###########################################################


/* Détermine le nombre de page */
var nbPage = Math.ceil(nbObj/16);


/* Afin d'utiliser la navigation par page, avoir les objets suivants : 
(on peut aussi les créer en js pour la modularité si on veut pour les autres pages)

		<div id="pagination-container">
			<nav id="pagination">
			</nav>
		</div>

*/


/* Ce qui sera crée : (si nbPage = 5 et pageActuelle = 1)

<span class="pagination-item pagination-item-previous-page pagination-item-disabled">
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M9.29289 11.2929C8.90237 11.6834 8.90237 12.3166 9.29289 12.7071L13.2929 16.7071C13.6834 17.0976 14.3166 17.0976 14.7071 16.7071C15.0976 16.3166 15.0976 15.6834 14.7071 15.2929L11.4142 12L14.7071 8.70711C15.0976 8.31658 15.0976 7.68342 14.7071 7.29289C14.3166 6.90237 13.6834 6.90237 13.2929 7.29289L9.29289 11.2929Z" fill="black"></path>
	</svg>
</span>
<span class="pagination-item pagination-item-current-page">1</span>
<a class="pagination-item generated-link-item" href="/produits?page=2">2</a>
<a class="pagination-item generated-link-item" href="/produits?page=3">3</a>
<a class="pagination-item generated-link-item" href="/produits?page=4">4</a>
<a class="pagination-item generated-link-item" href="/produits?page=5">5</a>
<a class="pagination-item generated-link-item pagination-item-next-page" href="/produits?page=2">
	<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M14.7071 12.7071C15.0976 12.3166 15.0976 11.6834 14.7071 11.2929L10.7071 7.29289C10.3166 6.90237 9.68342 6.90237 9.29289 7.29289C8.90237 7.68342 8.90237 8.31658 9.29289 8.70711L12.5858 12L9.29289 15.2929C8.90237 15.6834 8.90237 16.3166 9.29289 16.7071C9.68342 17.0976 10.3166 17.0976 10.7071 16.7071L14.7071 12.7071Z" fill="black"></path>
	</svg>
</a>

*/
url = window.location.href;
// decoupe avant le ?page=2
url = url.split("?")[0]; // Utile seulement ici en statique car les pages sont un (pas de 'vrai' redirection comme en dynam)

// Récupère argument de l'url
var urlParams = new URLSearchParams(window.location.search);
var page = urlParams.get('page');

// Si pas d'argument, c'est la page 1
if (page == null) {
	pageActuelle = 1;
}
else {
	pageActuelle = parseInt(page);
}

console.log(urlParams, page, pageActuelle);
//document.getElementById("pagination").innerHTML = 'DEBUG : pageActuelle = ' + pageActuelle + ' et nbPage = ' + nbPage + ' et url = ' + url;

/* Création de la pagination */
var pagination = document.getElementById("pagination");
var paginationContainer = document.getElementById("pagination-container");


/*
 +-------------------+
 |   Previous page   |
 +-------------------+
*/
if (pageActuelle == 1) {
	var paginationItemPreviousPage = document.createElement("span");
	paginationItemPreviousPage.classList.add("pagination-item");
	paginationItemPreviousPage.classList.add("pagination-item-previous-page");
	paginationItemPreviousPage.classList.add("pagination-item-disabled");
	paginationItemPreviousPage.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.29289 11.2929C8.90237 11.6834 8.90237 12.3166 9.29289 12.7071L13.2929 16.7071C13.6834 17.0976 14.3166 17.0976 14.7071 16.7071C15.0976 16.3166 15.0976 15.6834 14.7071 15.2929L11.4142 12L14.7071 8.70711C15.0976 8.31658 15.0976 7.68342 14.7071 7.29289C14.3166 6.90237 13.6834 6.90237 13.2929 7.29289L9.29289 11.2929Z" fill="black"></path></svg>';
	pagination.appendChild(paginationItemPreviousPage);
}
else {
	var paginationItemPreviousPage = document.createElement("a");
	paginationItemPreviousPage.classList.add("pagination-item");
	paginationItemPreviousPage.classList.add("pagination-item-previous-page");

	// On recupere l'url et on ajoute l'argument page
	let tempParams = new URLSearchParams(window.location.search);
	tempParams.set('page', pageActuelle - 1);
	paginationItemPreviousPage.setAttribute("href", url + '?' + tempParams.toString());
	//paginationItemPreviousPage.setAttribute("href", url + '?page=' + (pageActuelle - 1)); // Ne garde pas les autres arguments

	paginationItemPreviousPage.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.29289 11.2929C8.90237 11.6834 8.90237 12.3166 9.29289 12.7071L13.2929 16.7071C13.6834 17.0976 14.3166 17.0976 14.7071 16.7071C15.0976 16.3166 15.0976 15.6834 14.7071 15.2929L11.4142 12L14.7071 8.70711C15.0976 8.31658 15.0976 7.68342 14.7071 7.29289C14.3166 6.90237 13.6834 6.90237 13.2929 7.29289L9.29289 11.2929Z" fill="black"></path></svg>';
	pagination.appendChild(paginationItemPreviousPage);
}


/*
 +--------------------------+
 |   Pages intermédiaires   |
 +--------------------------+
*/
for (var i = 1; i <= nbPage; i++) {
	if (i == pageActuelle) {
		var paginationItemCurrentPage = document.createElement("span");
		paginationItemCurrentPage.classList.add("pagination-item");
		paginationItemCurrentPage.classList.add("pagination-item-current-page");
		paginationItemCurrentPage.innerHTML = i;
		pagination.appendChild(paginationItemCurrentPage);
	}
	else {
		var paginationItem = document.createElement("a");
		paginationItem.classList.add("pagination-item");
		paginationItem.classList.add("generated-link-item");

		// On recupere l'url et on ajoute l'argument page
		let tempParams = new URLSearchParams(window.location.search);
		tempParams.set('page', i);
		paginationItem.setAttribute("href", url + '?' + tempParams.toString());
		// paginationItem.setAttribute("href", url + "?page=" + i); // Ne garde pas les autres arguments

		paginationItem.innerHTML = i;
		pagination.appendChild(paginationItem);
	}
}

/*
 +---------------+
 |   Next page   |
 +---------------+
*/
if (pageActuelle == nbPage) {
	var paginationItemNextPage = document.createElement("span");
	paginationItemNextPage.classList.add("pagination-item");
	paginationItemNextPage.classList.add("pagination-item-next-page");
	paginationItemNextPage.classList.add("pagination-item-disabled");
	paginationItemNextPage.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.7071 12.7071C15.0976 12.3166 15.0976 11.6834 14.7071 11.2929L10.7071 7.29289C10.3166 6.90237 9.68342 6.90237 9.29289 7.29289C8.90237 7.68342 8.90237 8.31658 9.29289 8.70711L12.5858 12L9.29289 15.2929C8.90237 15.6834 8.90237 16.3166 9.29289 16.7071C9.68342 17.0976 10.3166 17.0976 10.7071 16.7071L14.7071 12.7071Z" fill="black"></path></svg>';
	pagination.appendChild(paginationItemNextPage);
}
else {
	var paginationItemNextPage = document.createElement("a");
	paginationItemNextPage.classList.add("pagination-item");
	paginationItemNextPage.classList.add("pagination-item-next-page");

	// On recupere l'url et on ajoute l'argument page
	let tempParams = new URLSearchParams(window.location.search);
	tempParams.set('page', pageActuelle + 1);
	paginationItemNextPage.setAttribute("href", url + '?' + tempParams.toString());
	// paginationItemNextPage.setAttribute("href", url + "?page=" + (pageActuelle + 1)); // Ne garde pas les autres arguments

	paginationItemNextPage.innerHTML = '<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M14.7071 12.7071C15.0976 12.3166 15.0976 11.6834 14.7071 11.2929L10.7071 7.29289C10.3166 6.90237 9.68342 6.90237 9.29289 7.29289C8.90237 7.68342 8.90237 8.31658 9.29289 8.70711L12.5858 12L9.29289 15.2929C8.90237 15.6834 8.90237 16.3166 9.29289 16.7071C9.68342 17.0976 10.3166 17.0976 10.7071 16.7071L14.7071 12.7071Z" fill="black"></path></svg>';
	pagination.appendChild(paginationItemNextPage);
}
