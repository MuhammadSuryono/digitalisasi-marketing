
 
 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Preview Email</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Email</h6>
         </div>
         <div class="card-body">
			<table class="table table-bordered" cellspacing="0">
				<tr>
					<td width="200"><b>Judul</b></td>
					<td><?php echo $email['judul_email'] ?></td>
				</tr>
				<tr>
					<td><b>Isi</b></td>
					<td><?php echo nl2br($email['isi_email']) ?></td>
				</tr>
				<tr>
					<td><b>Di kirim ke</b></td>
					<?php $cus = unserialize($email['id_customer']) ?>
					<td><?php
					foreach($cus as $db):
						$hasil = $this->Customer_model->getCustomerById($db);
						$perusahaan = $this->Perusahaan_model->getPerusahaanById($hasil['perusahaan']);
					?>
							# <?php echo $hasil['nama'] ?> - <?php echo $perusahaan['nama'] ?> - <?php echo $hasil['email1'] ?><br>
					<?php
					endforeach;
					?>
					</td>
				</tr>
				<tr>
					<td><b>File</b></td>
					<?php $file = unserialize($email['file']) ?>
					<td><?php
					foreach($file as $db):
					?>
							<a href="<?php echo base_url('file/email/')?><?php echo $db ?>" target="_blank"><?php echo $db ?></a><br>
					<?php
					endforeach;
					?></td>
				</tr>
			  </table>
			  <a href="<?php echo base_url('email') ?>" class="btn btn-danger" >Batal</a>
			  <a href="<?php echo base_url('email/tes/') ?><?php echo $email['id_email'] ?>" class="btn btn-success" >Test</a>
			  <a href="<?php echo base_url('email/kirim/') ?><?php echo $email['id_email'] ?>" class="btn btn-primary" >Kirim</a>
			  
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 