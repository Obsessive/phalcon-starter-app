<div class="modal fade" id="bandDetailsModal" role="dialog" style="padding-top:100px">
	<div class="modal-dialog" ng-model="modalBand">

		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Band Details</h4>
				<img src="{( modalBand.profile.cover )}" class="img img-responsive" />
				<img src="{( modalBand.profile.picture )}" class="img img-responsive img-thumbnail" style="max-width: 200px;margin-top: -170px" />
			</div>
			<br>
			<div class="modal-body">				
				<span class="text-muted">Page Name</span>
				<p>{( modalBand.name )}</p>
				<span class="text-muted">Genre</span>
				<p>{( modalBand.profile.genre )}</p>			
			</div>
		</div>

	</div>
</div>