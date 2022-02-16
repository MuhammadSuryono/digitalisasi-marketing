 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Form</h6>
         </div>

         <div class="card-body">
            <form method="POST" action="<?php echo base_url('templateProjectPlan/tambahKegiatan') ?>">
                <div class="row">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <label for="nomor_rfq">Nama Template Project</label>
                            <input type="text" value="<?php echo $template['nama_template'] ?>" name="nama_template" class="form-control" readonly  >
                            <input type="hidden" value="<?php echo $template['id_template_project'] ?>" name="id_template" class="form-control" readonly  >
                        </div>
                        <div class="form-group">
                            <label for="nama_project">Kegiatan</label>
                            <select name="kegiatan" class="selectpicker form-control" title="Pilih Kegiatan...">
                                <option value="1">Project Spec</option>
                                <option value="2">Briefing</option>
                                <option value="3">Field Start</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_project">Nama Kegiatan Lain</label>
                            <input type="text" name="nama_kegiatan" class="form-control">
                            <small>* Isi nama kegiatan jika tidak ada di list kegiatan</small>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="undangan"> Kirim Undangan
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Tambah Kegiatan</button>
                            <button type="button" onclick="history.back(-1)" class="btn btn-danger" ><i class="fas fa-arrow-left"></i> Kembali</button>
                        </div>
                    </div>
                </div>
            </form>
            <small>*Perhatikan urutan kegiatan</small>
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th class="text-center">Kirim Undangan</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no =1;
                    foreach($kegiatan as $db){
                     ?>
                     <tr>
                         <td><?php echo $no ?></td>
                         <td><?php echo $db['nama_kegiatan'] ?></td>
                         <td class="text-center">
                            <?php if($db['undangan'] == null){
                                echo'<i class="fas fa-times text-danger"></i>';
                            }else{
                                echo'<i class="fas fa-check text-success"></i>';
                            } ?>
                         </td>
                         <td class="text-center">
                              <a href="<?php echo base_url('templateProjectPlan/hapus_kegiatan/'.$db['id_kegiatan'].'/'.$db['id_template_project']) ?>" class="btn btn-danger btn-sm tombol-hapus">delete</a>
                         </td>
                     </tr>
                     <?php
                     $no++;
                    }
                      ?>
                </tbody>
            </table>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->
