/**
 * Simple Concept Modal Functionality
 * Global functions for showing/hiding concept modals
 */

// Cache for gallery data
let galleryData = null;

// Load gallery data
async function loadGalleryData()
{
	if(galleryData) return galleryData;

	try
	{
		const response = await fetch('./assets/js/gallery.json');
		galleryData = await response.json();
		return galleryData;
	} catch(error)
	{
		console.error('Failed to load gallery data:', error);
		return [];
	}
}

// Global function to show concept modal by artwork ID
async function showConceptModalById(artworkId)
{
	const data = await loadGalleryData();

	// Find artwork by ID (filename without extension or title slug)
	const artwork = data.find(item =>
	{
		if(item.fileName)
		{
			const fileNameWithoutExt = item.fileName.replace(/\.[^/.]+$/, "");
			if(fileNameWithoutExt === artworkId) return true;
		}
		if(item.title)
		{
			const titleSlug = item.title.toLowerCase()
				.replace(/[^a-z0-9\s-]/g, '')
				.replace(/[\s-]+/g, '-')
				.replace(/^-+|-+$/g, '');
			if(titleSlug === artworkId) return true;
		}
		return false;
	});

	if(artwork)
	{
		showConceptModal(artwork.title || 'Artwork', artwork.concept || 'No concept available');
	} else
	{
		console.error('Artwork not found:', artworkId);
	}
}

// Global function to show concept modal
function showConceptModal(title, content)
{
	// Create modal if it doesn't exist
	if(!document.getElementById('conceptModal'))
	{
		createConceptModal();
	}

	// Update content and show modal
	document.getElementById('modalTitle').textContent = title;
	document.getElementById('modalContent').innerHTML = content.replace(/\n/g, '<br>');

	const modal = document.getElementById('conceptModal');
	modal.style.display = 'flex';

	// Trigger fade-in animation
	setTimeout(() =>
	{
		modal.classList.add('show');
	}, 10);

	document.body.style.overflow = 'hidden'; // Prevent background scrolling
}

// Global function to close concept modal
function closeConceptModal()
{
	const modal = document.getElementById('conceptModal');
	if(!modal) return;

	modal.classList.remove('show');
	// Wait for animation to complete before hiding
	setTimeout(() =>
	{
		modal.style.display = 'none';
		document.body.style.overflow = 'auto'; // Restore scrolling
	}, 300);
}

// Function to create the modal HTML
function createConceptModal()
{
	const modalHtml = `
        <div id="conceptModal" class="concept-modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 id="modalTitle">Artwork Concept</h3>
                    <button class="close-btn" onclick="closeConceptModal()">&times;</button>
                </div>
                <div class="modal-body">
                    <p id="modalContent"></p>
                </div>
            </div>
        </div>
    `;
	document.body.insertAdjacentHTML('beforeend', modalHtml);

	// Add click outside to close functionality
	const modal = document.getElementById('conceptModal');
	modal.addEventListener('click', (e) =>
	{
		if(e.target === modal)
		{
			closeConceptModal();
		}
	});
}

// Close modal with Escape key
document.addEventListener('keydown', (e) =>
{
	if(e.key === 'Escape')
	{
		const modal = document.getElementById('conceptModal');
		if(modal && modal.classList.contains('show'))
		{
			closeConceptModal();
		}
	}
});

// Initialize when DOM is ready (just in case we need early setup)
document.addEventListener('DOMContentLoaded', function ()
{
	// Modal will be created when first needed
	console.log('Concept modal ready');
});
