"use strict";

class Situ {
	constructor() {
		this.elSitu = document.getElementById('situ');
		this.elSituMdl = document.getElementById('mdl-situ');
		if (this.elSitu) {
			this.elSitu.addEventListener('click', (event) => {
				this.showSituSelection();
			});
		}
	}

	showSituSelection() {
		console.log('hello verse');
		this.elSituMdl.classList.remove('hidden');
	}

	load(item) {
		console.log("load item: ", item)
		this.elSitu.src = `/assets/images/situ/${item}.webp`;
	}
}

document.addEventListener('DOMContentLoaded', () => {
	window.SituInstance = new Situ();
});
