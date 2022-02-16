<?php // TAMBAHAN BY ADAM SANTOSO
function templateFile($file)
{
  if ($file != null) {
    return substr($file, 0, 20) . '... <small><a onclick="view(\'' . $file . '\');" class="text-primary" data-toggle="modal" data-target="#viewModal" style="cursor:pointer;">View</a> - <a href="' . base_url('rfq/download/' . $file) . '" class="text-primary">Download</a></small>';
  }
}
?>
<!-- Begin Page Content -->

<div class="container-fluid">
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
  <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Tables Research Request</h1>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data Research Request</h6>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url('rfq/tambah') ?>" class="btn btn-primary mb-5">Add New Research Request</a>
      <div class="table-responsives">
        <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr class="text-center">
              <th>Nomor Request </th>
              <th>Tanggal Masuk</th>
              <th>Kode Request</th>
              <th>Subject Request</th>
              <th>Perusahaan</th>
              <th>Nama Customer</th>
              <th>Email Customer</th>
              <th>Contact Person</th>
              <th>Research Brief</th>
              <th>Request di minta</th>
              <th>Pekerjaan yang di minta</th>
              <th>Info Metodologi</th>
              <th>Term of Reference</th>
              <th>Last Status</th>
              <th>Pengiriman Proposal</th>
              <th>Presentasi Proposal</th>
              <th>Negosiasi Harga</th>
              <th>Request By</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            foreach ($rfq as $data) :
              //$status = [0=>'On Progress', 1=>'Deal', 2=>'No Deal', 3=>'Pending'];
            ?>
              <tr>

                <td class="align-middle"><b><?php echo $data['nomor_rfq'] ?></b></td>
                <td class="align-middle"><?php echo $data['tgl_masuk'] ?></td>
                <td class="align-middle"><?php echo $data['kode_project'] ?></td>
                <td class="align-middle"><?php echo $data['nama_project'] ?></td>
                <td class="align-middle"><?php echo $data['nama_perusahaan'] ?></td>
                <td class="align-middle"><?php $cekCustomer = @unserialize($data['id_customer']);
                                          if ($cekCustomer !== false) {
                                            $nama = array();
                                            $emailCus = array();
                                            $hpCus = array();
                                            foreach ($cekCustomer as $id_cus) {
                                              $customer = $this->Customer_model->getCustomerById($id_cus);
                                              $nama[] = $customer['nama'];
                                              $hp1 = $customer['hp1'] != null ? $customer['hp1'] : '';
                                              $hp2 = $customer['hp2'] != null ? ', ' . $customer['hp2'] : '';
                                              $hpCuss = $hp1 . $hp2;
                                              $hpCus[] = $hpCuss;
                                              array_filter($hpCus);
                                              $email1 = $customer['email1'] != null ? $customer['email1'] : '';
                                              $email2 = $customer['email2'] != null ? ', ' . $customer['email2'] : '';
                                              $emailCuss = $email1 . $email2;
                                              $emailCus[] = $emailCuss;
                                            }
                                            echo implode(', ', $nama);
                                          } else {
                                            $customer = $this->Customer_model->getCustomerById($data['id_customer']);
                                            $hp1 = $customer['hp1'] != null ? $customer['hp1'] : '';
                                            $hp2 = $customer['hp2'] != null ? ', ' . $customer['hp2'] : '';
                                            $hpCus = $hp1 . $hp2;
                                            $email1 = $customer['email1'] != null ? $customer['email1'] : '';
                                            $email2 = $customer['email2'] != null ? ', ' . $customer['email2'] : '';
                                            $emailCus = $email1 . $email2;
                                            echo $customer['nama'];
                                          }
                                          ?>
                </td>
                <td class="align-middle"><?php $emailCus = is_array($emailCus) ? implode(' / ', $emailCus) : $emailCus;
                                          echo $emailCus; ?></td>
                <td class="align-middle"><?php $hpCus = is_array($hpCus) ? implode(' / ', $hpCus) : $hpCus;
                                          echo $hpCus; ?></td>
                <td class="align-middle"><?= ($data['idResearchBrief']) ? "<small><a target='_blank' href='" . base_url('researchBrief/printPdf/') . $data['idResearchBrief'] . "?status=view&rfq=" . $data['nomor_rfq'] . "' class='text-primary'  style='cursor:pointer;'>View</a></small> - <small><a href='" . base_url('researchBrief/printPdf/') . $data['idResearchBrief'] . "?status=download&rfq=" . $data['nomor_rfq'] . "' class='text-primary'  style='cursor:pointer;'>Download</a></small>" : "Data tidak ada" ?></td>
                <td class="align-middle"><?php echo $data['jenis_permintaan'] ?></td>
                <td class="align-middle"><?php echo $data['jenis_pekerjaan'] ?></td>
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
                <td class="align-middle text-center"><?php $file = $data['file_project'] != null ? templateFile($data['file_project']) . '<br><b>Catatan TOR</b>: ' . $data['catatan_tor'] : '-';
                                                      echo $file; ?></td>
                <td class="align-middle text-center">
                  <?php if ($data['last_status'] == 1) { ?>
                    <span class="m-0 font-weight-bold text-success"><?php echo $data['status'] ?></span>
                  <?php } elseif ($data['last_status'] == 2) { ?>
                    <span class="m-0 font-weight-bold text-danger"><?php echo $data['status'] ?></span>
                  <?php } elseif ($data['last_status'] == 3) { ?>
                    <h6 class="m-0 font-weight-bold text-info"><?php echo $data['status'] ?></span>
                    <?php } else { ?>
                      <span class="m-0 font-weight-bold text-warning"><?php echo $data['status'] ?></span>
                    <?php } ?>
                </td>
                <td class="align-middle text-center"><?php echo $tgl = $data['tgl_kirim_proposal'] == 0 ? '-' : $data['tgl_kirim_proposal'] . ' - ' . templateFile($data['file_proposal']); ?></td>
                <td class="align-middle text-center"><?php echo $tgl = $data['tgl_presentasi'] == 0 ? '-' : $data['tgl_presentasi']; ?></td>
                <td class="align-middle text-center"><?php echo $tgl = $data['tgl_negosiasi'] == 0 ? '-' : $data['tgl_negosiasi']; ?> <?php $diskon = $data['diskon'];
                                                                                                                                      echo !!$diskon ? '<br>Diskon: ' . $diskon . '%' : '' ?></td>
                <td><?= $data['nama_request'] ?></td>
                <td class="align-middle text-center">
                  <div class="btn-group" role="group">
                    <button id="btnGroupDrop1" type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Actions
                    </button>
                    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                      <a class="dropdown-item" href="<?php echo base_url('rfq/status') ?>/<?php echo $data['nomor_rfq'] ?>"><i class="fas fa-pen fa-sm fa-fw mr-2 text-gray-700"></i> Status</a>
                      <a class="dropdown-item" href="<?php echo base_url('rfq/fu') ?>/<?php echo $data['nomor_rfq'] ?>"><i class="fas fa-file fa-sm fa-fw mr-2 text-gray-700"></i> Form FU</a>
                      <a class="dropdown-item" href="<?php echo base_url('costing/tambah') ?>/<?php echo $data['nomor_rfq'] ?>"><i class="fas fa-calendar fa-sm fa-fw mr-2 text-gray-700"></i> Costing</a>
                      <a class="dropdown-item tombol-hapus" href="<?php echo base_url('rfq/hapus') ?>/<?php echo $data['nomor_rfq'] ?>"><i class="fas fa-trash fa-sm fa-fw mr-2 text-gray-700"></i> Delete</a>
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