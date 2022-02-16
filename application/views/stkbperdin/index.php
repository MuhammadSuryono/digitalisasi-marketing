<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Matrix Perdin</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <a href="" data-toggle="modal" data-target="#exampleModal" class="btn btn-primary mb-2">Add</a>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kota Asal</th>
                            <th>Kota Tujuan</th>
                            <th>Jenis</th>
                            <th>Honor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                           $no = 1;
                           foreach ($stkbperdin as $data) :
                             $nomornya      = $data['no'];
                             $rpmatrixhonor = $data['matrixhonor'];
                               ?>
                        <tr>
                            <td><b><?php echo $no ?></b></td>
                            <td><?php echo $data['kotaasal'] ?></td>
                            <td><?php echo $data['kotatujuan'] ?></td>
                            <td><?php echo $data['jenis'] ?></td>
                            <td><?php echo 'Rp. ' . number_format( $rpmatrixhonor, 0 , '' , ',' ); ?></td>
                            <td>
                                <center>
                                    <a href="javascript:;" data-toggle="modal" data-target="#edit-matrixperdin" data-id="<?php echo $nomornya; ?>" data-ka="<?php echo $data['kotaasal'] ?>"
                                                                               data-kt="<?php echo $data['kotatujuan'] ?>" data-j="<?php echo $data['jenis'] ?>" data-mh="<?php echo $data['matrixhonor'] ?>" class="btn-success btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url(); ?>StkbPerdin/hapus/<?php echo $nomornya; ?> " class="btn-danger btn-sm tombol-hapus"><i class="fas fa-trash"></i> Delete</a>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Input Data Matrix Perdin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="<?php echo base_url('StkbPerdin/tambah') ?>">

                  <div class="form-group">
                    <label>Kota Asal</label>
                      <input type="text" id="ka" name="kotaasal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                  </div>

                  <div class="form-group">
                    <label>Kota Tujuan</label>
                      <input type="text" id="kt" name="kotatujuan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                  </div>

                  <div class="form-group">
                    <label>Jenis</label>
                      <select id="j" name="jenis" class="form-control form-control-user" aria-describedby="emailHelp">
                        <option value="Dinas">Dinas</option>
                        <option value="Setempat">Setempat</option>
                      <select>
                  </div>

                  <div class="form-group">
                    <label>Honor</label>
                      <input type="number" id="mh" name="matrixhonor" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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

<div class="modal fade" id="edit-matrixperdin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Matrix Perdin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('stkbperdin/ubah') ?>">
                    <input type="hidden" name="no" id="no">

                    <div class="form-group">
                      <label>Kota Asal</label>
                        <input type="text" id="ka" name="kotaasal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Kota Tujuan</label>
                        <input type="text" id="kt" name="kotatujuan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Jenis</label>
                        <input type="text" id="j" name="jenis" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Honor</label>
                        <input type="number" id="mh" name="matrixhonor" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
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
	$('#edit-matrixperdin').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#no').attr("value", div.data('id'));
		modal.find('#ka').attr("value", div.data('ka'));
    modal.find('#kt').attr("value", div.data('kt'));
		modal.find('#j').attr("value", div.data('j'));
    modal.find('#mh').attr("value", div.data('mh'));
	});
});
</script>
