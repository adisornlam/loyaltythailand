<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body">
				<form class="form-horizontal" role="form" id="form-add" method="post">
					<div class="form-group">
						<label for="desc_email" class="col-sm-2 control-label">Email list</label>
						<div class="col-sm-6">
							<?php echo form_textarea('desc_email', $get_email_not_list, 'class="form-control" id="desc_email" rows="3"'); ?>
						</div>
					</div>
					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<button type="button" id="btnSave" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i>
								Save Email</button>
							</div>
						</div>
						<input type="hidden" name="id" value="<?php echo $item->id; ?>">
					</form>
				</div> 
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(function(){
			var options = {
				url: site_url + 'emailletter/save/resend',
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

		function showResponse(response, statusText, xhr, $form) {
			var as = JSON.parse(response);
			if (as.error.status === false) {
				$('#btnSave').removeClass('disabled');
			}else{
				window.location.href = site_url+as.error.redirect;
			}
		}
	</script>