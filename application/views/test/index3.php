
 
 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <!-- DataTales Example -->
	 <div class="row">
        <div class="col-lg-6">	
			 <div class="card shadow mb-4">
				 <div class="card-header py-3">
					 <h6 class="m-0 font-weight-bold text-primary">Form Email</h6>
				 </div>

				 <div class="card-body">
                 <form action="<?= base_url('email/tambahriway') ?>" enctype="multipart/form-data" method="POST" >
					 <table class="table" width="100%" cellspacing="0">
                          <div class="form-group">
						 <label for="user">Bidang Usaha</label>
						 <select name="usaha" id="usaha" class="selectpicker show-tick form-control <?php if(form_error('usaha')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih usaha...">
						 <!-- Bagian yang Iway RUbah -->
                         
							 <?php 
								$data = $this->Usaha_model->getAllUsaha();
								foreach ($data as $db) : ?>
							<?php if (set_value('usaha') == $db['id_usaha'] ) { ?>
							<option value="<?php echo $db['id_usaha'] ?>" selected><?php echo $db['bidang'] ?></option>
							<?php }else{ ?>
							<option value="<?php echo $db['id_usaha'] ?>"><?php echo $db['bidang'] ?> </option>	
							<?php } ?>
							 <?php endforeach; ?>
							 <!--AKHIR Bagian yang Iway RUbah -->
						 </select>
						  <?php echo form_error('usaha', '<small class="text-danger pl-3">', '</small>'); ?>
					 </div>
                     <div class="form-group">
						<button type="button" class="btn btn-info btn-block" id="showriway" name="showriway"> Show </button>
					 </div>
					 <table class="table" width="100%" cellspacing="0">
					 	<thead>
					 		<tr>
					 			<th> <input type="checkbox" id="cekAllriway"> </th>
					 			<th>Nama Customer</th>
					 			<th>Perusahaan</th>
					 			<th>Email</th>
					 		</tr>
					 	</thead>
					 	<tbody id="show-datariway">
					 		
					 	</tbody>
						
					 </table>
                     <div class="form-group">
						<button type="button" class="btn btn-info btn-block" id="showriway1" name="showriway1"> Tambah </button>
					 </div>
				 </table>
					 <div class="form-group">
						 <label for="user">Upload File</label>
						 <table class="table table-bordered" id="dynamic_field">  
							<tr>  
								 <td><input type="file" id="file" name="filedata[]" placeholder="Enter your Name" class="form-control name_list" /></td>  
								 <td><button type="button" name="add" id="add" class="btn btn-info btn-sm">+ Add More</button></td>  
							</tr>  
						 </table>
					 </div>
					 <div class="form-group">
						<button type="submit" name="addriway" id="addriway" class="btn btn-success">Accept</button>
					 </div>
					
				 </div>
			 </div>
		</div>
		<div class="col-lg-6">	
			 <div class="card shadow mb-4">
			 <div class="card-header py-3">
			 <h6 class="m-0 font-weight-bold text-primary">Kirim Email</h6>
				 </div>
				 <div class="card-body" id="">
					<h6>TESTING BY IWAYRIWAY</h6>
					 <table class="table" width="100%" cellspacing="0">
					 	<thead>
					 		<tr>
					 			<th> <input type="checkbox" id="cekAllriway1" name="testaja1[]" value="123456789"> </th>
					 			<th>Nama Customer</th>
					 			<th>Perusahaan</th>
					 			<th>Email</th>
					 		</tr>
					 	</thead>
                         <td><input type="checkbox" id="cekAllriway1" name="testaja1[]" value="123456789"></td>
					 	<tbody id="show-datariway1">
					 		
					 	</tbody>
					 </table>
					 <div class="form-group">
						<button type="button" class="btn btn-danger btn-block" id="showriway2" name="showriway2"> Hapus </button>
					 </div>
				 </div>

			 </div>
             </form>
	 </div>

 </div>
 <!-- /.container-fluid -->



 </div>

 <script type="text/javascript">
 	$('#surat').change(function(){
 		var id = $(this).val();

 		$.ajax({
 			method : 'GET',
 			url : '<?php echo base_url('email/getSurat')  ?>',
 			dataType :'json',
 			data : {id:id},
 			success : function(hasil){
 				$('#isi').val(hasil.isi_surat);
 			}
 		});
 	});

 	$('#mail').load('<?php echo base_url('email/temMail')  ?>');

 </script>