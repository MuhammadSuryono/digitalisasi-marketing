
 
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
					 <table class="table" width="100%" cellspacing="0">
					 	<thead>
					 		<tr>
					 			<th> <input type="checkbox" id=""> </th>
					 			<th>Nama Customer</th>
					 			<th>Perusahaan</th>
					 			<th>Email</th>
					 		</tr>
					 	</thead>
					 	<tbody id="">
                         <form action="<?= base_url('email/testajadulu'); ?>" method="post">
                             <?php $data = $this->db->get('data_test1')->result_array();
                             foreach($data as $db) :?>
                             <tr><td><input type="checkbox" id="test1" name="test1[]" class="test1" value="<?= $db['id']?>"></td>
                             <td><?=$db['id']?></td>
                             <td><?=$db['keteranngan']?></td>
                             </tr>
                            <?php endforeach;?>
                            
					 	</tbody>
						
					 </table>
					 <div class="form-group">
						<button type="submit" class="btn btn-success btn-block" id="plus" name="plus"> Tambah </button>
					 </div>
				 </table>
				 </form>
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
						<button type="submit" name="add" class="btn btn-success">Accept</button>
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
					 			<th> <input type="checkbox" id=""> </th>
					 			<th>Nama Customer</th>
					 			<th>Perusahaan</th>
					 			<th>Email</th>
					 		</tr>
					 	</thead>
					 	<tbody id="show-data1">
					 		
					 	</tbody>
						<?php $data = $this->db->query('Select * from data_test1 A JOIN data_test2 B on A.id=B.id_data1')->result_array();
                             foreach($data as $db) :?>
                             <tr><td><input type="checkbox" id="test1" name="test1[]" class="test1" value="<?= $db['id']?>"/></td>
                             <td><?=$db['id_data1']?></td>
                             <td><?=$db['keteranngan']?></td>
                             </tr>
                            <?php endforeach;?>
					 </table>
					 <div class="form-group">
						<button type="button" class="btn btn-danger btn-block" id="" name=""> Hapus </button>
					 </div>
				 </div>

			 </div>
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