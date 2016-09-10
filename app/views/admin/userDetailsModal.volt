<div class="modal fade" id="userDetailsModal" role="dialog" style="padding-top:100px">
	<div class="modal-dialog" ng-model="modalUser">

		<div class="modal-content">
			<div class="modal-header text-center">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">User Details</h4>
				<img src="{( modalUser.profile.cover )}" class="img img-responsive" />
				<img src="{( modalUser.profile.picture )}" class="img img-responsive img-thumbnail" style="max-width: 200px;margin-top: -170px" />
			</div>
			<br>
			<div class="modal-body">
				<span class="text-muted">Location</span>
				<p>{( modalUser.profile.location )}</p>		
				<hr>		
				<span class="text-muted">Facebook Name</span>
				<p>{( modalUser.name )}</p>
				<hr>
				<span class="text-muted">BandManager First Name</span>
				<p>{( modalUser.profile.first_name )}</p>
				<hr>
				<span class="text-muted">BandManager Last Name</span>
				<p>{( modalUser.profile.last_name )}</p>			
			</div>
		</div>

	</div>
</div>