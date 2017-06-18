<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				<form class="form-horizontal" role="form" id="form-add" method="post">
					<div class="form-group">
						<label for="title" class="col-sm-2 control-label">Title</label>
						<div class="col-sm-5">
							<?php echo form_input('title', NULL, 'class="form-control required" id="title"'); ?>
						</div>
					</div>
					<div class="form-group">
						<label for="branch_id" class="col-sm-2 control-label">Branch</label>
						<div class="col-sm-3">
							<?php
							echo form_dropdown('branch_id',$ddl_branch, null, 'class="form-control" id="branch_id"');
							?>
						</div>
					</div>
					<div class="form-group">
						<label for="desc_email" class="col-sm-2 control-label">Email list</label>
						<div class="col-sm-6">
							<?php echo form_textarea('desc_email', NULL, 'class="form-control" id="desc_email" rows="3"'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="button" id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>
								Save Email</button>
							</div>
						</div>
					</form>
				</div> 
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			$('#branch_id').change(function () {
				var desc_email = $('#desc_email');
				desc_email.val("");
				$.get(site_url + 'common/get_user_email/', {branch_id: $('#branch_id').val()},
					function (data) {
						var as = JSON.parse(data);
						desc_email.val(as);
					});
			});
			var options = {
				url: site_url + 'emailletter/save/add',
				success: showResponse
			};
			$('#btnSave').click(function () {
				if ($("#form-add").valid()) {
					$(this).addClass('disabled');
					$('#form-add').ajaxSubmit(options);
					return false;
				}
			});
		});

		function openWindow() { 
			window.open(site_url+"emailletter/popup_email","_blank","height=400,width=600, status=yes,toolbar=no,menubar=no,location=no,scrollbars=yes"); 
		} 

		function showResponse(response, statusText, xhr, $form) {
			var as = JSON.parse(response);
			if (as.error.status === false) {
				$('#btnSave').removeClass('disabled');
			}else{
				window.location.href = site_url+as.error.redirect;
			}
		}
	</script>