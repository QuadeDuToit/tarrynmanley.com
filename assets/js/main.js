"use strict";

class Situ
{
	constructor()
	{
		this.elSitu = document.getElementById('situ');
		this.elSituWrapper = document.getElementById('situ-wrapper');
		this.elSituModal = document.getElementById('situ-modal');
		this.currentRoom = 'coastal'; // Default room

		this.init();
	}

	init()
	{
		if(this.elSituWrapper)
		{
			// Click on the SITU wrapper to open modal
			this.elSituWrapper.addEventListener('click', (event) =>
			{
				this.showSituSelection();
			});
		}

		if(this.elSituModal)
		{
			// Close modal when clicking outside or on close button
			this.elSituModal.addEventListener('click', (event) =>
			{
				this.closeModal(event);
			});

			// Close button
			const closeBtn = this.elSituModal.querySelector('.situ-modal-close');
			if(closeBtn)
			{
				closeBtn.addEventListener('click', () => this.closeModal());
			}

			// Room selection options
			const roomOptions = this.elSituModal.querySelectorAll('.situ-room-option');
			roomOptions.forEach(option =>
			{
				option.addEventListener('click', (event) =>
				{
					event.stopPropagation();
					const room = option.dataset.room;
					const image = option.dataset.image;
					this.selectRoom(room, image);
				});
			});
		}

		// Set initial active room
		this.updateActiveRoom();
	}

	showSituSelection()
	{
		console.log('Opening SITU selection modal');
		if(this.elSituModal)
		{
			this.elSituModal.classList.add('active');
			document.body.style.overflow = 'hidden'; // Prevent background scrolling
		}
	}

	closeModal(event)
	{
		// If clicking on modal background or close button, close the modal
		if(!event || event.target === event.currentTarget || event.target.classList.contains('situ-modal-close'))
		{
			if(this.elSituModal)
			{
				this.elSituModal.classList.remove('active');
				document.body.style.overflow = ''; // Restore scrolling
			}
		}
	}

	selectRoom(room, image)
	{
		console.log("Selecting SITU room: ", room, image);

		if(this.elSitu)
		{
			// Update the main SITU image
			this.elSitu.src = `./assets/images/situ/${image}`;
			this.elSitu.alt = `Art piece in ${room} room setting`;
		}

		if(this.elSituWrapper)
		{
			// Update the wrapper data attribute
			this.elSituWrapper.dataset.room = room;
		}

		// Update current room and active state
		this.currentRoom = room;
		this.updateActiveRoom();

		// Close the modal after selection
		this.closeModal();
	}

	updateActiveRoom()
	{
		if(this.elSituModal)
		{
			const roomOptions = this.elSituModal.querySelectorAll('.situ-room-option');
			roomOptions.forEach(option =>
			{
				if(option.dataset.room === this.currentRoom)
				{
					option.classList.add('active');
				}
				else
				{
					option.classList.remove('active');
				}
			});
		}
	}

	// Keyboard navigation
	handleKeydown(event)
	{
		if(this.elSituModal && this.elSituModal.classList.contains('active'))
		{
			if(event.key === 'Escape')
			{
				this.closeModal();
			}
		}
	}
}

document.addEventListener('DOMContentLoaded', () =>
{
	window.SituInstance = new Situ();

	// Add keyboard event listener
	document.addEventListener('keydown', (event) =>
	{
		if(window.SituInstance)
		{
			window.SituInstance.handleKeydown(event);
		}
	});
});
