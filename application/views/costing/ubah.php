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
             <div class="table-responsive">
                 <table class="table table-bordered" width="100%" cellspacing="0">
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
                                <tr>
                                    <td><?php echo $no ?></td>  
                                    <td><?php echo $db['costing'] ?></td>
                                    <td></td>
                                    <td></td>
                                    <?php foreach($kota as $db) { ?>
                                        <td></td>
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
                                    <tr>
                                        <td><?php echo $no ?></td>
                                        <td><?php echo $db['costing'] ?></td> 
                                        <td></td>
                                        <td></td>
                                        <?php foreach($kota as $db) { ?>
                                            <td><a href="" class="ac">abc</a></td>
                                        <?php } ?> 
                                    </tr>
                                    <?php } ?>
                                <?php
                                $no++;
                                 } ?>
                         <?php
                        endforeach;
                        ?>
                        <tr>
                            <th colspan="4">Total</th>
                            <?php foreach($kota as $db) { ?>
                                <td></td>
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
 </script>