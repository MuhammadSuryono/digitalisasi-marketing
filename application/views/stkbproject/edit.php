<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit 1 - Project (<?php echo $kode['kode'] ?> - <?php echo $kode['nama'] ?>)</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

        <div class="card-body">

            <a href="" data-toggle="modal" data-target="#exampleModal" data-pro="<?php echo $kode['kode'] ?>" class="btn btn-primary mb-2">Add</a>

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Skenario</th>
                      <th>Jumlah</th>
                      <th>Edit</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php
                      $i = 1;
                      foreach ($id as $db){
                      ?>
                      <tr>
                        <td><?php echo $i++ ?></td>
                        <td><?php echo $db['nmr']; ?>. <?php echo $db['namanya'] ?></td>
                        <td><?php echo $db['jml'] ?></td>
                        <td>
                          <center>
                              <a href="javascript:;" data-toggle="modal" data-target="#edit-skenproject" data-pro="<?php echo $db['kopro'] ?>" data-sken="<?php echo $db['sken'] ?>"
                                                                         data-jum="<?php echo $db['jml'] ?>" class="btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                              <a href="<?php echo base_url(); ?>StkbPerdin/hapus/<?php echo $db['nmr'] ?> " class="btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
                          </center>
                        </td>
                      </tr>
                      <?php
                      }
                      ?>
                  </tbody>
                </table>
              </div>

              </br>
              <a href="<?php echo base_url('stkbproject') ?>" class=" btn btn-danger"> Back</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Add skenario </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?php echo base_url('StkbProject/tambah') ?>">

                  <input type="hidden" name="kodeproject" value="<?php echo $kode['kode'] ?>">

                  <div class="form-group">
                    <label>Skenario</label>
                      <select id="sken" name="skenario" class="form-control form-control-user" aria-describedby="emailHelp">
                        <?php
                         foreach ($sken as $skn) {
                        ?>
                          <option value="<?php echo $skn['no'] ?>"><?php echo $skn['no'] ?>. <?php echo $skn['nama'] ?></option>
                        <?php
                         }
                         ?>
                      <select>
                  </div>

                  <div class="form-group">
                    <label>Jumlah</label>
                      <input type="number" id="jumlah" name="jumlah" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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

<div class="modal fade" id="edit-skenproject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Skenario Project</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('stkbproject/ubah') ?>">

                    <input type="hidden" name="project" id="pro">

                    <div class="form-group">
                      <label>Skenario</label>
                        <input type="text" id="sken" name="skenario" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Jumlah</label>
                        <input type="number" id="jum" name="jumlah" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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
	$('#edit-skenproject').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)
		modal.find('#pro').attr("value", div.data('pro'));
		modal.find('#sken').attr("value", div.data('sken'));
    modal.find('#jum').attr("value", div.data('juml'));
	});
});
</script>
