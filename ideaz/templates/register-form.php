<!-- Register Modal -->
	<div class="modal fade" id="register-form" tabindex="-1" role="dialog">
	  	<div class="modal-dialog" role="document">
	    	<div class="modal-content">
	     		<div class="modal-header">
	        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        		<h4 class="modal-title">Register</h4>
	      		</div>
	      		<div class="modal-body">

	      		<?php
	      			if (!(isset($_SESSION["id"])))
	      			{
	      				register_form();
	      			}
	      			else
	      			{
	      				already_logged_in();
	      			}
	      		?>

	      		</div>
	    	</div>
	  	</div>
	</div>