"use strict";


class Situ {
	constructor() {
		this.elSitu = document.getElementById('situ');
		this.elSituMdl = document.getElementById('mdl-situ');
		this.elGalleryFeatured = document.getElementById('galleryFeatured');
		this.elGalleryAll = document.getElementById('galleryAll');

		this.gallery = [];

		this.galleryCard = `<div class="col-4 gallery-card">
				<div class="img">
					<img src="./assets/images/gallery/{{fileName}}" />
				</div>
				<p class="title">{{title}}</p>
				<hr />
				<p>
					Dimensions: {{dimensions}}
				</p>
				<hr />
				<p>
					Concept: {{concept}}
				</p>
				<hr />
				<p>
					Year: {{year}}
				</p>
			</div>`;

		this.init();



		if (this.elSitu) {
			this.elSitu.addEventListener('click', (event) => {
				this.showSituSelection();
			});
		}
	}

	async init() {
		await this.loadGallery();
		const featuredGalleyItems = this.featuredGalleryItems();
		if (featuredGalleyItems.length > 0) {
			this.loadFeaturedGalleryItems();
		}
		this.loadAllGalleryItems();
	}

	async loadGallery() {
		await fetch('./assets/js/gallery.json')
			.then(response => response.json())
			.then(data => {
				this.gallery = data;
				console.log('gallery loaded:', this.gallery);
				// You can now use this.gallery to build your gallery
			})
			.catch(error => {
				console.error('Error loading gallery.json:', error);
			});

		if (this.elSitu) {
			this.elSitu.addEventListener('click', (event) => {
				this.showSituSelection();
			});
		}
	}

	featuredGalleryItems() {
		return this.gallery.filter(item => item.featured).slice(0, 3);
	}



	craftGalleryCard(item) {
		return `
    <div class="col-4 gallery-card">
      <div class="img">
        <img src="./assets/images/gallery/${item.fileName}" alt="${item.title}" />
      </div>
      <p class="title">${item.title}</p>
      <hr />
      <p>Dimensions: ${item.dimensions || 'N/A'}</p>
      <hr />
      <p>Concept: ${item.concept || 'N/A'}</p>
      <hr />
      <p>Year: ${item.year || 'N/A'}</p>
    </div>
  `;
	}

	loadFeaturedGalleryItems() {
		const items = this.featuredGalleryItems().map(item => this.craftGalleryCard(item)).join('');
		if(this.elGalleryFeatured) { 
		this.elGalleryFeatured.innerHTML = items;
		}
	}

	loadAllGalleryItems()
	{
		const items = this.gallery.map(item => this.craftGalleryCard(item)).join('');
		if(this.elGalleryAll)
		{
this.elGalleryAll.innerHTML = items;
		}
	}


	showSituSelection() {
		console.log('hello verse');
		this.elSituMdl.classList.remove('hidden');
	}

	load(item) {
		console.log("load item: ", item)
		this.elSitu.src = `./assets/images/situ/${item}.webp`;
	}
}

document.addEventListener('DOMContentLoaded', () => {
	window.SituInstance = new Situ();
});
