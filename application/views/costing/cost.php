 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Costing</h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="btn-group mb-4 btn-group-toggle">
              <label class="btn btn-secondary ">
                <input type="radio" name="options" id="option1" autocomplete="off"> Proses
              </label>
              <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option2" autocomplete="off" checked> Cost
              </label>
            </div>
             <div class="table-responsive">
                 <table class="table table-bordered"  width="100%" cellspacing="0">
                     <thead id="thead" class="thead-dark">
                         <tr class="text-center">
                             <th rowspan="2">No</th>
                             <th rowspan="2">Cost</th>
                             <th rowspan="2"> - </th>
                             <th rowspan="2"> - </th>
                             <th colspan="<?php echo count($kota) ?>">Kota</th>
                         </tr>
                         <tr class="text-center">
                            <?php foreach($kota as $db) { ?>
                             <th><?php echo $db['name_city'] ?></th>
                            <?php } ?>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                         $no=1;
                          foreach ($cost as $db) { ?>
                                <?php if($db['id_sub_cost'] == 0) { ?>
                                <?php $jmlSUm[] = array_sum($tampil[$db['id_cost']]); ?>
                                <tr>
                                    <td><?php echo $no ?></td>  
                                    <td><?php echo $db['costing'] ?></td>
                                    <?php if($db['nilai'] != 0) { ?>
                                        <td width="100" class="text-center bg-warning text-white">
                                            <input type="text" data-id="<?= $db['id_cost'] ?>" data-n="1" name="nilai" value="<?php echo $db['nilai'] ?>" class="nilai form-control">        
                                        </td>
                                    <?php }else{ ?>
                                        <td class="text-center bg-warning text-white"></td>
                                    <?php } ?>
                                    <th><?php echo number_format(array_sum($tampil[$db['id_cost']]),1) ?></th>
                                    <?php foreach($kota as $data) { ?>
                                        <?php 
                                        $jumlah[$data['id_city']][] = $tampil[$db['id_cost']][$data['id_city']];
                                        ?>
                                        <td class="text-center"><?php echo number_format($tampil[$db['id_cost']][$data['id_city']], 1) ?></td>
                                    <?php } ?>   
                                </tr>
                                <?php } ?>
                         <?php 
                         $no++;
                            } ?>
                         <?php foreach ($sub as $data) : ?>
                                <tr class="thead-dark">
                                    <th  colspan="<?php echo count($kota)+4 ?>"><?php echo $data['sub_cost'] ?></th>
                                </tr>
                                <?php
                                $no = 1;
                                foreach ($cost as $db) { ?>
                                    <?php if($data['id_sub_cost'] == $db['id_sub_cost']) { ?>
                                     <?php $jmlSUm[] = array_sum($tampil[$db['id_cost']]); ?>
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <?php if($db['id_cost'] == 22) { ?>
                                            <td class="bg-primary text-white"><?php echo $db['costing'] ?></td> 
                                        <?php }else{ ?>
                                            <td><?php echo $db['costing'] ?></td> 
                                        <?php } ?>
                                        <td class="text-center bg-warning text-white">
                                         <?php if($db['nilai'] != 0) { ?>
                                            <input type="text" data-id="<?= $db['id_cost'] ?>" data-n="1" name="nilai" value="<?php echo $db['nilai'] ?>" class="nilai form-control">
                                         <?php } ?>
                                         <?php if($db['nilai2'] != 0) { ?>
                                            <input type="text" data-id="<?= $db['id_cost'] ?>" data-n="2" name="nilai2" value="<?php echo $db['nilai2'] ?>" class="nilai form-control">
                                         <?php } ?>
                                        </td>
                                        <th><?php echo number_format(array_sum($tampil[$db['id_cost']]),1) ?></th>
                                        <?php foreach($kota as $dat) { ?>
                                            <?php if($db['id_cost'] == 22) { ?>
                                                <?php 
                                                $jumlah[$dat['id_city']][] = $tampil[$db['id_cost']][$dat['id_city']];
                                                 ?>
                                                <td class="text-center bg-danger text-white"><?php echo $tampil[$db['id_cost']][$dat['id_city']] ?></td>
                                            <?php }else{ ?>
                                                <?php if($tampil[$db['id_cost']][$dat['id_city']] == '-') { ?>
                                                    <td class="text-center"><?php echo $tampil[$db['id_cost']][$dat['id_city']] ?></td>
                                                <?php }else{ ?>
                                                    <?php 
                                                    $jumlah[$dat['id_city']][] = $tampil[$db['id_cost']][$dat['id_city']];
                                                     ?>
                                                    <td class="text-center"><?php echo number_format($tampil[$db['id_cost']][$dat['id_city']],1) ?></td>
                                                <?php } ?>
                                            <?php } ?>
                                        <?php } ?> 
                                    </tr>
                                    <?php } ?>
                                <?php
                                $no++;
                                 } ?>
                         <?php
                        endforeach;
                        ?>
                        <tr class="thead-dark">
                            <th colspan="3">Total</th>
                                <th><?php echo number_format(array_sum($jmlSUm)) ?></th>
                            <?php foreach($kota as $db) { ?>
                                <th><?php echo number_format(array_sum($jumlah[$db['id_city']]),1) ?></th>
                            <?php } ?>  
                        </tr>
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
     $('.ac').on('click', function(e){
        e.preventDefault();
        location.reload();
     });

     $('#option1').on('click', function(){
        var url = '<?php echo base_url('costing/view/'.$id) ?>';
        window.location.replace(url);
     })

     $(document).on('change','.nilai', function(){
        var id = $(this).attr('data-id');
        var n = $(this).attr('data-n');
        var data = $(this).val();

        if(data == ""){
            console.log('kosong');
        }else{
            $.ajax({
                url : '<?php echo base_url('costing/updateNilaiCost') ?>',
                method : 'POST',
                dataType :'json',
                data : {id : id, data : data, n : n},
                success : function(hasil){
                    location.reload();
                }
        });
        }
    })

 </script>
