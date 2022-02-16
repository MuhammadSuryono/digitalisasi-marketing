<!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Project Spec</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Form Project Spec</h6>
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

<?php echo $ps['tgl_mulai'] ?>

           <div id="accordion">

             <div class="card">
               <div class="card-header">
                 <a class="card-link" data-toggle="collapse" href="#collapseOne">
                   <span data-toggle="tooltip" data-placement="top" title="Klik untuk membuka atau menyembunyikan tab"><i class="fas fa-user-tag"></i> Tambah Responden</span>
                 </a>
               </div>
               <div id="collapseOne" class="collapse show">
                 <div class="card-body">

                   <div class="row">
                     <div class="col-md-6">
                       <label>Pilih Kota Responden</label>
                       <select id="kota"  class="form-control mb-2 selectpicker show-tick" data-live-search="true" title="Pilih kota..." name="kota">
                        <?php foreach($kota as $db) { ?>
                          <option value="<?php echo $db['id_kota'] ?>"><?php echo $db['kota'] ?></option>
                        <?php } ?>
                       </select>
                     </div>
                     <div class="col-md-6">
                       <label>Jumlah Responden</label>
                       <input id="jumlah" type="number" min="1" name="jumlah" placeholder="Jumlah responden" class="form-control">
                     </div>
                     <div class="col-md-12">
                       <button type="button" name="tambah" id="addKota" class="btn btn-sm btn-info mt-2" style="width:100%;"><i class="fas fa-user-plus"></i> Tambah Responden</button>
                     </div>
                     <div class="col-12 mt-3">
                       <table class="table text-center table-sm table-bordered">
                           <thead>
                               <tr>
                                   <th width="45%">Kota Responden</th>
                                   <th width="45%">Jumlah Responden</th>
                                   <th width="10%">Opsi</th>
                               </tr>
                           </thead>
                           <tbody id="showKota">
                           </tbody>
                       </table>
                     </div>
                   </div>

                 </div>
               </div>
             </div>
             <div class="card">
               <div class="card-header">
                 <a class="card-link" data-toggle="collapse" href="#collapseTwo">
                   <span data-toggle="tooltip" data-placement="top" title="Klik untuk membuka atau menyembunyikan tab"><i class="fas fa-calendar-check"></i> Project Spec</span>
                 </a>
               </div>
               <div id="collapseTwo" class="collapse show">
                 <div class="card-body">

                   <form method="POST" action="<?php echo base_url('projectSpec/ubah/'.$rfq['nomor_rfq']) ?>">
                     <div class="row">
                       <div class="col-md-6">
                           <label for="tgl_mulai">Tanggal Mulai</label>
                           <input type="date" value="<?php echo $ps['tgl_mulai'] ?>" name="tgl_mulai" class="form-control" required>
                       </div>
                       <div class="col-md-6">
                           <label for="tgl_selesai">Tanggal Selesai</label>
                           <input type="date" name="tgl_selesai" value="<?php echo $ps['tgl_selesai'] ?>" class="form-control" required>
                       </div>
                       <style type="text/css">.tbl-spec{table-layout:fixed!important;width:100%!important;word-wrap:break-word!important}.tbl-logo{text-align:center!important;vertical-align:middle!important}.b-t{border-top:1px solid #000!important}.b-b{border-bottom:1px solid #000!important}.b-l{border-left:1px solid #000!important}.b-r{border-right:1px solid #000!important}.b-all{border:1px solid #000!important}.bg-b{background:#000!important;color:#FFF!important;font-weight:bold!important;text-align:center!important}.text-center{text-align:center!important}</style>
                       <div class="col-12 mt-2">
                           <label for="keterangan">Keterangan</label>
                           <div id="txtArea1">
                             <textarea id="summernote" name="keterangan"><?php echo htmlspecialchars_decode($ps['keterangan'], ENT_QUOTES) ?></textarea>
                           </div>
                           <!-- <div id="txtArea2" style="display:none;">
                             <textarea id="summernote2"></textarea>
                           </div> -->
                       </div>
                       <div class="col-12">
                         <p><a href="<?php echo base_url('rfq/status/'.$rfq['nomor_rfq']) ?>" target="_blank"><i><u>Klik disini untuk buka RFQ dari Marketing</u></i></a></p>
                       </div>
                       <div class="col-12 text-right">
                         <div class="form-group">
                           <button type="submit" class="btn btn-primary" id="btnSave"><i class="fas fa-save"></i> Save</button>
                           <?php if ($ps['setuju']): ?>
                             <button type="button" class="btn btn-success" onclick="view()" data-toggle="modal" data-target="#viewModal"><i class="fas fa-file"></i> Lihat PDF</button>
                             <a href="<?php echo base_url('projectSpec/printPdf/download/'.$rfq['nomor_rfq']) ?>" target="_blank"><button type="button" class="btn btn-primary"><i class="fas fa-download"></i> Unduh PDF</button></a><br><small class="text-danger">Klik save terlebih dahulu untuk update file PDF *</small>
                           <?php endif; ?>

                         </div>
                       </div>
                     </div>
                   </form>

                 </div>
               </div>
             </div>

           </div> <!-- END ACCORDION -->
         </div> <!-- END CARD-BODY -->
     </div> <!-- END CARD -->

     <!-- ADDED AND CUSTOMIZED BY ADAM SANTOSO -->
     <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentLabel" aria-hidden="true">
       <div class="modal-dialog mw-100 w-75" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="viewDocumentLabel">View Document Project Spec</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <div id="viewDocumentSpec"></div>
           </div>
         </div>
       </div>
     </div>
     <script type="text/javascript">
     function view() {
       var url = '<?php echo base_url('projectSpec/printPdf/view/'.$rfq['nomor_rfq']) ?>';
       var options = {
         height: "500px",
         fallbackLink: "<p>This browser does not support inline PDF. Please download the PDF to view it: <a href='<?php echo base_url('projectSpec/printPdf/download/'.$rfq['nomor_rfq']) ?>'>Download PDF</a></p>"
       };
       PDFObject.embed(url, "#viewDocumentSpec", options);
     }
     </script>
     <!-- ==== -->

     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-users"></i> Team</h6>
         </div>

         <div class="card-body">
           <!-- Update BY ADAM SANTOSO -->
           <div class="row">
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   RE
                 </div>
                 <div class="col-12 text-center">
                   <select id="re" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($re as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pRe" name="status" class="form-check-input"><label for="pRe" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnRe" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timRe" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   DP
                 </div>
                 <div class="col-12 text-center">
                   <select id="dp" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($dp as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pDp" name="status" class="form-check-input"><label for="pDp" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnDp" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timDp" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   Field
                 </div>
                 <div class="col-12 text-center">
                   <select id="field" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($field as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pField" name="status" class="form-check-input"><label for="pField" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnField" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timField" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
           </div>

           <div class="row">
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   QA
                 </div>
                 <div class="col-12 text-center">
                   <select id="qa" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($qa as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pQa" name="status" class="form-check-input"><label for="pQa" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnQa" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timQa" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   Auvi
                 </div>
                 <div class="col-12 text-center">
                   <select id="auvi" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($auvi as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pAuvi" name="status" class="form-check-input"><label for="pAuvi" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnAuvi" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timAuvi" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
             <div class="col-md-4 border">
               <div class="row">
                 <div class="col-12 text-center align-middle py-3 font-weight-bold" style="background:#f2f2f2;">
                   Finance
                 </div>
                 <div class="col-12 text-center">
                   <select id="finance" class="form-control mb-2 selectpicker mt-2" data-live-search="true" title="Pilih tim...">
                       <?php foreach ($finance as $db) { ?>
                       <option value="<?php echo $db['id_user'] ?>"><?php echo $db['nama_user'] ?></option>
                       <?php } ?>
                   </select>
                   <div class="form-check form-check-inline">
                     <input type="checkbox" id="pFinance" name="status" class="form-check-input"><label for="pFinance" class="form-check-label">Checklis bila tim level 1</label>
                   </div>
                   <button class="btn btn-primary btn-block mb-2" id="btnFinance" type="button"><i class="fas fa-angle-double-down"></i></button>
                   <hr>
                   <ul id="timFinance" class="list-group mb-2">
                   </ul>
                 </div>
               </div>
             </div>
           </div>
           <div class="row">
             <div class="col-12 text-right py-2" style="background:#f2f2f2;">
               <button type="button" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> Kirim Email ke Tim Terpilih</button>
             </div>
           </div>

         </div>
     </div>
 </div>
 <!-- /.container-fluid -->
 </div>
 <!-- End of Main Content -->
 <!-- <td><button type="button" data="8" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> RE</button></td>
 <td><button type="button" data="9" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> DP</button></td>
 <td><button type="button" data="10" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> Field</button></td>
 <td><button data="11" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> QA</button></td>
 <td><button data="12" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> Auvi</button></td>
 <td><button data="13" class="btn btn-info mailTim"><i class="fas fa-envelope"></i> Finance</button></td>
 -->


<script type="text/javascript">
     $('#addKota').click(function(){
        var id_kota = $('#kota').val();
        var jumlah = $('#jumlah').val();
        var rfq = $('#rfq').val();
        if(id_kota == '' || jumlah == ''){
            Swal({
              title: 'Oops...',
              text: 'Kota dan jumlah responden harus di isi',
              type: 'error',
              confirmButtonText: 'Tutup'
            })
        }else{
            $.ajax({
                url : '<?php echo base_url('projectSpec/addResponden') ?>',
                method : 'POST',
                dataType :'json',
                data : {rfq : rfq, id_kota:id_kota, jumlah:jumlah },
                success : function(hasil){
                    kota();
                    $('#kota').val('').removeClass('is-invalid');
                    $('#kota').selectpicker('refresh');
                    $('#jumlah').val('').removeClass('is-invalid');
                }
            });
        }
    });
    $(document).on('click', '.del-kota', function(){
        var id = $(this).attr('id-data');
        $.ajax({
            url : '<?php echo base_url('projectSpec/deleteKota') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
              $('#barisKota'+id).remove();
              kota();
            }
        })
    });

    $('#btnRe').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#re').val();
        if($('#pRe').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(status);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timRe()
                  $('#pRe').prop('checked', false);
              }
          });
        }
    });


    $('#btnDp').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#dp').val();
        if($('#pDp').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(rfq);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timDp()
                  $('#pDp').prop('checked', false);
              }
          });
        }
    });

    $('#btnField').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#field').val();
        if($('#pField').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(rfq);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timField()
                  $('#pField').prop('checked', false);
              }
          });
        }
    });

    $('#btnQa').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#qa').val();
        if($('#pQa').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(rfq);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timQa()
                  $('#pQa').prop('checked', false);
              }
          });
        }
    });

    $('#btnAuvi').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#auvi').val();
        if($('#pAuvi').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(rfq);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timAuvi()
                  $('#pAuvi').prop('checked', false);
              }
          });
        }
    });

    $('#btnFinance').click(function(){
        var rfq = $('#rfq').val();
        var user = $('#finance').val();
        if($('#pFinance').is(':checked')){
            var status = 1;
        } else {
            var status = 0;
        }
        //console.log(rfq);
        if(user == ''){
            Swal({
              title: 'Oops...',
              text: 'Tim belum dipilih',
              type: 'error',
              showConfirmButton: false,
              timer: 1000
            })
        }else{
          $.ajax({
              url : '<?php echo base_url('projectSpec/addTim') ?>',
              method : 'POST',
              dataType :'json',
              data : {rfq : rfq, user:user, status:status },
              success : function(hasil){
                  timFinance()
                  $('#pFinance').prop('checked', false);
              }
          });
        }
    });

    $(document).on('click', '.del-tim', function(){
        var id = $(this).attr('id-data');

        $.ajax({
            url : '<?php echo base_url('projectSpec/deleteTim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
                timRe();
                timDp();
                timField();
                timQa();
                timAuvi();
                timFinance();
            }
        })
    });




    $('.mailTim').click(function(){
        var id = $(this).attr('data');
        var rfq = $('#rfq').val();
        var id = [];
        var re = $('input[name^=re]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();
        var dp = $('input[name^=dp]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();
        var field = $('input[name^=field]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();
        var qa = $('input[name^=qa]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();
        var auvi = $('input[name^=auvi]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();
        var finance = $('input[name^=finance]').map(function(idx, elem) {
          id.push($(elem).val());
        }).get();

        $(this).prop('disabled', true);
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...');
        $.ajax({
           type : 'ajax',
           method : 'GET',
           url : '<?php echo base_url() ?>projectSpec/kirimEmail',
           data : {id:id, rfq:rfq},
           dataType : 'json',
           success: function(data){
            console.log(data);
              if(data == 'terkirim'){
                Swal({
                  title: 'Success',
                  text: 'Email Berhasil Terkirim',
                  type: 'success',
                  showConfirmButton: false,
              		timer: 2500
                })
              }else{
                Swal({
                  title: 'Oopss...',
                  text: 'Email Gagal Terkirim',
                  type: 'error',
                  showConfirmButton: false,
              		timer: 2500
                })
              }
              $('.mailTim').prop('disabled', false);
              $('.mailTim').html('<i class="fas fa-envelope"></i> Kirim Email ke Tim Terpilih');
           },
           error: function(jqXHR,error, errorThrown) {
             Swal({
               title: 'Oopss...',
               text: 'Email Gagal Terkirim',
               type: 'error',
               showConfirmButton: false,
               timer: 2500
             })
             $('.mailTim').prop('disabled', false);
             $('.mailTim').html('<i class="fas fa-envelope"></i> Kirim Email ke Tim Terpilih');
          }
        });
    });

    kota();
    timRe();
    timDp();
    timField();
    timQa();
    timAuvi();
    timFinance();

    // EDIT BY ADAM SANTOSO
    function kota(){
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/responden') ?>',
            method : 'GET',
            dataType :'json',
            data : {rfq : rfq},
            success : function(hasil){
              console.log(hasil);
              if(hasil == 'error'){
                var tr = '<tr id="belumAdaResponden"><td colspan="3">Data responden belum ditambahkan</td></tr>';
                onLoadTXT('Area: ');
                $('#listKota').text('Area: ');
                $('#showKota').html(tr);
              }else{
                $('table#showKota tr#belumAdaResponden').hide();
                var html = '',list = '';
                for(var i = 0; i<hasil.length; i++){
                  if(i == hasil.length-1){
                    list += hasil[i].kota;
                  }else{
                    list += hasil[i].kota+', ';
                  }
                    html +='<tr id="barisKota'+hasil[i].id_responden+'"><td>'+hasil[i].kota+'</td><td>'+hasil[i].jumlah+'</td><td><button type="button" class="btn btn-danger btn-sm del-kota" id-data="'+hasil[i].id_responden+'"><i class="fas fa-minus"></i></button></td></tr>';
                }
                onLoadTXT('Area: '+list);
                $('#listKota').text('Area: '+list);
                var markupStr = $('#summernote').summernote('code');
                $('#summernote').summernote('code', markupStr);
                $('#showKota').html(html);
              }
              dataPP();
            },
            error: function(jqXHR,error, errorThrown) {
              var tr = '<tr id="belumAdaResponden"><td colspan="3">Data responden belum ditambahkan</td></tr>';
              onLoadTXT('Area: ');
              $('#listKota').text('Area: ');
              $('#showKota').html(tr);
              dataPP();
           }
        });
    }

    function dataPP(){
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/updatePP') ?>',
            method : 'GET',
            dataType :'json',
            data : {rfq : rfq},
            success : function(hasil){
              if(hasil == 'error'){
                $("#listPP").empty();
                var tr = '<table cellspacing="0" class="tbl-spec"><tr class="bg-b"><td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td><td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-r text-center" width="25%"><b>Date</b></td></tr><tr><td colspan="5" class="text-center b-all">Data Project Plan belum ditambahkan</td></tr></table>';
                $("#listPP").html(tr);
              }else{
                $("#listPP").empty();
                $("#listPP").html(hasil);
                var markupStr = $('#summernote').summernote('code');
                $('#summernote').summernote('code', markupStr);
              }
            },
            error: function(jqXHR,error, errorThrown) {
              $("#listPP").empty();
              var tr = '<table cellspacing="0" class="tbl-spec"><tr class="bg-b"><td class="b-t b-l text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-l b-r text-center" width="25%"><b>Date</b></td><td class="b-t b-r text-center" width="25%"><b>Schedule Details</b></td><td class="b-t b-r text-center" width="25%"><b>Date</b></td></tr><tr><td colspan="5" class="text-center b-all">Data Project Plan belum ditambahkan</td></tr></table>';
              $("#listPP").html(tr);
           }
        });
    }

    function onLoadTXT(list){
      $('#listKota').text(list);
      // TEXT AREA UNTUK KETERANGAN
      $('#summernote').summernote({
        placeholder: 'Keterangan Project Spec',
        followingToolbar: true,
        codeviewFilter: false,
        codeviewIframeFilter: true,
        // tabsize: 2,
        // height: 100
        toolbar: [
          // [groupName, [list of button]]
          ['misc', ['undo', 'redo', 'codeview']],
          ['style', ['bold', 'italic', 'underline', 'clear']],
          ['font', ['strikethrough', 'superscript', 'subscript']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
        ]
      });

      // $('#summernote2 ').summernote({
      //   placeholder: 'Keterangan Project Spec',
      //   followingToolbar: true,
      //   toolbar: [
      //     ['misc', ['undo', 'redo', 'codeview']],
      //     ['style', ['bold', 'italic', 'underline', 'clear']],
      //     ['font', ['strikethrough', 'superscript', 'subscript']],
      //     ['color', ['color']],
      //     ['para', ['ul', 'ol', 'paragraph']],
      //     ['table', ['table']],
      //   ]
      // });

      // ==== //
    }

    $(document).ready(function(){
        $('#btnSave').click(function() {
          // $('#txtArea1').hide();
          // $('#txtArea2').show();
          var markupStr = $('#summernote').summernote('code');
          // $('#summernote').summernote('code', htmlspecialchars(markupStr));
          $('#summernote').summernote('code', markupStr);
          // $('#summernote2').summernote('code', markupStr);
        });
    });

    function htmlspecialchars(str) {
      return str
         .replace(/&/g, "&amp;")
         .replace(/</g, "&lt;")
         .replace(/>/g, "&gt;")
         .replace(/"/g, "&quot;")
         .replace(/'/g, "&#039;");
    }

    function timRe(){
        var id = 8;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="re[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{

                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="re[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timRe').html(html);
            }
        });
    }

    function timDp(){
        var id = 9;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="dp[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{

                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="dp[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timDp').html(html);
            }
        });
    }

    function timField(){
        var id = 10;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="field[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="field[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timField').html(html);
            }
        });
    }

    function timQa(){
        var id = 11;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="qa[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="qa[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timQa').html(html);
            }
        });
    }

    function timAuvi(){
        var id = 12;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="auvi[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="auvi[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timAuvi').html(html);
            }
        });
    }

    function timFinance(){
        var id = 13;
        var rfq = $('#rfq').val();
        $.ajax({
            url : '<?php echo base_url('projectSpec/tim') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id, rfq : rfq},
            success : function(hasil){
                var html = '';
                //console.log(hasil);
                for(var i = 0; i<hasil.length; i++){
                    if(hasil[i].status == 1){
                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="finance[]" value="'+hasil[i].id_team_ps+'"/><b>'+hasil[i].nama_user+'</b><i class="fas fa-user-circle"></i> <span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                    }else{

                      html +=' <li class="list-group-item d-flex justify-content-between align-items-center"><input type="hidden" name="finance[]" value="'+hasil[i].id_team_ps+'"/>'+hasil[i].nama_user+'<span class="badge"><button type="button" class="btn btn-danger btn-sm del-tim" id-data="'+hasil[i].id_team_ps+'"><i class="fas fa-minus"></i></button></span></li>';
                   }
                }
                $('#timFinance').html(html);
            }
        });
    }
 </script>
