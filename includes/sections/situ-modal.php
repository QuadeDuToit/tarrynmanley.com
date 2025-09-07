<div id="mdl-situ" class="modal-holder hidden">
	<div class="modal" onclick="SituInstance.closeModal(event)">
		<div class="modal-content">
			<span class="close" onclick="SituInstance.closeModal()">&times;</span>
			<div class="modal-body ">
				<ul id="situ-list">
					<li onclick="SituInstance.load('coastal')" data-id="coastal">coastal</li>
					<li onclick="SituInstance.load('crow-salad')" data-id="crow-salad">crow-salad</li>
					<li onclick="SituInstance.load('inferno')" data-id="inferno">inferno</li>
				</ul>
			</div>
		</div>
	</div>
</div>