 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menu Management <i class="fas fa-angle-right "></i> <?= $menu['menu'] ?></h1>
            <button type="button"  onclick="window.location.href='<?= base_url('menu/akses') ?>'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Akses</button>
        </div>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#tambah" class="btn btn-primary mb-4">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead class="thead-dark">
                         <tr class="text-center">
                             <th rowspan="2">No</th>
                             <th rowspan="2">Menu</th>
                             <th colspan="<?= count($akses) ?>">Akses</th>
                             <th rowspan="2">Submenu</th>
                             <th rowspan="2"></th>
                         </tr>
                         <tr class="text-center">   
                            <?php foreach($akses as $db): ?>
                                    <th><?= $db->dept ?></th>
                            <?php endforeach; ?>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($submenu as $data) :
                                ?>
                         <tr>
                             <td class="text-center"><b><?php echo $no ?></b></td>
                             <td><?= $data->nama_menu ?></td>
                             <?php foreach($akses as $db): ?>
                                    <?php if($this->Menu_model->getRole($db->id_dept, $data->id_submenu) == 0) { ?>
                                        <td class="text-center"><input type="checkbox" class="check" data-idsub="<?= $data->id_submenu ?>" data-idmenu="<?= $data->id_menu ?>" data-iddept="<?= $db->id_dept ?>" value="0"></td>
                                    <?php }else{ ?>
                                        <td class="text-center"><input type="checkbox" class="check" data-idsub="<?= $data->id_submenu ?>" data-idmenu="<?= $data->id_menu ?>" data-iddept="<?= $db->id_dept ?>" value="1" checked></td>
                                    <?php } ?>
                             <?php endforeach; ?>
                             <td>
                                <?php if($data->sub == 1) { ?>
                                 <center>
                                     <a href="<?php echo base_url('menu/submenuStrip/'.$data->id_submenu) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Submenu"><i class="fas fa-angle-double-right"></i></a>
                                 </center>
                                <?php }else{ ?>
                                    <center>-</center>
                                <?php } ?>
                             </td>
                             <td class="text-center">
                                 <a href="#" data-toggle="modal" data-target="#edit" data-id="<?= $data->id_submenu ?>" data-menu="<?= $data->nama_menu ?>" data-icon="<?= $data->icon ?>" data-sub="<?= $data->sub ?>" data-cont="<?= $data->control_menu ?>" class="btn btn-sm btn-info"><i class="fas fa-pen fa-sm"></i></a>
                                 <a href="<?= base_url('menu/deletesub/'.$data->id_submenu.'?menu='.$menu['id_menu']) ?>" class="btn btn-sm btn-danger tombol-hapus"><i class="fas fa-trash fa-sm"></i></a>
                             </td>
                         </tr>
                         <?php
                            $no++;
                        endforeach;
                        ?>
                     </tbody>
                 </table>

                 <a href="<?= base_url('menu') ?>" class="btn btn-dark mt-4"><i class="fas fa-angle-left "></i> Back</a>
             </div>
         </div>

     </div>
 </div>
 <!-- /.container-fluid -->

 </div>
 <!-- End of Main Content -->

 <div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Input Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('menu/subtambah') ?>">
                    <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                     <div class="form-group">
                        <label for="menu">Menu</label>
                        <input type="text" name="submenu" class="form-control">
                     </div>

                     <div class="form-group">
                        <label for="menu">Icon</label>
                        <input type="text" name="icon" class="form-control" >
                     </div>

                     <div class="form-group">
                        <input type="checkbox" id="subcek" name="sub"> Memiliki submenu
                     </div>

                     <div class="form-group" id="ctrl">
                        <label for="menu">Controller Menu</label>
                        <input type="text" name="ctrl"  class="form-control" >
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

 <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                <form method="POST" action="<?php echo base_url('menu/subedit') ?>">
                    <input type="hidden" name="id_menu" value="<?= $menu['id_menu'] ?>">
                    <input type="hidden" name="id" id="id">
                     <div class="form-group">
                        <label for="menu">Menu</label>
                        <input type="text" id="menu" name="submenu" class="form-control">
                     </div>

                     <div class="form-group">
                        <label for="menu">Icon</label>
                        <input type="text" id="icon" name="icon" class="form-control" >
                     </div>

                     <div class="form-group">
                        <input type="checkbox" id="subcek2" name="sub"> Memiliki submenu
                     </div>

                     <div class="form-group" id="ctrl2">
                        <label for="menu">Controller Menu</label>
                        <input type="text" id="cont" name="ctrl"  class="form-control" >
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
     $(document).on('click', '.check', function(){
        const dept = $(this).attr('data-iddept');
        const sub = $(this).attr('data-idsub');
        const menu = $(this).attr('data-idmenu');
        const dat = $(this).val();

        if(dat == 0){
            $.ajax({
                url : '<?php echo base_url('menu/addRolesub') ?>',
                method : 'POST',
                dataType :'json',
                data : {dept : dept, sub : sub, menu : menu},
                success : function(hasil){
                    location.reload();
                }
             });
        }else{
             $.ajax({
                url : '<?php echo base_url('menu/deleteRolesub') ?>',
                method : 'POST',
                dataType :'json',
                data : {dept : dept, sub : sub, menu : menu},
                success : function(hasil){
                    location.reload();
                }
             });
        }
     })

     $('#subcek').click(function(){
        if($(this).prop('checked') == true){
            $('#ctrl').hide();      
        }else if($(this).prop('checked') == false) {
            $('#ctrl').show();      
        }
     });

     $('#subcek2').click(function(){
        if($(this).prop('checked') == true){
            $('#ctrl2').hide();      
        }else if($(this).prop('checked') == false) {
            $('#ctrl2').show();      
        }
     });

     $('#edit').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var modal = $(this)

        modal.find('#id').attr("value", div.data('id'));
        modal.find('#menu').attr("value", div.data('menu'));
        modal.find('#icon').attr("value", div.data('icon'));

        if(div.data('sub') == 1){
             modal.find('#subcek2').attr("checked", true);
             modal.find('#ctrl2').hide();
        }else{
            modal.find('#subcek2').attr("checked", false);
            modal.find('#ctrl2').show();
        }
        
        modal.find('#cont').attr("value", div.data('cont'));
    });
 </script>
