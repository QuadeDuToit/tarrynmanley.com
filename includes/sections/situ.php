<section id="SITU" class="container">
	<div class="row">
		<div class="col-12">
			<h2 class="clr-primary text-shadow text-center mt-20">
				SEE YOUR ART IN SITU
			</h2>
		</div>
		<div class="col-12 flex flex-x">
			<div id="situ-bg">
				<div id="situ-wrapper" class="situ-clickable" data-room="coastal">
					<img src="./assets/images/situ/coastal.webp" id="situ" alt="Art piece placed in SITU" />
					<button class="situ-change-btn" aria-label="Change room setting">
						<span class="situ-icon">🏠</span>
					</button>
				</div>
			</div>
		</div>
		<div class="col-12 text-center mt-20">
			<p class="situ-hint">Click to explore different room settings</p>
		</div>
	</div>

	<!-- SITU Modal -->
	<div id="situ-modal" class="situ-modal">
		<div class="situ-modal-content">
			<div class="situ-modal-header">
				<h3>Choose Room Setting</h3>
				<button class="situ-modal-close" aria-label="Close modal">&times;</button>
			</div>
			<div class="situ-modal-body">
				<div class="situ-room-grid">
					<div class="situ-room-option" data-room="coastal" data-image="coastal.webp">
						<img src="./assets/images/situ/coastal.webp" alt="Coastal room setting" />
						<span class="situ-room-name">Coastal</span>
					</div>
					<div class="situ-room-option" data-room="crow-salad" data-image="crow-salad.webp">
						<img src="./assets/images/situ/crow-salad.webp" alt="Modern room setting" />
						<span class="situ-room-name">Modern</span>
					</div>
					<div class="situ-room-option" data-room="inferno" data-image="inferno.webp">
						<img src="./assets/images/situ/inferno.webp" alt="Warm room setting" />
						<span class="situ-room-name">Warm</span>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>