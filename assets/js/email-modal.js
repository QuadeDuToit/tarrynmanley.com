/**
 * Email Modal Functionality
 */

// Open email modal
function openEmailModal()
{
	const modal = document.getElementById('emailModal');
	modal.classList.add('show');
	document.body.style.overflow = 'hidden';
}

// Close email modal
function closeEmailModal()
{
	const modal = document.getElementById('emailModal');
	modal.classList.remove('show');
	document.body.style.overflow = 'auto';

	// Reset form
	document.getElementById('emailForm').reset();
}

// Close modal when clicking outside
document.addEventListener('click', (e) =>
{
	const modal = document.getElementById('emailModal');
	if(e.target === modal)
	{
		closeEmailModal();
	}
});

// Close modal with Escape key
document.addEventListener('keydown', (e) =>
{
	if(e.key === 'Escape')
	{
		const modal = document.getElementById('emailModal');
		if(modal && modal.classList.contains('show'))
		{
			closeEmailModal();
		}
	}
});

// Handle form submission
document.addEventListener('DOMContentLoaded', function ()
{
	const emailForm = document.getElementById('emailForm');
	if(emailForm)
	{
		emailForm.addEventListener('submit', function (e)
		{
			e.preventDefault();

			const submitBtn = this.querySelector('.btn-send');
			const originalText = submitBtn.textContent;

			// Show loading state
			submitBtn.disabled = true;
			submitBtn.textContent = 'Sending...';

			// Create form data
			const formData = new FormData(this);

			// Send email via fetch
			fetch('send-email.php', {
				method: 'POST',
				body: formData
			})
				.then(response => response.json())
				.then(data =>
				{
					if(data.success)
					{
						alert('Email sent successfully!');
						closeEmailModal();
					} else
					{
						alert('Error sending email: ' + (data.message || 'Unknown error'));
					}
				})
				.catch(error =>
				{
					console.error('Error:', error);
					alert('Error sending email. Please try again.');
				})
				.finally(() =>
				{
					// Reset button state
					submitBtn.disabled = false;
					submitBtn.textContent = originalText;
				});
		});
	}
});
