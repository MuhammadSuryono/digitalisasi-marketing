 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Blast Email</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="<?php echo base_url('email/create') ?>" class="btn btn-primary mb-4"><i class="fas fa-plus"></i> Tulis Email</a>
                 <table class="table table-hover" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr>
                             <th></th>
                             <th width="200px">Tanggal Email</th>
                             <th>Judul Email</th>
                             <th class="text-center">Status</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            foreach ($email as $data) :
                            $stat=[0=>'Gagal', 1=>'Terkirim'];    
								?>
                         <tr class="detail" data="<?php echo $data['id_email'] ?>">
                             <td class="text-center"><b>#</b></td>
                             <td><time class="cbp_tmtime" datetime="2017-11-04T18:30"><span class="hidden"><?php echo date('d F Y', strtotime($data['log_modif'])) ?></span><br><span class="small"><i><?php echo date('H:i', strtotime($data['log_modif'])) ?></i></span></time></td>
                             <td><?php echo $data['judul_email'] ?></td>
                             <td class="text-center"><?php echo $stat[$data['stat']] ?></td>
                            
                         </tr>

                         <div class="modal fade bd-example-modal-lg" id="exampleModal<?php echo $data['id_email'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                             <div class="modal-dialog modal-lg" role="document">
                                 <div class="modal-content">
                                     <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                             <span aria-hidden="true">&times;</span>
                                         </button>
                                     </div>
                                     <div class="modal-body">
                                        <div class="card">
                                            <div class="card-body">
                                                 <h5 class="card-title"><b>Isi email :</b></h5>
                                                 <p><?php echo nl2br($data['isi_email']) ?></p>
                                             </div>
                                        </div>

                                        <h6 class="m-0 mt-4 mb-3 font-weight-bold text-primary">Penerima</h6>

                                        <ul class="list-group">
                                       <?php $cus = unserialize($data['id_customer']) ?>
                                        <?php
                                        foreach($cus as $db):
                                            $hasil = $this->Customer_model->getCustomerById($db);
                                            $perusahaan = $this->Perusahaan_model->getPerusahaanById($hasil['perusahaan']);
                                        ?>
                                            <li class="list-group-item"> <i class="fas fa-check text-success"></i> <?php echo $hasil['nama'] ?> - <?php echo $perusahaan['nama'] ?> - <?php echo $hasil['email1'] ?></li>

                                        <?php
                                        endforeach;
                                        ?>
                                        </ul>
                                     </div>

                                     <div class="modal-footer">
                                         <a href="<?php echo base_url(); ?>email/hapus/<?php echo $data['id_email']; ?> " class="btn btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <?php
                            
                        endforeach;
                        ?>
                     </tbody>
                 </table>


             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->

 </div>


 <script type="text/javascript">
     $(document).on('click', '.detail', function(){
        var id = $(this).attr('data');
        $('#exampleModal'+id).modal('show');
     });
 </script>