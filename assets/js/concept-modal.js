/**
 * Concept Modal Functionality
 * Provides truncated concept display with modal expansion
 */

class ConceptModal
{
	constructor()
	{
		this.modal = null;
		this.init();
	}

	init()
	{
		// Create modal if it doesn't exist
		if(!document.getElementById('conceptModal'))
		{
			this.createModal();
		}
		this.modal = document.getElementById('conceptModal');
		this.bindEvents();
	}

	createModal()
	{
		const modalHtml = `
            <div id="conceptModal" class="concept-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 id="modalTitle">Artwork Concept</h3>
                        <button class="close-btn" onclick="conceptModal.close()">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p id="modalContent"></p>
                    </div>
                </div>
            </div>
        `;
		document.body.insertAdjacentHTML('beforeend', modalHtml);
		this.modal = document.getElementById('conceptModal');
	}

	bindEvents()
	{
		if(!this.modal) return;

		// Close modal when clicking outside the content
		this.modal.addEventListener('click', (e) =>
		{
			if(e.target === this.modal)
			{
				this.close();
			}
		});

		// Close modal with Escape key
		document.addEventListener('keydown', (e) =>
		{
			if(e.key === 'Escape' && this.modal.classList.contains('show'))
			{
				this.close();
			}
		});
	}

	open(title, content)
	{
		// Ensure modal exists and is bound
		if(!this.modal)
		{
			this.init();
		}

		document.getElementById('modalTitle').textContent = title;
		document.getElementById('modalContent').innerHTML = content.replace(/\n/g, '<br>');

		this.modal.style.display = 'flex';
		// Trigger fade-in animation
		setTimeout(() =>
		{
			this.modal.classList.add('show');
		}, 10);

		document.body.style.overflow = 'hidden'; // Prevent background scrolling
	}

	close()
	{
		if(!this.modal) return;

		this.modal.classList.remove('show');
		// Wait for animation to complete before hiding
		setTimeout(() =>
		{
			this.modal.style.display = 'none';
			document.body.style.overflow = 'auto'; // Restore scrolling
		}, 300);
	}

	static createConceptDisplay(title, concept, truncateLength = 100)
	{
		if(!concept || concept.trim() === '')
		{
			return 'No concept available';
		}

		const shouldTruncate = concept.length > truncateLength;
		const truncated = shouldTruncate ? concept.substring(0, truncateLength) + '...' : concept;

		const displayHtml = `
            <span class="concept-preview">${truncated}</span>
            ${shouldTruncate ? `
                <button class="read-more-btn" onclick="event.preventDefault(); event.stopPropagation(); conceptModal.open('${title.replace(/'/g, "\\'")}', '${concept.replace(/'/g, "\\'")}')">
                    <span>Read More</span> <i class="arrow-icon">→</i>
                </button>
            ` : ''}
        `;

		return displayHtml;
	}
}

// Initialize concept modal when DOM is loaded
let conceptModal;

// Ensure initialization happens after DOM is ready
if(document.readyState === 'loading')
{
	document.addEventListener('DOMContentLoaded', function ()
	{
		conceptModal = new ConceptModal();
	});
} else
{
	// DOM is already ready
	conceptModal = new ConceptModal();
}

// Legacy function support for existing onclick handlers
function openConceptModal(title, content)
{
	if(window.conceptModal)
	{
		window.conceptModal.open(title || 'Artwork Concept', content || '');
	} else
	{
		// Fallback if modal isn't ready yet
		setTimeout(() => openConceptModal(title, content), 100);
	}
}

function closeConceptModal()
{
	if(window.conceptModal)
	{
		window.conceptModal.close();
	}
}
