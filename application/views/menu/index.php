 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
     <!-- Page Heading -->
    
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Menu Management</h1>
            <button type="button"  onclick="window.location.href='<?= base_url('menu/akses') ?>'" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Akses</button>
        </div>

     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary"></h6>
         </div>

         <div class="card-body">
             <div class="table-responsive">
                 <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-4">Add</a>
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     <thead>
                         <tr class="text-center">
                             <th>No</th>
                             <th>Menu</th>
                             <th></th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php 
                            $no = 1;
                            foreach ($menu as $data) :
                                $id_menu = $data['id_menu'];
                                $menu = $data['menu'];
                            ?>
                         <tr>
                             <td class="text-center"><b><?php echo $no ?></b></td>
                             <td><?php echo $data['menu'] ?></td>
                             <td>
                                 <center>
                                     <a href="<?php echo base_url(); ?>menu/hapus/<?php echo $data['id_menu']; ?> " class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i></a>
                                     <a href="javascript:;" data-toggle="modal" data-target="#edit-menu" data-id="<?php echo $id_menu; ?>" data-menu="<?php echo $menu; ?>" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-pen" ></i></a>
                                     <a href="<?php echo base_url('menu/submenu/'.$data['id_menu']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Menu"><i class="fas fa-angle-double-right"></i></a>
                                 </center>
                             </td>
                         </tr>
                         <?php
                            $no++;
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
 <!-- End of Main Content -->

 <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('menu/tambah') ?>">
                     <div class="form-group">
                         <input type="text" name="menu" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Menu">
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

 <div class="modal fade" id="edit-menu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h5 class="modal-title" id="exampleModalLabel">Form Edit Menu</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 <form method="POST" action="<?php echo base_url('menu/ubah') ?>">
                     <input type="hidden" name="id" id="id">
                     <div class="form-group">
                         <input type="text" id="menu" name="menu" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="Input Menu">
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

<script>
$(document).ready(function () {
    $('#edit-menu').on('show.bs.modal', function (event) {
        var div = $(event.relatedTarget);
        var modal = $(this)

        modal.find('#id').attr("value", div.data('id'));
        modal.find('#menu').attr("value", div.data('menu'));
    });
});
</script>
