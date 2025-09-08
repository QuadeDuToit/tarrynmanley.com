<section id="contact" class="container">
	<div class="row">
		<div class="col-12">
			<h2 class="clr-primary text-shadow mt-20">
				CONTACT ME
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-12 col-lg-6">
			<div class="contact-details">
				<h3>ADDRESS</h3>
				<ul class="list list-unstyled">
					<li>11 Hope Stret</li>
					<li>Claremont</li>
					<li>Cape Town</li>
				</ul>
				<h3>PHONE</h3>
				<ul class="list list-unstyled">
					<li>(+27) 073 386 5567</li>
				</ul>

				<h3>EMAIL</h3>
				<ul class="list list-unstyled">
					<li>
						<button class="btn-clear" onclick="openEmailModal()">
							<span>tarryn@tarrynmanley.com</span>
						</button>
					</li>
				</ul>
			</div>
		</div>
		<div class="col-12 col-sm-12 col-md-12 col-lg-6">
			<div class="flex flex-y">
				<img class="img-bg" src="./assets/images/contact-lg.webp" alt="Contact image background" />
				<img class="img-splash" src="./assets/images/contact-portrait.webp" alt="Portrait photo of Tarryn Manley" />
			</div>
		</div>
	</div>
</section>

<!-- Email Modal -->
<div id="emailModal" class="email-modal">
	<div class="modal-content">
		<div class="modal-header">
			<h3>Send Email to Tarryn</h3>
			<button class="close-btn" onclick="closeEmailModal()">&times;</button>
		</div>
		<div class="modal-body">
			<form id="emailForm" method="POST" action="send-email.php">
				<div class="form-group">
					<label for="senderName">Your Name</label>
					<input type="text" id="senderName" name="senderName" required>
				</div>
				<div class="form-group">
					<label for="senderEmail">Your Email</label>
					<input type="email" id="senderEmail" name="senderEmail" required>
				</div>
				<div class="form-group">
					<label for="subject">Subject</label>
					<input type="text" id="subject" name="subject" required>
				</div>
				<div class="form-group">
					<label for="message">Message</label>
					<textarea id="message" name="message" rows="6" required></textarea>
				</div>
				<div class="form-actions">
					<button type="button" class="btn-cancel" onclick="closeEmailModal()">Cancel</button>
					<button type="submit" class="btn-send">Send Email</button>
				</div>
			</form>
		</div>
	</div>
</div>