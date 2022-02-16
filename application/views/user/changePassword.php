

 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <!-- DataTales Example -->
	 <div class="row justify-content-center">
        <div class="col-lg-12">	
			 <div class="card shadow mb-4">
				 <div class="card-header py-3">
					 <h6 class="m-0 font-weight-bold text-primary">Change your password</h6>
				 </div>

				 <div class="card-body">
				 	<?php if ($this->session->flashdata()) : ?>
				 	<?php foreach ($this->session->flashdata() as $key => $value):?>
					<div class="row mt-3">
					<div class="col">
						<div class="alert alert-<?php echo $key ?> alert-dismissible fade show" role="alert">
							 <strong><?php echo $value ?></strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					</div>
					</div>
					<?php endforeach; ?>
					<?php endif; ?>
					<form action="<?php echo base_url('user/changePassword') ?>" enctype="multipart/form-data" method="POST" >
						<input type="hidden" name="id" value="<?php echo $this->session->userdata('ses_id'); ?>">
						 <div class="form-group">
							 <label for="user">Current Password</label>
							 <input type="password" name="old_ps" id="judul" class="form-control form-control-user <?php if(form_error('old_ps')){ echo'is-invalid'; } ?>"  value="<?php echo set_value('old_ps'); ?>">
							 <?php echo form_error('old_ps', '<small class="text-danger pl-3">', '</small>'); ?>
						 </div>

						 <div class="form-group">
							 <label for="user">New Password</label>
							 <input type="password" name="new_ps1" id="ps1" class="form-control form-control-user <?php if(form_error('new_ps1')){ echo'is-invalid'; } ?>" value="<?php echo set_value('new_ps1'); ?>">
							 <?php echo form_error('new_ps1', '<small class="text-danger pl-3">', '</small>'); ?>
						 </div>

						 <div class="form-group">
							 <label for="user">Confirm New Password</label>
							 <input type="password" name="new_ps2" id="ps2" class="form-control form-control-user <?php if(form_error('new_ps2')){ echo'is-invalid'; } ?>">
							 <?php echo form_error('new_ps2', '<small class="text-danger pl-3 sm">', '</small>'); ?>
						 </div>
						 <hr>
						 <div class="form-group">
						 	<button type="submit" class="btn btn-info btn-block">Save</button>
						 </div>
					</form>
			 	</div>
			</div>
		</div>
	</div>
 </div>
 <!-- /.container-fluid -->
 </div>

 <script type="text/javascript">
 	 $('#ps1').keyup(function(){
 	 	$('.sm').text('');
 		var ps1 = $('#ps1').val();
 		var ps2 = $('#ps2').val();

 		if(ps1 != '' && ps2 != ''){
	 		if(ps1 != ps2){
	 			$('#ps2').addClass('is-invalid');
	 		}else{
	 			$('#ps2').removeClass('is-invalid');
	 			$('#ps2').addClass('is-valid');
	 		}
	 	}
 	});
 	$('#ps2').keyup(function(){
 		$('.sm').text('');
 		var ps1 = $('#ps1').val();
 		var ps2 = $('#ps2').val();

 		if(ps1 != '' && ps2 != ''){
	 		if(ps1 != ps2){
	 			$('#ps2').addClass('is-invalid');
	 		}else{
	 			$('#ps2').removeClass('is-invalid');
	 			$('#ps2').addClass('is-valid');
	 		}
 		}
 	});
 </script>
