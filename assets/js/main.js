"use strict";

class Situ
{
	constructor()
	{
		this.elSitu = document.getElementById('situ');
		this.elSituMdl = document.getElementById('mdl-situ');

		this.init();
	}

	init()
	{
		if(this.elSitu)
		{
			this.elSitu.addEventListener('click', (event) =>
			{
				this.showSituSelection();
			});
		}
	}

	showSituSelection()
	{
		console.log('Opening SITU selection modal');
		this.elSituMdl.classList.remove('hidden');
	}

	closeModal(event)
	{
		// If clicking on modal background or close button, close the modal
		if(!event || event.target === event.currentTarget || event.target.classList.contains('close'))
		{
			this.elSituMdl.classList.add('hidden');
		}
	}

	load(item)
	{
		console.log("Loading SITU item: ", item);
		this.elSitu.src = `./assets/images/situ/${item}.webp`;
		// Close the modal after selection
		this.elSituMdl.classList.add('hidden');
	}
}

document.addEventListener('DOMContentLoaded', () =>
{
	window.SituInstance = new Situ();
});
