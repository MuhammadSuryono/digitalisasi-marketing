 <!-- Begin Page Content -->
 <div class="container-fluid">
   <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
   <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
   <!-- Page Heading -->
   <h1 class="h3 mb-4 text-gray-800">Project Plan <?php echo $rfq['nama_project'] ?></h1>
   <!-- DataTales Example -->
   <div class="card shadow mb-4">
     <div class="card-header py-3">
       <h6 class="m-0 font-weight-bold text-primary">Form Project Plan</h6>
     </div>

     <div class="card-body">
       <div class="row justify-content-center mt-2">
         <div class="col-12 col-lg-4">
           <p><span class="font-weight-bold">Nomor Request:</span><br><span style="font-size:18px;"><?php echo $rfq['nomor_rfq'] ?></span></p>
           <input type="hidden" id="rfq" name="rfq" value="<?php echo $rfq['nomor_rfq'] ?>">
         </div>
         <div class="col-12 col-lg-4">
           <p><span class="font-weight-bold">Kode Request:</span><br><span style="font-size:18px;"><?php echo $rfq['kode_project'] ?></span></p>
         </div>
         <div class="col-12 col-lg-4">
           <p><span class="font-weight-bold">Subject Request:</span><br><span style="font-size:18px;"><?php echo $rfq['nama_project'] ?></span></p>
         </div>
       </div>

       <div id="accordion">

         <div class="card">
           <div class="card-header">
             <a class="card-link" data-toggle="collapse" href="#collapseOne">
               <span data-toggle="tooltip" data-placement="top" title="Klik untuk membuka atau menyembunyikan tab"><i class="fas fa-angle-double-right"></i> Data Project Plan</span>
             </a>
           </div>
           <div id="collapseOne" class="collapse show">
             <div class="card-body">
               <div class="pb-3 text-right">
                 <a href="javascript:void(0)" class="addprojectplan btn btn-primary btn-sm" onclick="addKegiatan()"><i class="fas fa-plus"></i> Tambah Project Plan</a>
               </div>
               <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                 <thead>
                   <tr class="text-center align-middle">
                     <th width="5%">No</th>
                     <th width="40%">Nama Kegiatan</th>
                     <th width="20%">Date Start Target</th>
                     <th width="20%">Date Finish Target</th>
                     <th width="15%">Action</th>
                   </tr>
                 </thead>
                 <tbody>
                   <?php
                    $no = 1;
                    foreach ($detail as $data) {
                      if ($data['date_start_target'] != 0) {
                        $date_st = date('d-m-Y', strtotime($data['date_start_target']));
                        $val_st = str_replace('-', '', $data['date_start_target']);
                      } else {
                        $date_st = '<small class="text-danger">Perlu ditambahkan,<br>silahkan klik tombol edit</small>';
                        $val_st = '0';
                      }
                      if ($data['date_finish_target'] != 0) {
                        $date_ft = date('d-m-Y', strtotime($data['date_finish_target']));
                        $val_ft = str_replace('-', '', $data['date_finish_target']);
                      } else {
                        $date_ft = '<small class="text-danger">Perlu ditambahkan,<br>silahkan klik tombol edit</small>';
                        $val_ft = '0';
                      }

                      echo '
                            <tr>
                              <td class="text-center align-middle">' . $no++ . '</td>
                              <td class="text-center align-middle">' . $data['nama_kegiatan'] . '</td>
                              <td class="text-center align-middle">' . $date_st . '</td>
                              <td class="text-center align-middle">' . $date_ft . '</td>
                              <td class="text-center align-middle">
                              <a href="javascript:void(0)" onclick="editKegiatan(' . $data['id_pp_master'] . ',' . $data['id_pp_data'] . ',' . $val_st . ',' . $val_ft . ')" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                              <a href="' . base_url('projectPlan/hapus/' . $data['id_pp_data'] . '/' . $data['id_project_plan']) . '" class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash fa-sm"></i></a>
                              </td>
                            </tr>
                            ';
                    } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>

         <div class="card">
           <div class="card-header">
             <a class="card-link" data-toggle="collapse" href="#collapseTwo">
               <span data-toggle="tooltip" data-placement="top" title="Klik untuk membuka atau menyembunyikan tab"><i class="fas fa-angle-double-right"></i> Data Field Status</span>
             </a>
           </div>
           <div id="collapseTwo" class="collapse show">
             <div class="card-body">
               <table class="table table-bordered dt-responsive" id="dataTable2" width="100%" cellspacing="0">
                 <thead class="thead-dark">
                   <tr>
                     <th class="text-center align-middle" width="5%">No</th>
                     <th class="text-center align-middle" width="40%">Nama Kegiatan</th>
                     <th class="text-center align-middle" width="50%">Detail Kegiatan</th>
                     <th class="text-center align-middle" width="5%">Action</th>
                   </tr>
                 </thead>
                 <tbody id="showField">
                   <?php
                    $no = 1;
                    foreach ($detail as $data) {
                      if ($data['date_start_target'] != 0) {
                        $date_st = date('d-m-Y', strtotime($data['date_start_target']));
                      } else {
                        $date_st = '<small class="text-danger">Tambahkan di Data Project Plan</small>';
                      }
                      if ($data['date_finish_target'] != 0) {
                        $date_ft = date('d-m-Y', strtotime($data['date_finish_target']));
                      } else {
                        $date_ft = '<small class="text-danger">Tambahkan di Data Project Plan</small>';
                      }

                      if ($data['date_start_real'] != 0) {
                        $date_sr = date('d-m-Y', strtotime($data['date_start_real']));
                        $val_sr = str_replace('-', '', $data['date_start_real']);
                      } else {
                        $date_sr = '-';
                        $val_sr = '0';
                      }
                      if ($data['date_finish_real'] != 0) {
                        $date_fr = date('d-m-Y', strtotime($data['date_finish_real']));
                        $val_fr = str_replace('-', '', $data['date_finish_real']);
                      } else {
                        $date_fr = '-';
                        $val_fr = '0';
                      }

                      $n_target = $data['n_target'] != null ? $data['n_target'] : '-';
                      $n_real = $data['n_real'] != null ? $data['n_real'] : '-';
                      $done = $data['done'] != 0 ? '<i class="fas fa-check text-success"></i>' : '<i class="fas fa-times text-danger"></i>';
                      $keterangan = $data['keterangan'] != null ? $data['keterangan'] : '-';

                      if ($data['date_start_target'] == 0 or $data['date_finish_target'] == 0) {
                        $edit = 'disabled';
                      } else {
                        $edit = '';
                      }

                      echo '
                            <tr class="text-center align-middle" id="field' . $data['id_pp_data'] . '">
                              <td class="text-center align-middle">' . $no++ . '</td>
                              <td class="text-center align-middle">' . $data['nama_kegiatan'] . '</td>
                              <td class="text-justify align-middle">
                                <div class="row">
                                  <div class="col-6">
                                    <label class="font-weight-bold">Date Start Target:</label><br>
                                    ' . $date_st . '
                                  </div>
                                  <div class="col-6">
                                    <label class="font-weight-bold">Date Start Real:</label><br>
                                    ' . $date_sr . '
                                  </div>
                                  <div class="col-6">
                                    <label class="font-weight-bold">Date Finish Target:</label><br>
                                    ' . $date_ft . '
                                  </div>
                                  <div class="col-6">
                                    <label class="font-weight-bold">Date Finish Real:</label><br>
                                    ' . $date_fr . '
                                  </div>
                                  <div class="col-6">
                                    <label class="font-weight-bold">N Target:</label><br>
                                    ' . $n_target . '
                                  </div>
                                  <div class="col-6">
                                    <label class="font-weight-bold">N Real:</label><br>
                                    ' . $n_real . '
                                  </div>
                                  <div class="col-12">
                                    <label class="font-weight-bold">Done:</label> ' . $done . '
                                  </div>
                                  <div class="col-12">
                                    <label class="font-weight-bold">Keterangan <small>(Bila ada penundaan)</small>:</label><br>
                                    ' . $keterangan . '
                                  </div>
                                </div>
                              </td>
                              <td class="text-center align-middle">
                                <a href="javascript:void(0)" data-idppd="' . $data['id_pp_data'] . '" data-sr="' . $data['date_start_real'] . '" data-fr="' . $data['date_finish_real'] . '" data-nt="' . $data['n_target'] . '" data-nr="' . $data['n_real'] . '" data-done="' . $data['done'] . '" data-ket="' . $data['keterangan'] . '" class="editField btn btn-info btn-sm ' . $edit . '" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                              </td>
                            </tr>
                            ';
                      //<a href="javascript:void(0)" onclick="editField('.$data['id_pp_data'].','.$val_sr.','.$val_fr.','.$n_target.','.$n_real.')" class="btn btn-info btn-sm '.$edit.'" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
                    } ?>
                 </tbody>
               </table>
             </div>
           </div>
         </div>

       </div>


     </div>
   </div>
 </div>
 </div>




 <div class="modal fade" id="modalAddKegiatan" tabindex="-1" role="dialog" aria-labelledby="modalAddKegiatan" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Tambah Project Plan</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form method="POST" id="formKegiatan">
         <div class="modal-body" id="bodyTambahKegiatan">
           <div class="form-group">
             <label>Pilih Kegiatan</label>
             <select name="id_pp_master" id="pilihKegiatan" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih kegiatan" required>
               <optgroup label="Pilih Berdasarkan Template">
                 <?php
                  foreach ($template as $data) {
                    echo '<option value="templatepp' . $data['id_template_project'] . '">' . $data['nama_template'] . '</option>';
                  }
                  ?>
               </optgroup>
               <option value="tambahbaru" class="font-weight-bold">Tambah Kegiatan Baru</option>
               <optgroup label="Pilih Salah Satu Kegiatan">
                 <?php
                  foreach ($master as $data) {
                    echo '<option value="' . $data['id_pp_master'] . '">' . $data['nama_kegiatan'] . '</option>';
                  }
                  ?>
               </optgroup>
             </select>
           </div>
           <div class="form-group" id="kegiatanBaru">
             <label>Nama Kegiatan</label>
             <input type="text" name="nama_kegiatan" class="form-control" placeholder="Masukan Nama Kegiatan">
             <div class="text-danger text-justify mt-2"><small>*Untuk meminimalisir duplikasi data. Sebaiknya kroscek kembali apakah kegiatan tersebut memang benar belum tersedia di form Pilih Kegiatan</small></div>
           </div>
           <!-- <div class="form-group">
                <div class="custom-control custom-checkbox">
                  <input type="checkbox" class="custom-control-input" name="undangan" value="1">
                  <label class="custom-control-label" for="cekProposal">Cek jika kegiatan ingin ditambahkan form kirim undangan</label>
                </div>
              </div> -->
           <div class="row" id="kegiatanTanggal">
             <div class="col-6 form-group">
               <label>Date Start Target</label>
               <input type="date" name="date_start_target" class="form-control">
             </div>
             <div class="col-6 form-group">
               <label>Date Finish Target</label>
               <input type="date" name="date_finish_target" class="form-control">
             </div>
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

 <div class="modal fade" id="modalField" tabindex="-1" role="dialog" aria-labelledby="modalField" aria-hidden="true">
   <div class="modal-dialog" role="document">
     <div class="modal-content">
       <div class="modal-header">
         <h5 class="modal-title" id="exampleModalLabel">Form Edit Field Status</h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
           <span aria-hidden="true">&times;</span>
         </button>
       </div>
       <form method="POST" id="formField">
         <div class="modal-body" id="bodyField">
           <div class="row">
             <div class="col-6 form-group">
               <label>Date Start Real</label>
               <input type="date" name="date_start_real" class="form-control">
             </div>
             <div class="col-6 form-group">
               <label>Date Finish Real</label>
               <input type="date" name="date_finish_real" class="form-control">
             </div>
             <div class="col-6 form-group">
               <label>N Target</label>
               <input type="number" min="0" name="n_target" class="form-control" placeholder="N Target">
             </div>
             <div class="col-6 form-group">
               <label>N Real</label>
               <input type="number" min="0" name="n_real" class="form-control" placeholder="N Real">
             </div>
             <div class="col-12 form-group">
               <div class="custom-control custom-checkbox">
                 <input type="checkbox" class="custom-control-input" name="done" id="cekDone">
                 <label class="custom-control-label" for="cekDone">Cek jika kegiatan sudah dilakukan</label>
               </div>
             </div>
             <div class="col-12 form-group">
               <label>Keterangan <small>(Bila ada penundaan)</small></label>
               <input type="text" name="keterangan" class="form-control" placeholder="Keterangan">
             </div>
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

 <script type="text/javascript">
   $('#pilihKegiatan').change(function() {
     const id = $(this).val();
     if (id == 'tambahbaru') {
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').val('');
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').attr('required', 'true');
       $('#kegiatanBaru').show();
       $('#kegiatanTanggal').show();
       $('#bodyTambahKegiatan input[name=date_start_target]').attr('required', 'true');
       $('#bodyTambahKegiatan input[name=date_finish_target]').attr('required', 'true');
     } else if (id.substr(0, 10) == 'templatepp') {
       $('#kegiatanBaru').hide();
       $('#kegiatanTanggal').hide();
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').removeAttr('required');
       $('#bodyTambahKegiatan input[name=date_start_target]').removeAttr('required');
       $('#bodyTambahKegiatan input[name=date_finish_target]').removeAttr('required');
     } else {
       $('#bodyTambahKegiatan input[name=nama_kegiatan]').removeAttr('required');
       $('#kegiatanBaru').hide();
       $('#kegiatanTanggal').show();
       $('#bodyTambahKegiatan input[name=date_start_target]').attr('required', 'true');
       $('#bodyTambahKegiatan input[name=date_finish_target]').attr('required', 'true');
     }
   });


   function addKegiatan() {
     $('#formKegiatan').attr('action', '<?php echo base_url('projectPlan/tambah/' . $id_pp) ?>');
     $('#modalAddKegiatan').modal('show');
     $('#exampleModalLabel').text('Form Tambah Project Plan');
     $('select[name=id_pp_master]').val('');
     $('.selectpicker').selectpicker('refresh');
     $('#kegiatanBaru').hide();
   }

   function editKegiatan(val, id, st, ft) {
     $('#formKegiatan').attr('action', '<?php echo base_url('projectPlan/ubah/' . $id_pp . '/') ?>' + id);
     $('#modalAddKegiatan').modal('show');
     $('#exampleModalLabel').text('Form Edit Project Plan');
     $('select[name=id_pp_master]').val(val);
     $('.selectpicker').selectpicker('refresh');
     $('#kegiatanBaru').hide();
     $('#kegiatanTanggal').show();
     $('#bodyTambahKegiatan input[name=date_start_target]').attr('required', 'true');
     $('#bodyTambahKegiatan input[name=date_finish_target]').attr('required', 'true');
     if (st != 0 || ft != 0) {
       var st = st.toString();
       var date_st = st.substr(0, 4) + '-' + st.substr(4, 2) + '-' + st.substr(6, 2);
       var ft = ft.toString();
       var date_ft = ft.substr(0, 4) + '-' + ft.substr(4, 2) + '-' + ft.substr(6, 2);
       $('#bodyTambahKegiatan input[name=date_start_target]').val(date_st);
       $('#bodyTambahKegiatan input[name=date_finish_target]').val(date_ft);
     } else {
       $('#bodyTambahKegiatan input[name=date_start_target]').val('');
       $('#bodyTambahKegiatan input[name=date_finish_target]').val('');
     }
   }

   $(".editField").click(function() {
     var idppd = $(this).attr('data-idppd');
     $('#formField').attr('action', '<?php echo base_url('projectPlan/ubahField/' . $id_pp . '/') ?>' + idppd);
     $('#modalField').modal('show');
     var sr = $(this).attr('data-sr');
     var fr = $(this).attr('data-fr');
     var nt = $(this).attr('data-nt');
     var nr = $(this).attr('data-nr');
     var done = $(this).attr('data-done');
     var ket = $(this).attr('data-ket');

     if (sr != null) {
       $('#bodyField input[name=date_start_real]').val(sr);
     } else {
       $('#bodyField input[name=date_start_real]').val('');
     }

     if (fr != null) {
       $('#bodyField input[name=date_finish_real]').val(fr);
     } else {
       $('#bodyField input[name=date_finish_real]').val('');
     }

     if (nt != null) {
       $('#bodyField input[name=n_target]').val(nt);
     } else {
       $('#bodyField input[name=n_target]').val('');
     }
     if (nr != null) {
       $('#bodyField input[name=n_real]').val(nr);
     } else {
       $('#bodyField input[name=n_real]').val('');
     }

     if (done != 0) {
       $('#cekDone').prop('checked', true);
       $('#bodyField input[name=done]').val(1);
     } else {
       $('#cekDone').prop('checked', false);
       $('#bodyField input[name=done]').val(0);
     }

     if (ket != null) {
       $('#bodyField input[name=keterangan]').val(ket);
     } else {
       $('#bodyField input[name=keterangan]').val('');
     }
   });




   $(document).ready(function() {
     $('#dataTable').dataTable({
       ordering: false,
       searching: false,
       paging: false,
       info: false
     });
     $('#dataTable2').dataTable({
       ordering: false,
       searching: false,
       paging: false,
       info: false
     });
     $('#kegiatanBaru').hide();
     $('#kegiatanTanggal').hide();
     $('input[name="done"]').click(function() {
       if ($("#cekDone").prop("checked") == true) {
         $('#bodyField input[name=done]').val(1);
       } else if ($("#cekDone").prop("checked") == false) {
         $('#bodyField input[name=done]').val(0);
       }
     });
   });
 </script>