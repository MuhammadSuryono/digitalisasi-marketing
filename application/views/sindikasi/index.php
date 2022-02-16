<!-- Begin Page Content -->

<div class="container-fluid">
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
  <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tables Syndicate</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Syndicate</h6>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url('sindikasi/tambah') ?>" class="btn btn-primary mb-5">Add New Syndicate</a>
      <div class="table-responsives">
        <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>No.</th>
              <th>Nama Project</th>
              <th>Target Sales</th>
              <th>Methodology</th>
              <th>PIC</th>
              <th>Tanggal Dibuat</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($sindikasi as $data) :
              //$status = [0=>'On Progress', 1=>'Deal', 2=>'No Deal', 3=>'Pending'];
            ?>
              <tr>
                <td class="align-middle"><?= $no ?></td>
                <td class="align-middle"><b><?php echo $data['nama_project'] ?></b></td>
                <td class="align-middle">Rp.<?php echo number_format($data['target_sales']) ?></td>
                <td class="align-middle"><?php $cekMetode = @unserialize($data['id_methodology']);
                                          if ($cekMetode !== false) {
                                            $metodes = array();
                                            foreach ($cekMetode as $id_metode) {
                                              $metode = $this->Methodology_model->getMethodologyById($id_metode);
                                              $metodes[] = $metode['keterangan'];
                                            }
                                            echo implode(', ', $metodes);
                                          } else {
                                            $metode = $this->Methodology_model->getMethodologyById($data['id_methodology']);
                                            if ($metode != null) {
                                              echo $metode['keterangan'];
                                            } else {
                                              echo '-';
                                            }
                                          }
                                          ?></td>
                <td class="align-middle">
                  <?php $customer = $this->User_model->getUserById($data['id_pic']) ?>
                  <?= $customer['nama_user'] ?>
                </td>
                <td class="align-middle"><?php echo $data['created_at'] ?></td>
                <td class="align-middle text-center">
                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="<?php echo base_url('sindikasi/status') ?>/<?= $data['id'] ?>"><i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-700"></i> Status</a>
                      <!-- <a class="dropdown-item" href="<?php echo base_url('sindikasi/fu') ?>/<?= $data['id'] ?>"><i class="fas fa-file fa-sm fa-fw mr-2 text-gray-700"></i> Form FU</a> -->
                      <!-- <a class="dropdown-item" href="<?php echo base_url('costing/tambah') ?>/"><i class="fas fa-calendar fa-sm fa-fw mr-2 text-gray-700"></i> Costing</a> -->
                      <a class="dropdown-item tombol-hapus" href="<?php echo base_url('sindikasi/hapus') ?>/<?= $data['id'] ?>"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-700"></i> Delete</a>
                    </div>
                  </div>
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

<!-- Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewDocumentLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDocumentLabel">View Document</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="viewDocument"></div>
      </div>
    </div>
  </div>
</div>

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
        <form>
          <div class="form-group">
            <input type="text" name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="User">
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
  // TAMBAHAN BY ADAM SANTOSO
  function view(e) {
    var url = '<?php echo base_url('file/rfq/') ?>';
    var options = {
      height: "500px"
    };
    PDFObject.embed(url + e, "#viewDocument", options);
  }
  $(document).ready(function() {
    $('#dataTable').DataTable({
      "order": [
        [0, "desc"]
      ]
    });
  });
</script>