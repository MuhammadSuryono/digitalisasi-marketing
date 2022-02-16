 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Costing Proses

     </h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
            <div class="btn-group mb-4 btn-group-toggle">
              <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> Proses
              </label>
              <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"> Cost
              </label>
            </div>

             <div class="table-responsive">
                 <table class="table table-bordered" width="100%" cellspacing="0">
                     <thead id="thead" class="thead-dark">
                         <tr class="text-center">
                             <th rowspan="2">No</th>
                             <th rowspan="2"> </th>
                             <th rowspan="2" width="150px"> Adjustment </th>
                             <th colspan="<?php echo count($kota) ?>">Kota</th>
                         </tr>
                         <tr class="text-center">
                            <?php foreach($kota as $db) { ?>
                              <th><?php echo $db['name_city'] ?></th>
                            <?php } ?>
                         </tr>
                     </thead>
                     <tbody id="showProses">

                     </tbody>
                 </table>
             </div>
         </div>
     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">

             </div>
         </div>
     </div>
 </div>

 <script type="text/javascript">
     $('#option2').on('click', function(){
        var url = '<?php echo base_url('costing/cost/'.$id) ?>';
        window.location.replace(url);
     })

    showProses();
    function showProses(){
        var id = "<?php echo $id ?>";
        $.ajax({
            url : '<?php echo base_url('costing/showProses') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
                var value = "";
                var no = 1;
                for(var i = 0; i<hasil['proses'].length; i++){
                    value +='<tr>'
                    value +='<td class="text-center">'+ no +'</td>'
                    value +='<td>'+ hasil['proses'][i].proses +'</td>'

                    if(hasil['proses'][i].adjust_input == 1){
                        if(hasil['proses'][i].id_proses == 3){
                            if(hasil['adjust'][hasil['proses'][i].id_proses][id] == 0){
                               value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control mapping"><option value="0" selected>0</option><option value="1">1</option></select></td>'
                            }else{
                               value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control mapping"><option value="0">0</option><option value="1" selected>1</option></select></td>'
                            }
                        }else if(hasil['proses'][i].id_proses == 4){
                            if(hasil['adjust'][hasil['proses'][i].id_proses][id] == 0){
                               value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control mapping"><option value="0" selected>0</option><option value="1">1</option></select></td>'
                            }else{
                               value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control mapping"><option value="0">0</option><option value="1" selected>1</option></select></td>'
                            }
                        }else if(hasil['proses'][i].id_proses == 9 || hasil['proses'][i].id_proses == 17){
                            value +='<td> <div class="input-group"><input type="number" id="input" data-id="'+ hasil['proses'][i].id_proses +'" class="input form-control" value="'+hasil['adjust'][hasil['proses'][i].id_proses][id]+'"><div class="input-group-append"><span class="input-group-text" id="basic-addon1">%</span></div></div></td>'
                        }else if(hasil['proses'][i].id_proses == 10){
                            if(hasil['adjust'][hasil['proses'][i].id_proses][id] == 0){
                                value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control input"><option value="0" selected>0</option><option value="1">1</option><option value="1.25">1,25</option></select></td>'
                            }else if(hasil['adjust'][hasil['proses'][i].id_proses][id] == 1){
                                value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control input"><option value="0">0</option><option value="1" selected>1</option><option value="1.25">1,25</option></select></td>'
                            }else{
                               value +='<td><select id="mapping" data-id="'+ hasil['proses'][i].id_proses +'" class="form-control input"><option value="0">0</option><option value="1">1</option><option value="1.25" selected>1,25</option></select></td>'
                            }
                        }else{
                            value +='<td><input type="number" id="input" data-id="'+ hasil['proses'][i].id_proses +'" class="input form-control" value="'+hasil['adjust'][hasil['proses'][i].id_proses][id]+'"></td>'
                        }
                    }else{
                        value +='<td></td>'
                    }
                for(var x = 0; x<hasil['kota'].length; x++){
                    if(hasil['proses'][i].input == 1){
                        value +='<td><input type="number" id-data="'+ hasil['id_proses'][hasil['proses'][i].id_proses][hasil['kota'][x].id_city] +'" value="'+ hasil['data_proses'][hasil['proses'][i].id_proses][hasil['kota'][x].id_city] +'" class="form-control fieldUp"></td>'
                    }else if(hasil['proses'][i].id_proses == 9){
                        value +='<td class="text-center">'+ hasil['data_proses'][hasil['proses'][i].id_proses][hasil['kota'][x].id_city] +' %</td>'
                    }else{
                        value +='<td class="text-center">'+ hasil['data_proses'][hasil['proses'][i].id_proses][hasil['kota'][x].id_city] +'</td>'
                    }
                }
                    value +='</tr>'
                    no++;
                }

                $('#showProses').html(value);
            }
        });
    }

    $(document).on('change','.mapping', function(){
        var id = $(this).attr('data-id');
        var data = $(this).val();
        var rfq = '<?php echo $id ?>';

        $.ajax({
            url : '<?php echo base_url('costing/mapping') ?>',
            method : 'POST',
            dataType :'json',
            data : {id : id, data : data, rfq : rfq},
            success : function(hasil){
                showProses();
            }
        });
    })

    $(document).on('change','.input', function(){
        var id = $(this).attr('data-id');
        var data = $(this).val();
        var rfq = '<?php echo $id ?>';

        if(data == ""){
            console.log('kosong');
        }else{
            $.ajax({
            url : '<?php echo base_url('costing/updateInput') ?>',
            method : 'POST',
            dataType :'json',
            data : {id : id, data : data, rfq : rfq},
            success : function(hasil){
                showProses();
            }
        });
        }
    })

    $(document).on('change','.fieldUp', function(){
        var id = $(this).attr('id-data');
        var data = $(this).val();

        if(data == ""){
            console.log('kosong');
        }else{
            $.ajax({
            url : '<?php echo base_url('costing/fieldUp') ?>',
            method : 'POST',
            dataType :'json',
            data : {id : id, data : data},
            success : function(hasil){
                showProses();
                console.log(data);
            }
        });
        }
    })

 </script>
