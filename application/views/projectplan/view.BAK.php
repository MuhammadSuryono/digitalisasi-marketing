 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
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
            <hr>
            <div class="pb-3 text-right">
                <a href="#" class="addprojectplan btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAddProjectPlan"><i class="fas fa-plus"></i> Tambah Project Plan</a>
            </div>

            <table id="dataTable" class="table table-bordered table-striped dt-responsive">
                <thead class="">
                    <tr class="text-center">
                        <th>No</th>
                        <th>Nama Kegiatan</th>
                        <th>Date Start Target</th>
                        <th>Date Finish Target</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="showKeg">

                </tbody>
            </table>
            <?php $plan = $this->ProjectPlan_model->showdataplan($id);
              foreach ($plan as $key => $value) {
                // code...
              }
            ?>
            <hr>
            <h1 class="h3 mb-4 text-gray-800">Field Status</h1>
            <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>Date Start Target</th>
                        <th>Date Start Real</th>
                        <th>Date Finish Target</th>
                        <th>Date Finish Real</th>
                        <th>N Target</th>
                        <th>N Real</th>
                        <th>Done</th>
                        <th>Keterangan <br><small>(Bila ada penundaan)</small></th>
                    </tr>
                </thead>
                <tbody id="showField">

                </tbody>
            </table>
            </div>
         </div>
     </div>
 </div>
</div>

<script type="text/javascript">
$(document).ready( function() {
  // $('#example').dataTable( {
  //   "sDom": '<"top"i>rt<"bottom"flp><"clear">'
  // } );
  $('#dataTable').dataTable({searching: false, paging: false, info: false});
} );
</script>



<div class="modal fade" id="modalAddProjectPlan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Tambah Project Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <i>Masih dalam pengembangan</i>
                <!-- <form action="<?php echo base_url('projectDocument/tambah/') ?>" method="POST">
                    <div class="form-group">
                        <label>Project</label>
                        <select name="nomor_rfq" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project...">
                            <?php foreach ($list as $data) : ?>
                                <option value="<?php echo $data['nomor_rfq'] ?>"><?php echo $data['nomor_rfq'] ?> - <?php echo $data['kode_project'] ?> - <?php echo $data['nama_project'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form> -->
            </div>
        </div>
    </div>
</div>















<div class="modal fade" id="undanganModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formU">
            <input type="hidden" name="id" value="<?php echo $rfq['nomor_rfq'] ?>">
            <input type="hidden" name="ket" id="ket" name="id">
            <div class="form-group">
                <label>Tanggal</label>
                <input type="text" value="" class="form-control" id="tgl" name="tgl" readonly="">
            </div>
            <div class="form-group">
                <label>Jam</label>
                <input type="time" class="form-control" name="jam">
            </div>
            <div>
                <label>Tempat</label>
                <input type="text" value="" class="form-control" name="tempat">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSend" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
      </div>
    </div>
  </div>
</div>
<div id="snackbar" class="toast" data-autohide="false">
    <div class="toast-header">
      <strong class="mr-auto text-primary">Notif</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
    </div>
    <div class="toast-body">

    </div>
  </div>
<div id="snackbar2" data-autohide="false" class="bg-primary text-white toast">Mengirim undangan...</div>

<script type="text/javascript">
    var date = '<?php echo date('Y-m-d') ?>';

    //showData();
    //showField();

    function showData()
    {
        var id = <?php echo $id ?>;

        $.ajax({
            url : '<?php echo base_url('projectPlan/showdata') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
                var html = '';
                var date = '';
                for(var i = 0; i<hasil['show'].length; i++){


                   if(hasil['show'][i].ket == 2){
                    date = hasil['show'][i].date_finish_target;
                   }

                   if(hasil['show'][i].ket == 3){
                    date_f = hasil['show'][i].date_finish_target;
                   }

                   html += '<tr><th class="text-center">'+ (i+1) +'</th>';

                   html += '<th>'+hasil['show'][i].nama_kegiatan+'</th>'
                   if(hasil['show'][i].ket == 1){
                    html += '<td class="text-center">'+hasil['spec']['mulai']+'</td>'
                    html += '<td class="text-center">'+hasil['spec']['selesai']+'</td>'
                   }else{
                    if(hasil['show'][i].date_start_target == null){
                        if(hasil['show'][i].ket == 3){
                            html +='<td class="text-center">'+ date +'</td>'
                        }else{
                            html +='<td class="text-center start'+hasil['show'][i].id_detail_pp+'"><a href="" data-id='+hasil['show'][i].id_detail_pp+' data-field="start" data-value="'+hasil['show'][i].date_start_target+'" class="ubah float-right"><i class="fas fa-calendar text-info"></i></a></td>'
                        }
                    }else{
                        html +='<td class="text-center start'+hasil['show'][i].id_detail_pp+'">'+hasil['show'][i].date_start_target+' <a href="" data-id='+hasil['show'][i].id_detail_pp+' data-field="start" data-value="'+hasil['show'][i].date_start_target+'" class="float-right ubah"><i class="fas fa-calendar text-info"></i></a></td>'
                    }

                    if(hasil['show'][i].date_finish_target == null){
                        html +='<td class="text-center finish'+hasil['show'][i].id_detail_pp+'"><a href="" data-id='+hasil['show'][i].id_detail_pp+' data-field="finish" data-value="'+hasil['show'][i].date_finish_target+'" class="float-right ubah"><i class="fas fa-calendar text-info"></i></a></td>'
                    }else{
                        html +='<td class="text-center finish'+hasil['show'][i].id_detail_pp+'">'+hasil['show'][i].date_finish_target+' <a href="" data-id='+hasil['show'][i].id_detail_pp+' data-field="finish" data-value="'+hasil['show'][i].date_finish_target+'" class="float-right ubah"><i class="fas fa-calendar text-info"></i></a></td>'
                    }

                   }

                   if(hasil['show'][i].undangan == 0){
                    html +='<td class="text-center"><button type="button" class="btn btn-info btn-sm undangan" data-id="'+hasil['show'][i].id_detail_pp+'" data-value="'+hasil['show'][i].nama_kegiatan+'" data-tanggal="'+hasil['show'][i].date_start_target+'" class="btn btn-info btn-sm"><i class="fas fa-paper-plane"></i> Kirim undangan</button>'
                   }else{
                    html +='<td></td>'
                   }

                   html += '</tr>';
                }

                $('#showKeg').html(html);
            }
        });
    }

    function showField(){
        var id = <?php echo $id ?>;

        $.ajax({
            url : '<?php echo base_url('projectPlan/showField') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
                var content = '';

                content += '<tr class="text-center">'
                content += '<th>'+hasil['show_'].date_finish_target+'</th>'
                if(hasil['show'].date_start_real > hasil['show_'].date_finish_target){
                   content +='<td class="bg-info text-white field-td-start_r">'+ hasil['show'].date_start_real +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="start_r" data-value="'+hasil['show'].date_start_real+'" class="float-right ubah-field"><i class="fas fa-calendar text-white"></i></a></td>'
                }else{
                   content +='<td class="field-td-start_r">'+ hasil['show'].date_start_real +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="start_r" data-value="'+hasil['show'].date_start_real+'" class="float-right ubah-field"><i class="fas fa-calendar text-info"></i></a></td>'
                }

                content += '<th>'+hasil['show'].date_finish_target+'</th>'

                if(hasil['show'].date_finish_real > hasil['show'].date_finish_target){
                   content +='<td class="bg-info text-white field-td-finish_r">'+ hasil['show'].date_finish_real +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="finish_r" data-value="'+hasil['show'].date_finish_real+'" class="float-right ubah-field"><i class="fas fa-calendar text-white"></i></a></td>'
                }else{
                   content +='<td class="field-td-finish_r">'+ hasil['show'].date_finish_real +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="finish_r" data-value="'+hasil['show'].date_finish_real+'" class="float-right ubah-field"><i class="fas fa-calendar text-info"></i></a></td>'
                }

                content +='<th id="n_t" data="'+ hasil['respon'] +'">'+ hasil['respon'] +'</th>'
                content +='<td class="field-td-n">'+ hasil['show'].n_real +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="n" data-value="'+hasil['show'].n_real+'" class="float-right ubah-field_"><i class="fas fa-pen text-info"></i></td>'
                if(hasil['show'].done != 1){
                    if(hasil['show'].date_finish_target == date){
                        content +='<td class="bg-danger"><input class="ceklis" type="checkbox" value="'+hasil['show'].id_detail_pp+'"></td>'
                    }
                    else if(hasil['show'].date_finish_target < date){
                        content +='<td class="done"><input class="ceklis" type="checkbox" value="'+hasil['show'].id_detail_pp+'"></td>'
                    }else{
                        content +='<td><input class="ceklis" type="checkbox" value="'+hasil['show'].id_detail_pp+'"></td>'
                    }
                }else{
                   content +='<td class="bg-success text-white"><i class="fas fa-check"></i></td>'
                }

                content +='<td class="field-td-ket">'+ hasil['show'].keterangan +' <a href="" data-id='+hasil['show'].id_detail_pp+' data-field="ket" data-value="'+hasil['show'].keterangan+'" class="float-right ubah-field_"><i class="fas fa-pen text-info"></i></td>'
                content +='</tr>'

                $('#showField').html(content);

                blinkBg();
            }
        });
    }

    $(document).on('click','.ceklis', function(){
        var id = $(this).val();
        var done = 1;

        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, done it!'
        }).then((result) => {
          if (result.value) {
              $.ajax({
                url : '<?php echo base_url('projectPlan/ubah') ?>',
                method : 'POST',
                dataType :'json',
                data : { id : id, done : done },
                success : function(hasil){
                    Swal.fire(
                      'Done!',
                      'Your status has been done.',
                      'success'
                    )
                    showField();
                }
             });
          }else if(result.dismiss === Swal.DismissReason.cancel){
            $('.ceklis').prop('checked', false);
          }
        })

    });

    function blinkBg(){
        $('.done').addClass('bg-danger');
        $('.done').addClass('text-white');
        setTimeout('blinkBh()', 500);
    }

    function blinkBh(){
        $('.done').removeClass('bg-danger');
        $('.done').removeClass('text-white');
        setTimeout('blinkBg()', 500);
    }

    $(document).on('click','.ubah', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var field = $(this).attr('data-field');
        var value = $(this).attr('data-value');

        $('.'+field+id).html('<form id="myForm"><input type="hidden" value="'+id+'" name="id"><div class="input-group"><input type="date"  name="'+field+'" value="'+value+'" class="input form-control float-left"><div class="input-group-append"><button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-times"></i></button></div></div></form>')
    });

    $(document).on('click','.undangan', function(e){
        var id = $(this).attr('data-id');
        var value = $(this).attr('data-value');
        var tanggal = $(this).attr('data-tanggal');

        $('#undanganModal').modal('show');
        $('#undanganModal').find('.modal-title').text('Undangan '+value);
        $('#tgl').val(tanggal);
        $('#ket').val(value);

    });

    $('#btnSend').on('click', function(){
        var data = $('#formU').serialize();

        $('#undanganModal').modal('hide');
        $('#snackbar2').toast('show');

        $.ajax({
            url : '<?php echo base_url('projectPlan/sendUndangan') ?>',
            method : 'POST',
            dataType :'json',
            data : data,
            success : function(hasil){
                $('#snackbar2').toast('hide');
                if(hasil == 'terkirim'){
                    $('#snackbar').toast('show');
                    $('.toast-body').html('<i class="fas fa-check text-success"></i> Email  Berhasil Terkirim');
                }else{
                    $('#snackbar').toast('show');
                    $('.toast-body').html('<i class="fas fa-times text-danger"></i> Email  Gagal Terkirim');
                }
            }
        });
    });

    $(document).on('click','.ubah-field', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var field = $(this).attr('data-field');
        var value = $(this).attr('data-value');

        $('.field-td-'+field).html('<form id="myForm"><input type="hidden" value="'+id+'" name="id"><div class="input-group"><input type="date"  name="'+field+'" value="'+value+'"  class="input form-control"><div class="input-group-append"><button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-times"></i></button></div></div></form>')
    });

    $(document).on('click','.ubah-field_', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var field = $(this).attr('data-field');
        var value = $(this).attr('data-value');

        $('.field-td-'+field).html('<form action="javascript:void(0);" id="myForm"><input type="hidden" value="'+id+'" name="id"><div class="input-group"><input type="text"  name="'+field+'" value="'+value+'" class="input-n form-control"><div class="input-group-append"><button class="btn btn-danger btn-sm remove" type="button"><i class="fas fa-times"></i></button></div></div></form> ')
    });

    $(document).on('click','.remove', function(e){
        e.preventDefault();
        showData();
        showField();
    });

    $(document).on('keypress','.input', function(e){
        var data = $('#myForm').serialize();

        if(e.which == 13){
             $.ajax({
                url : '<?php echo base_url('projectPlan/ubah') ?>',
                method : 'POST',
                dataType :'json',
                data : data,
                success : function(hasil){
                    showData();
                    showField();
                }
             });
        }
    });

    $(document).on('keypress','.input-n', function(e){
        var data = $('#myForm').serialize();
        var target = $('#n_t').attr('data');

        if(e.which == 13){
            if($(this).attr('name') == 'n'){
            if($(this).val() > target){
                    Swal.fire({
                      type: 'error',
                      title: 'Oops...',
                      text: 'Data input lebih dari Data target atau format bukan angka',
                    })
                }else{
                     $.ajax({
                        url : '<?php echo base_url('projectPlan/ubah') ?>',
                        method : 'POST',
                        dataType :'json',
                        data : data,
                        success : function(hasil){
                            showData();
                            showField();
                        }
                     });
                 }
            }else{
              $.ajax({
                    url : '<?php echo base_url('projectPlan/ubah') ?>',
                    method : 'POST',
                    dataType :'json',
                    data : data,
                    success : function(hasil){
                        showData();
                        showField();
                    }
                 });
            }
        }
    });

</script>
