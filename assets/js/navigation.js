// Navigation Menu Functionality
document.addEventListener('DOMContentLoaded', function ()
{
	const navToggle = document.getElementById('nav-toggle');
	const navMenu = document.getElementById('nav-menu');

	if(!navToggle || !navMenu)
	{
		console.warn('Navigation elements not found');
		return; // Exit if elements don't exist
	}

	navToggle.addEventListener('click', function ()
	{
		navToggle.classList.toggle('active');
		navMenu.classList.toggle('active');
	});

	// Close menu when clicking outside
	document.addEventListener('click', function (event)
	{
		if(!navToggle.contains(event.target) && !navMenu.contains(event.target))
		{
			navToggle.classList.remove('active');
			navMenu.classList.remove('active');
		}
	});

	// Close menu when clicking on navigation links
	const navLinks = document.querySelectorAll('.nav-link');
	navLinks.forEach(link =>
	{
		link.addEventListener('click', function ()
		{
			navToggle.classList.remove('active');
			navMenu.classList.remove('active');
		});
	});

	// Highlight current section (only on main page)
	function highlightCurrentSection()
	{
		const sections = document.querySelectorAll('section[id]');
		const navLinks = document.querySelectorAll('.nav-link');

		if(sections.length === 0) return; // Skip if no sections (like on gallery page)

		window.addEventListener('scroll', () =>
		{
			let current = '';
			sections.forEach(section =>
			{
				const sectionTop = section.offsetTop;
				const sectionHeight = section.clientHeight;
				if(window.pageYOffset >= (sectionTop - 100))
				{
					current = section.getAttribute('id');
				}
			});

			navLinks.forEach(link =>
			{
				link.classList.remove('current-page');
				if(link.getAttribute('href') === '#' + current)
				{
					link.classList.add('current-page');
				}
			});
		});
	}

	highlightCurrentSection();
});
