 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Data Absensi</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal" >Add</a>
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr class="text-center">
                             <th>No</th>
                             <th>Nomor Rfq</th>
                             <th>Nama Project</th>
                             <th>Kegiatan</th>
                             <th>Waktu</th>
                             <th></th>
                         </tr>
                     </thead>
                     <?php $no = 1 ?>
                     <?php foreach ($absensi as $db) { ?>
                     <?php $kegiatan =array(1 =>'Meeting', 2 =>'Briefing') ?>
                        <tr>
                            <td><?php echo $no ?></td>
                            <td><?php echo $db['nomor_rfq'] ?></td>
                            <td><?php echo $db['nama_project'] ?></td>
                            <td><?php echo $kegiatan[$db['kegiatan']] ?></td>
                            <td><?php echo $db['tanggal'] ?></td>
                            <td><a href="<?php echo base_url('absensi/view/'.$db['id_absensi']) ?>" class="btn btn-sm btn-info"><i class="fas fa-angle-double-right"></i></a></td>
                        </tr>
                        <?php $no++; ?>
                     <?php } ?>
                     <tbody>
                      
                     </tbody>
                 </table>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Tambah</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form action="<?php echo base_url('absensi/tambah') ?>" method="POST">
                     <div class="form-group">
                         <label>Project</label>
                         <select name="nomor_rfq" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project..." >
                         <?php foreach($project as $data): ?>
                             <option value="<?php echo $data['nomor_rfq'] ?>"><?php echo $data['nomor_rfq'] ?> - <?php echo $data['kode_project'] ?> - <?php echo $data['nama_project'] ?></option>
                         <?php endforeach; ?>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Kegiatan</label>
                         <select name="kegiatan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project..." >
                             <option value="1">Meeting</option>
                             <option value="2">Briefing</option>
                         </select>
                     </div>
                     <div class="form-group">
                         <label>Tanggal</label>
                         <input type="datetime-local" name="tanggal" class="form-control">
                     </div>
                 
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button>
             </div>
             </form>
         </div>
     </div>
 </div> 