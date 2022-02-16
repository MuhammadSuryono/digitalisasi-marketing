 <!-- Begin Page Content -->
 <div class="container-fluid">

     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Form Input Surat (Email)</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
         </div>

         <div class="card-body">
             <form action="<?php echo base_url('surat/tambah') ?>" method="POST" class="row">
                 <div class="col-xl-4 col-md-6 mb-4">
                     <div class="form-group">
                         <label for="user">Nama Surat</label>
                         <input type="text" name="jenis_surat" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('user'); ?>">
                         <?php echo form_error('user', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="user">Jenis Surat</label>
                         <select name="id_menu" id="id_menu" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih Keperluan Email untuk...">
                            <?php foreach($jenis_surat as $js => $nilai) :?>
                            <option value="<?=$js?>"><?=$nilai?></option>
                            <?php endforeach?>
                        </select>
                     </div>
                     <div class="form-group">

                         <textarea name="isi_surat" class="form-control" id="exampleTextarea" rows="10" placeholder="Isi surat..."></textarea>
                         <?php echo form_error('password1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>

                     <div class="form-group">
                         <button class="btn btn-primary" type="submit">Save</button>
                         <a href="<?php echo base_url('surat') ?>" class=" btn btn-danger"> Back</a>
                     </div>

                 </div>

                  <div class="col-xl-4 col-md-6 mb-4 offset-2">
                   <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Variable</h6>
                        </div>
                        <div class="card-body" id="">
                            <table class="table" width="100%" cellspacing="0">
					 	<thead>
					 		<tr>
					 			<th>No</th>
					 			<th>Variable</th>
					 		</tr>
					 	</thead>
					 	<tbody id="variable">
					 		
					 	</tbody>
					 </table>
                        </div>
                    </div>
                  </div>
             </form>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content --> 