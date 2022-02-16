<a id="top"></a>
<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
  <div class="flash-data2" data-flashdata="<?php echo $this->session->flashdata('flash2'); ?>"></div>
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Sindikasi - <?php echo $sindikasi['nama_project'] ?></h1>
  <!-- DataTales Example -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data table > Form Sindikasi </h6>
        </div>

        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="sindikasi" name="updated">
            <input type="hidden" value="<?= $sindikasi['id']  ?>" name="id">
            <div class="row">
              <div class="col-xl-6 col-md-6 mb-4">

                <div class="form-group">
                  <label for="nama_project">Nama Project</label>
                  <input type="text" value="<?php echo $sindikasi['nama_project'] ?>" name="nama_project" id="nama_project" class="form-control form-control-user <?php if (form_error('nama_project')) {
                                                                                                                                                                    echo 'is-invalid';
                                                                                                                                                                  } ?>">
                  <?php echo form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <div class="metode">
                  <div class="form-group">
                    <?php $cekMetode = @unserialize($sindikasi['id_methodology']);
                    $data = $this->Methodology_model->getAllMethodology();
                    if ($cekMetode !== false) {
                      $id_metod = unserialize($sindikasi['id_methodology']);
                      $metodLn = count($id_metod);
                    } else {
                      $datas = $this->Methodology_model->getMethodologyByIdArray($sindikasi['id_methodology']);
                      $id_metod = $datas[0]['id_methodology'];
                      $metodLn = count($datas);
                    }

                    for ($i = 0; $i < $metodLn; $i++) {
                      echo '
                        <div class="form-group" id="selectMethod">
                          <div class="row">
                            <div class="col"><label for="user">Methodology</label></div>';
                      if ($i == 0) {
                        echo '<div class="col text-right"><a class="addmetode btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>';
                      } else {
                        echo '<div class="col text-right"><a class="delmetode btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>';
                      }
                      echo '
                          </div>
                          <select required name="id_methodology[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih methodology...">';
                      foreach ($data as $db) {
                        if ($id_metod[$i] == $db['id_methodology']) {
                          echo '<option value="' . $db['id_methodology'] . '" selected>' . $db['methodology'] . ' - ' . $db['keterangan'] . '</option>';
                        } else {
                          echo '<option value="' . $db['id_methodology'] . '">' . $db['methodology'] . ' - ' . $db['keterangan'] . '</option>';
                        }
                      }
                      echo '</select></div>';
                    }
                    ?>
                  </div>
                </div>
              </div>
              <div class="col-xl-6 col-md-6 mb-4">
                <div class="form-group">
                  <label for="target_sales">Target Sales</label>
                  <input type="text" value="<?php echo number_format($sindikasi['target_sales'])  ?>" name="target_sales" id="target_sales" class="form-control form-control-user <?php if (form_error('target_sales')) {
                                                                                                                                                                                    echo 'is-invalid';
                                                                                                                                                                                  } ?>">
                  <?php echo form_error('target_sales', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <?php $data_user = $this->User_model->getAllUser(); ?>
                  <label for="pic">PIC</label>
                  <select name="id_pic" id="pic" class="selectpicker show-tick form-control selectAnswerPeserta<?php if (form_error('pic')) {
                                                                                                                  echo 'is-invalid';
                                                                                                                } ?>" data-live-search="true" title="Pilih PIC..." required>
                    <?php
                    foreach ($data_user as $ud) :
                    ?>
                      <?php if ($sindikasi['id_pic'] == $ud['id_user']) { ?>
                        <option value="<?php echo $ud['id_user'] ?>" selected><?php echo $ud['nama_user'] ?> - <?= $ud['dept']; ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $ud['id_user'] ?>"><?php echo $ud['nama_user'] ?> - <?= $ud['dept'] ?></option>
                      <?php } ?>
                    <?php endforeach; ?>
                  </select>
                  <?= form_error('id_pic', '<small class="text-danger ml-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                  <label for="user" class="labelprop">Proposal Utama</label>
                  <div class="custom-file">
                    <input type="file" name="proposal" id="proposal" accept="application/pdf" class="custom-file-input fileprop <?php if (form_error('proposal[]')) {
                                                                                                                                  echo 'is-invalid';
                                                                                                                                } ?>" value="<?php echo set_value('proposal[]'); ?>">
                    <label class="custom-file-label label-proposal"><?= ($sindikasi['proposal']) ? $sindikasi['proposal'] : 'Choose File'; ?></label>
                  </div>
                  <?php if ($sindikasi['proposal']) : ?>
                    <button class="text-primary btn btn-primary btn-sm"><a href="<?= base_url('file/proposal/') . $sindikasi['proposal'] ?>" class="text-white" target="_blank">View</a></button>
                  <?php endif; ?>
                  <?php echo form_error('proposal', '<small class="text-danger pl-3">', '</small>'); ?>
                  <input type="hidden" name="oldfiledata" value="">
                </div>
              </div>
            </div>
            <button type="button" onclick="history.back(-1)" class=" btn btn-danger float-right ml-1"><i class="fas fa-arrow-circle-left"></i> Back</button>
            <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Save</button>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data Client </h6>
        </div>
        <div class="card-body">
          <form action="" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="target-client" name="updated">
            <input type="hidden" value="<?php echo $sindikasi['id'] ?>" name="id">
            <!-- <div id="addDataClient" class="col text-right"><a class="addcustomer btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah Client</a></div> -->
            <div id="section-data-client">
              <input type="hidden" value="" name="id_target_client" id="id_target_client">
              <div class="form-group">
                <label for="user">Client</label>
                <select name="id_client" id="client-1" class="selectpicker client show-tick form-control <?php if (form_error('id_client')) {
                                                                                                            echo 'is-invalid';
                                                                                                          } ?>" data-live-search="true" title="Pilih perusahaan...">
                  <?php
                  $data = $this->Perusahaan_model->getAllPerusahaan();
                  foreach ($data as $db) : ?>
                    <?php if (set_value('id_client') == $db['id_perusahaan']) { ?>
                      <option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $db['id_perusahaan'] ?>"><?php echo $db['nama'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_client', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col"><label for="user">Contact Person 1</label></div>
                  <div id="cusState" class="col text-right" style="display:none;"><a class="addcustomer btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                </div>
                <select name="id_cp[]" id="cus-1" class="form-control cus <?php if (form_error('id_cp')) {
                                                                            echo 'is-invalid';
                                                                          } ?>" title="Pilih Contact Person..." required>
                  <option value="" style="display:none;">Pilih perusahaan terlebih dahulu</option>
                </select>
                <?php echo form_error('id_cp[]', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <!-- <div class="form-group contact-person-2" style="display: none;">
                <div class="row">
                  <div class="col"><label for="user">Contact Person Pengganti</label></div>
                </div>
                <select name="id_cp_2[]" id="cus-2" class="form-control cus <?php if (form_error('id_cp')) {
                                                                              echo 'is-invalid';
                                                                            } ?>" title="Pilih Contact Person...">
                  <option value="" style="display:none;">Pilih perusahaan terlebih dahulu</option>
                </select>
                <?php echo form_error('id_cp', '<small class="text-danger pl-3">', '</small>'); ?>
              </div> -->
              <div class="cp"></div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user" class="labelprop">Surat Penawaran</label>
                    <div class="custom-file">
                      <input type="file" name="suratPenawaran" id="suratPenawaran" accept="application/pdf" class="custom-file-input fileprop <?php if (form_error('suratPenawaran[]')) {
                                                                                                                                                echo 'is-invalid';
                                                                                                                                              } ?>" value="<?php echo set_value('suratPenawaran[]'); ?>">
                      <label class="custom-file-label label-proposal">File</label>
                    </div>
                    <?php echo form_error('suratPenawaran', '<small class="text-danger pl-3">', '</small>'); ?>
                    <input type="hidden" name="oldfiledata" value="">
                  </div>
                  <div class="row">
                    <!-- <div class="col-lg-8"> -->
                    <button style="background-color: #355c81; color: white;" type="button" id="btn-baru" class="btn btn-sm ml-3">Baru</button>
                    <!-- </div> -->
                    <!-- <div class="col-lg-4"> -->
                    <div class="btn-group">
                      <button style="background-color: #008CBA; color: white;" type="button" class="btn btn-sm ml-2 dropdown-toggle" id="btn-revisi" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Revisi
                      </button>
                      <div class="dropdown-menu drawdown-revisi">
                      </div>
                    </div>
                    <!-- <button style="background-color: #008CBA; color: white;" type="button" class="btn btn-sm ml-2">Revisi</button> -->
                    <!-- </div> -->
                  </div>
                  <input type="hidden" name="status-file" id="status-file" value="1">
                  <input type="hidden" name="revisi-file" id="revisi-file" value="">
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user">Status</label>
                    <input type="hidden" id="helperStatus" value="" />
                    <select name="status" id="status-1" onchange="" class="form-control" title="Pilih status...">
                      <?php
                      $data = $this->Rfq_model->getAllOpsiStatus();
                      foreach ($data as $db) {
                        if ($db['id_status'] == 0) {
                          echo '<option value="' . $db['id_status'] . '" selected style="display:none;">' . $db['status'] . '</option>';
                        } else if ($rfq['last_status'] == $db['id_status']) {
                          echo '<option value="' . $db['id_status'] . '" selected>' . $db['status'] . '</option>';
                        } else {
                          echo '<option value="' . $db['id_status'] . '">' . $db['status'] . '</option>';
                        }
                      }
                      ?>
                    </select>
                    <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="row row-deadline-submission" style="display: none;">
                <div class="col-lg-12">
                  <div class="form-group">
                    <label for="user">Tanggal Pengumpulan Laporan Akhir</label>
                    <input type="date" name="tgl_deadline" id="tgl_deadline" class="form-control form-control-user <?php if (form_error('tgl_deadline')) {
                                                                                                                      echo 'is-invalid';
                                                                                                                    } ?>" placeholder="Pilih tanggal" value="">
                    <?php echo form_error('tgl_deadline', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user">Tanggal Update</label>
                    <input type="date" name="tgl_update" id="tgl_update" class="form-control form-control-user <?php if (form_error('tgl_update')) {
                                                                                                                  echo 'is-invalid';
                                                                                                                } ?>" placeholder="Pilih tanggal" value="">
                    <?php echo form_error('tgl_update', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <div class="col-lg-6">
                  <div class="form-group">
                    <label for="user">Tanggal Deal</label>
                    <input type="date" name="tgl_deal" id="tgl_deal" onchange="setDeadline()" class="form-control form-control-user <?php if (form_error('tgl_deal')) {
                                                                                                                                      echo 'is-invalid';
                                                                                                                                    } ?>" placeholder="Pilih tanggal" value="">
                    <?php echo form_error('tgl_deal', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="user">Hrg Sblm Disc</label>
                    <input type="text" name="harga_penawaran" id="harga_penawaran" class="form-control form-control-user <?php if (form_error('harga_penawaran')) {
                                                                                                                            echo 'is-invalid';
                                                                                                                          } ?>" placeholder="" value="">
                    <?php echo form_error('harga_penawaran', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <div class="col-lg-3">
                  <div class="form-group">
                    <label for="user">Diskon(%)</label>
                    <input type="text" name="diskon" id="diskon" class="form-control form-control-user <?php if (form_error('diskon')) {
                                                                                                          echo 'is-invalid';
                                                                                                        } ?>" placeholder="" value="">
                    <?php echo form_error('diskon', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
                <div class="col-lg-5">
                  <div class="form-group">
                    <label for="user">Total</label>
                    <input type="text" name="total" id="total" class="form-control form-control-user <?php if (form_error('total')) {
                                                                                                        echo 'is-invalid';
                                                                                                      } ?>" placeholder="" value="" readonly>
                    <?php echo form_error('total', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-lg-12">
                  <label for="user">Catatan</label>
                  <textarea class="form-control form-control-user" name="catatan" id="catatan" cols="30" rows="3"></textarea>
                  <?php echo form_error('total', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <hr class="sidebar-divider">
            </div>
            <button type="button" onclick="history.back(-1)" class="btn btn-danger float-right ml-1"><i class="fas fa-arrow-circle-left"></i> Back</button>
            <button class="btn btn-primary float-right" type="submit"><i class="fas fa-save"></i> Save</button>
            <!-- <button class="btn btn-info" id="btnEmail" type="button" name="kirim_email"><i class="fas fa-envelope-open-text"></i> Kirim Email</button>
          <a href="<?php echo base_url('rfq/cetak/' . $sindikasi['id']) ?>" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak PDF</a> -->

            <br>
            <small class="" id="pesan"></small>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Form Rekap Client </h6>
        </div>
        <div class="card-body">
          <div class="row">
            <div class=" col-md-1 border-right  border-primary">
              <h3 class="text-success text-center">Deal</h3>
            </div>
            <div class="col-md-2 text-center border-right border-primary">
              <h3 class="text-dark">Total Harga Deal</h3>
            </div>
            <div class="col-md-2 border-right border-primary">
              <h3 class="text-warning text-center">On Progress</h3>
            </div>
            <div class="col-md-3 text-center border-right border-primary">
              <h3 class="text-dark">Total Harga On Progress</h3>
            </div>
            <div class="col-md-2 text-center border-right border-primary">
              <h3 class="text-dark">Target Sales</h3>
            </div>
            <div class="col-md-2 text-center">
              <h3 class="text-dark">Kekurangan</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-1 border-right border-primary border-top text-center">
              <p class="text-dark pt-2 h5"><?= ($status_deal) ? $status_deal : '0' ?></p>
            </div>
            <div class="col-md-2 text-center border-right border-primary border-top">
              <p class="text-dark pt-2 h5">Rp. <?= ($total_harga_deal) ? number_format($total_harga_deal) : '0' ?></p>
            </div>
            <div class="col-md-2 h5 border-right border-primary border-top">
              <p class="text-warning pt-2 h5 text-center"><?= ($status_pending) ? $status_pending : '0' ?></p>
            </div>
            <div class="col-md-3 text-center border-right border-primary border-top">
              <p class="text-dark pt-2 h5">Rp. <?= ($total_harga_pending) ? number_format($total_harga_pending) : '0' ?></p>
            </div>
            <div class="col-md-2 h5 text-center border-right border-primary border-top">
              <p class="text-dark pt-2 h5">Rp. <?= ($sindikasi['target_sales']) ? number_format($sindikasi['target_sales']) : '0' ?></p>
            </div>
            <div class="col-md-2 h5 text-center border-top border-primary">
              <p class="text-dark pt-2 h5">Rp. <?= number_format($sindikasi['target_sales'] -  $total_harga_deal) ?></p>
            </div>
          </div>
          <div class="table-responsives mt-3">
            <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr class="text-center">
                  <th>No.</th>
                  <th>Client</th>
                  <th>Contact Person</th>
                  <th>Status</th>
                  <th>Tanggal Update</th>
                  <th>Tanggal Deal</th>
                  <th>Tanggal Deadline Submission</th>
                  <th>Harga Penawaran</th>
                  <th>Discount</th>
                  <th>Harga Setelah Disc</th>
                  <th>Proposal</th>
                  <th>Catatan</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $count = 1;
                foreach ($target_client as $tc) :
                ?>
                  <tr>
                    <td class="align-middle"><?= $count++ ?></td>
                    <td class="align-middle"><?= $tc['nama_perusahaan'] ?></td>
                    <td class="align-middle">
                      <?php
                      $contactPerson = unserialize($tc['id_contact_person']);
                      for ($i = 0; $i < count($contactPerson); $i++) {
                        $customer = $this->Customer_model->getCustomerById($contactPerson[$i]);
                        echo $customer['nama'];
                        if ($i < count($contactPerson) - 1) echo ', ';
                      }
                      ?>
                    </td>
                    <td class="align-middle"><?= $tc['status'] ?> </td>
                    <td class="align-middle"><?= $tc['tgl_update'] ?> </td>
                    <td class="align-middle"><?= $tc['tgl_deal'] ?></td>
                    <td class="align-middle"><?= ($tc['tgl_deadline'] && $tc['tgl_deadline'] != '0000-00-00') ? $tc['tgl_deadline'] : 'Data Tidak Ada' ?></td>
                    <td class="align-middle"><?= "Rp. " . number_format($tc['harga_penawaran'], 0, '', ',') ?></td>
                    <td class="align-middle"><?= $tc['diskon'] ?>%</td>
                    <td class="align-middle"><?= "Rp. " . number_format($tc['total'], 0, '', ',') ?></td>
                    <td class="align-middle text-center">
                      <?php if (@unserialize($tc['proposal'])) : ?>
                        <?php $arrProposal = unserialize($tc['proposal']); ?>
                        <?php $outputFile = []; ?>
                        <?php for ($i = 0; $i < count($arrProposal); $i++) : ?>
                          <?php
                          if (strpos($arrProposal[$i], ' ') !== false) {
                            $firstString = explode(" ", $arrProposal[$i])[0];
                          } else if (strpos($arrProposal[$i], '.') !== false)
                            $firstString = explode(".", $arrProposal[$i])[0]; {
                          }
                          // $m_array = preg_grep("/^$firstString\s.*/", $arrProposal);
                          $input = preg_quote($firstString, '~'); // don't forget to quote input string!

                          // var_dump($firstString);
                          $m_array = preg_grep('~' . $input . '~', $arrProposal);
                          $fixFile = $m_array[max(array_keys($m_array))];
                          if (!in_array($fixFile, $outputFile)) :
                            array_push($outputFile, $fixFile);
                          ?>
                            <a href="<?= base_url('file/proposal/') . $fixFile ?>" target="_blank" title="<?= $fixFile ?>"><i class="fas fa-eye"></i></a>
                          <?php
                          endif;
                          ?>
                        <?php endfor; ?>
                      <?php else : ?>
                        Data tidak ada
                      <?php endif; ?>
                    </td>
                    <td><?= ($tc['catatan']) ? $tc['catatan'] : '-' ?></td>
                    <td class="align-middle">
                      <button class="btn btn-primary btn-sm editClient" data-id="<?= $tc['id_target_client'] ?>" data-toggle="tooltip" data-placement="top" title="Edit"> <i class="fas fa-pen"></i> </button>
                      <a class="btn btn-primary btn-sm" href="<?php echo base_url('sindikasi/fu') ?>/<?= $tc['nomor_rfq'] ?>" data-id=" <?= $tc['nomor_rfq'] ?>" data-toggle="tooltip" data-placement="top" title="Follow Up" target="_blank"> <i class="fas fa-file"></i> </a>
                      <!-- <button class="btn btn-primary btn-sm" href="<?php echo base_url('sindikasi/fu') ?>/<?= $tc['nomor_rfq'] ?>"><i class="text-white fas fa-file fa-sm fa-fw mr-2 text-gray-700" data-toggle="tooltip" data-placement="top" title="Follow Up"></i></button> -->
                      <button id="delete_id" data-id="<?= $tc['id_sindikasi'] ?>" data-id_client="<?= $tc['id_target_client'] ?>" class="btn btn-danger btn-sm delete_class" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash"></i> </button>
                      <?php if ($tc['id_status'] == 1) : ?>
                        <a href="<?= base_url('commisionVoucher?rfq=') . $tc['nomor_rfq'] ?>" class="btn btn-primary btn-sm editClient" data-id="<?= $tc['id_target_client'] ?>" data-toggle="tooltip" data-placement="top" title="Create Commision Voucher"> <i class="fas fa-plus"></i> </a>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->

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

<div id="delete-confirm" class="modal" data-backdrop="static" data-keyboard="false">
  <div class="vertical-alignment-helper">
    <div class="modal-dialog vertical-align-center">
      <div class="modal-content">
        <div class="modal-header">

          <h4 class="modal-title  text-center"> Attention</h4>
        </div>
        <div class="modal-body">
          <p class="text-center">Are you sure you want to delete this client?</p>
          <form action="<?= base_url('sindikasi/hapustargetclient') ?>" method="post">
            <input type="hidden" name="id_sindikasi" id="id_sindikasi_modal" value="">
            <input type="hidden" name="id_target_client" id="id_target_client_modal" value="">

            <div class="text-center">
              <button type="submit" class=" btn btn-primary "> Okay</button>
              <button type="button" class=" btn btn-primary " data-dismiss="modal"> Cancel</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(function() {
    $('[data-toggle="tooltip"]').tooltip()
  })
  $(document).ready(function() {
    if ($('#status-1').val() == 1) {
      $('.row-deadline-submission').show();
    } else {
      $('.row-deadline-submission').hide();
    }

    $(document).on('change', '#status-1', function() {
      if ($(this).val() == 1) {
        $('.row-deadline-submission').show();
      } else {
        $('.row-deadline-submission').hide();
      }
    });

    $(document).on('click', '#btn-baru', function() {
      $(this).css("background-color", "#355c81");
      $('#btn-revisi').css("background-color", "#008CBA");
      $('#status-file').val('1');
      $('#revisi-file').val('');
    });
    $(document).on('click', '.revisi-item', function() {
      $('#btn-revisi').css("background-color", "#355c81");
      $('#btn-baru').css("background-color", "#008CBA");
      $('#status-file').val('2');
      $('#revisi-file').val($(this).text());
    });

    $(document).on('click', '.delete_class', function() {
      $('#id_sindikasi_modal').val($(this).data('id'));
      $('#id_target_client_modal').val($(this).data('id_client'));
      $('#delete-confirm').modal('show');
    });
    // $(".customer").on("click", ".delcustomer", function(event) {
    //   console.log('here');
    //   $(this).closest("#selectCustomer").remove();
    // });
    // $(".customerdef").on("click", ".delcustomer", function(event) {
    //   $(this).closest("#selectCustomer").remove();
    // });

    $('#client-1').change(function() {
      const id = $(this).val();
      $('#customerChange').show();
      $.ajax({
        url: '<?php echo base_url('sindikasi/getContactPerson') ?>',
        method: 'GET',
        dataType: 'json',
        data: {
          id: id
        },
        success: function(hasil) {
          console.log(hasil);
          // $('.cusState').show();
          var html = '';
          for (var i = 0; i < hasil.length; i++) {
            html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
          }

          $('#cusState').show();

          $('.cus').html(html);
        }
      });
    });

    $(".addcustomer").on("click", function() {
      const id = $('#client-1').val();
      console.log(id);
      $.ajax({
        url: '<?php echo base_url('sindikasi/getContactPerson'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        data: {
          id: id
        },
        success: function(hasil) {
          let countCp = $('select[name="id_cp[]"]').length;
          var method = `
          <div class="form-group" id="selectCustomer">
            <div class="row">
              <div class="col"><label for="customer">Contact Person ${countCp + 1}</label></div>
              <div class="col text-right"><a class="delcustomer btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select name="id_cp[]" id="cus" class="form-control" data-live-search="true" title="Pilih customer...">`
          for (let j = 0; j < hasil.length; j++) {
            method += `<option value="` + hasil[j].id_customer + `">` + hasil[j].status + ` ` + hasil[j].nama + `</option>`
          }
          method += `
          </select>
          </div>`

          $('.cp').append(method);
          // if ($(".customerdef").length == 0) {
          //   $(".customer").append(method);
          // } else {
          //   $(".customerdef").append(method);
          // }
        }
      })
    });

    $(".cp").on("click", ".delcustomer", function(event) {
      $(this).closest("#selectCustomer").remove();
    });

    $('#addDataClient').click(function() {
      let countClient = $('.client').length;
      const html = `
            <div class="form-group">
              <label for="user">Client</label>
              <select name="id_client[]" id="client${countClient}" class="selectpicker client show-tick form-control <?php if (form_error('id_client')) {
                                                                                                                        echo 'is-invalid';
                                                                                                                      } ?>" data-live-search="true" title="Pilih perusahaan...">
                <?php
                $data = $this->Perusahaan_model->getAllPerusahaan();
                foreach ($data as $db) : ?>
                  <?php if (set_value('id_client') == $db['id_perusahaan']) { ?>
                    <option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $db['id_perusahaan'] ?>"><?php echo $db['nama'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <?php echo form_error('id_client', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
  
            <div class="form-group">
              <div class="row">
                <div class="col"><label for="user">Contact Person</label></div>
              </div>
              <select name="id_cp[]" id="cus-${countClient}" class="form-control cus <?php if (form_error('id_cp')) {
                                                                                        echo 'is-invalid';
                                                                                      } ?>" title="Pilih Contact Person..." required>
                <option value="" style="display:none;">Pilih perusahaan terlebih dahulu</option>
              </select>
              <?php echo form_error('id_cp', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="cp"></div>

            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="user">Proposal</label>
                  <div class="custom-file">
                    <input type="file" name="suratPenawaran[]" accept="application/pdf" class="custom-file-input proposal inputProject <?php if (form_error('proposal')) {
                                                                                                                                          echo 'is-invalid';
                                                                                                                                        } ?>" value="<?php echo set_value('filedata'); ?>">
                    <label class="custom-file-label label-proposal">File</label>
                  </div>
                  <?php echo form_error('filedata', '<small class="text-danger pl-3">', '</small>'); ?>
                  <input type="hidden" name="oldfiledata" value="">
                </div>                                
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="user">Status</label>
                  <input type="hidden" id="helperStatus" value="" />
                  <select name="status[]" id="status" onchange="" class="form-control" title="Pilih status...">
                    <?php
                    $data = $this->Rfq_model->getAllOpsiStatus();
                    foreach ($data as $db) {
                      if ($db['id_status'] == 0) {
                        echo '<option value="' . $db['id_status'] . '" selected style="display:none;">' . $db['status'] . '</option>';
                      } else if ($rfq['last_status'] == $db['id_status']) {
                        echo '<option value="' . $db['id_status'] . '" selected>' . $db['status'] . '</option>';
                      } else {
                        echo '<option value="' . $db['id_status'] . '">' . $db['status'] . '</option>';
                      }
                    }
                    ?>
                  </select>
                  <?php echo form_error('status', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>                             
              </div>
            </div>
                    
            <div class="row">
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="user">Tanggal Update</label>
                  <input type="date" name="tgl_update[]" class="form-control form-control-user <?php if (form_error('tgl_update')) {
                                                                                                  echo 'is-invalid';
                                                                                                } ?>" placeholder="Pilih tanggal" value="">
                  <?php echo form_error('tgl_update', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-group">
                  <label for="user">Tanggal Deal</label>
                  <input type="date" name="tgl_deal[]" onchange="setDeadline()" class="form-control form-control-user <?php if (form_error('tgl_deal')) {
                                                                                                                        echo 'is-invalid';
                                                                                                                      } ?>" placeholder="Pilih tanggal" value="">
                  <?php echo form_error('tgl_deal', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div>
            </div>
            <hr class="sidebar-divider">
      `;

      $('#section-data-client').append(html);
      $('.selectpicker').selectpicker('refresh');

      $('#client' + countClient).change(function() {
        const id = $(this).val();
        if ($(".customerdef").length == 0) {
          $(".customer").empty();
        } else {
          $('.customerdef').remove();
        }
        $('#customerChange').show();
        $.ajax({
          url: '<?php echo base_url('sindikasi/getContactPerson') ?>',
          method: 'GET',
          dataType: 'json',
          data: {
            id: id
          },
          success: function(hasil) {
            console.log(hasil);
            // $('.cusState').show();
            var html = '';
            for (var i = 0; i < hasil.length; i++) {
              html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
            }

            $('#cus-' + countClient).html(html);
          }
        });
      });

      // $('#proposal').on('change', function(e) {
      //   var label = e.target.files[0].name;
      //   $(this).next('.label-proposal').html(label);
      // });

      // $('#suratPenawaran').on('change', function(e) {
      //   var label = e.target.files[0].name;
      //   $('.label-suratPenawaran').html(label);
      // });
    });

    $(".addmetode").on("click", function() {
      $.ajax({
        url: '<?php echo base_url('rfq/carimethod'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        success: function(hasil) {
          var method = `
          <div class="form-group" id="selectMethod">
            <div class="row">
              <div class="col"><label for="user">Methodology</label></div>
              <div class="col text-right"><a class="delmetode btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select required name="id_methodology[]" class="form-control" data-live-search="true" title="Pilih methodology...">`
          for (let j = 0; j < hasil.length; j++) {
            method += `<option value="` + hasil[j].id_methodology + `">` + hasil[j].methodology + ` - ` + hasil[j].keterangan + `</option>`
          }
          method += `
          </select>
          </div>`

          $(".metode").append(method);
        }
      })
    });

    $(".metode").on("click", ".delmetode", function(event) {
      $(this).closest("#selectMethod").remove();
    });

    $('#target_sales').keyup(function() {
      const value = $(this).val().replace(/,/ig, '')
      $(this).val(numberWithCommas(value));
    })

    $('#harga_penawaran').keyup(function() {
      const value = $(this).val().replace(/,/ig, '')
      $(this).val(numberWithCommas(value));

      const diskon = $('#diskon').val();

      countTotalValue(value, diskon);
    })

    $('#diskon').keyup(function() {

      const value = $('#harga_penawaran').val().replace(/,/ig, '');

      const diskon = $(this).val();

      countTotalValue(value, diskon);
    })

    $('.fileprop').on('change', function(e) {
      console.log('here');
      var label = e.target.files[0].name;
      $(this).next('.label-proposal').html(label);
    });


    $(document).on('click', '.editClient', function() {
      const id = $(this).data('id');
      $('#id_target_client').val(id);

      $.ajax({
        url: '<?php echo base_url('sindikasi/gettargetclient'); ?>',
        method: "GET",
        data: {
          id: id
        },
        dataType: 'json',
        success: function(hasil) {
          $('#client-1').val(hasil.id_client);
          console.log(hasil.catatan);

          const id = hasil.id_client;
          if ($(".customerdef").length == 0) {
            $(".customer").empty();
          } else {
            $('.customerdef').remove();
          }
          $('#customerChange').show();

          // const arrCp = json_encode(unserialize(hasil.id_contact_person))
          $.ajax({
            url: '<?php echo base_url('sindikasi/getContactPerson') ?>',
            method: 'GET',
            dataType: 'json',
            data: {
              id: id
            },
            success: function(result) {
              // $('.cusState').show();
              var html = '';
              for (var i = 0; i < result.length; i++) {
                html += '<option value="' + result[i].id_customer + '">' + result[i].status + ' ' + result[i].nama + '</option>';
              }

              $('#cus-1').html(html);
            }
          });

          console.log(hasil.id_contact_person);
          if (hasil.id_contact_person.length <= 1) {
            $('#cus-1').val(hasil.id_contact_person[0]);
          } else {
            for (let i = 1; i < hasil.id_contact_person.length; i++) {
              const id = $('#client-1').val();
              $.ajax({
                url: '<?php echo base_url('sindikasi/getContactPerson'); ?>',
                method: "GET",
                async: false,
                dataType: 'json',
                data: {
                  id: id
                },
                success: function(result) {
                  console.log(result);
                  var method = `
                                <div class="form-group" id="selectCustomer">
                                  <div class="row">
                                    <div class="col"><label for="customer">Customer</label></div>
                                    <div class="col text-right"><a class="delcustomer btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
                                  </div>
                                  <select name="id_cp[]" id="cus-${i+1}" class="form-control" data-live-search="true" title="Pilih customer...">`
                  for (let j = 0; j < result.length; j++) {
                    method += `<option value="` + result[j].id_customer + `">` + result[j].status + ` ` + result[j].nama + `</option>`
                  }
                  method += `
                              </select>
                              </div>`


                  $('.cp').append(method);
                  $(`#cus-${i+1}`).val(hasil.id_contact_person[i]);
                }
              })
            }
          }


          // $('.fileprop').next('.label-proposal').html(hasil.proposa);
          // $('#proposal').val(hasil.proposal);
          $('#status-1').val(hasil.id_status);

          $('#harga_penawaran').val(numberWithCommas(hasil.harga_penawaran));
          $('#diskon').val(numberWithCommas(hasil.diskon));
          $('#total').val(numberWithCommas(hasil.total));

          if (hasil.tgl_update == "0000-00-00")
            $('#tgl_update').val("");
          else
            $('#tgl_update').val(hasil.tgl_update);
          if (hasil.tgl_deal == "0000-00-00")
            $('#tgl_deal').val("");
          else
            $('#tgl_deal').val(hasil.tgl_deal);

          $('.dropdown-menu.drawdown-revisi').empty();
          // console.log(hasil.proposal)
          if (hasil.proposal.length != 0) {
            let html = '';
            for (let i = 0; i < hasil.proposal.length; i++) {
              html += `<button type="button" class="dropdown-item revisi-item">${hasil.proposal[i]}</button>`
            }
            $('.dropdown-menu.drawdown-revisi').append(html);
          }

          if (hasil.catatan) {
            $('#catatan').val(hasil.catatan);
          }

          $('.selectpicker').selectpicker('refresh');

          window.scrollTo(0, 0);

        }
      })
    });


    // $('.editClient').click(function() {
    //   const id = $(this).data('id');
    //   $('#id_target_client').val(id);

    //   $.ajax({
    //     url: '<?php echo base_url('sindikasi/gettargetclient'); ?>',
    //     method: "GET",
    //     data: {
    //       id: id
    //     },
    //     dataType: 'json',
    //     success: function(hasil) {
    //       console.log(hasil);
    //       $('#client-1').val(hasil.id_client);

    //       const id = hasil.id_client;
    //       if ($(".customerdef").length == 0) {
    //         $(".customer").empty();
    //       } else {
    //         $('.customerdef').remove();
    //       }
    //       $('#customerChange').show();
    //       $.ajax({
    //         url: '<?php echo base_url('sindikasi/getContactPerson') ?>',
    //         method: 'GET',
    //         dataType: 'json',
    //         data: {
    //           id: id
    //         },
    //         success: function(hasil) {
    //           console.log(hasil);
    //           // $('.cusState').show();
    //           var html = '';
    //           for (var i = 0; i < hasil.length; i++) {
    //             html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
    //           }

    //           $('#cus-1').html(html);
    //         }
    //       });

    //       $('#cus-1').val(hasil.id_contact_person);

    //       $('.fileprop').next('.label-proposal').html(label);
    //       $('#proposal').val(hasil.proposal);
    //       $('#status').val(hasil.id_status);

    //       $('#harga_penawaran').val(numberWithCommas(hasil.harga_penawaran));
    //       $('#diskon').val(numberWithCommas(hasil.diskon));
    //       $('#total').val(numberWithCommas(hasil.total));

    //       if (hasil.tgl_update == "0000-00-00")
    //         $('tgl_update').val("");
    //       else
    //         $('tgl_update').val(hasil.tgl_update);
    //       if (hasil.tgl_deal == "0000-00-00")
    //         $('tgl_deal').val("");
    //       else
    //         $('tgl_deal').val(hasil.tgl_deal);

    //       $('.selectpicker').selectpicker('refresh');

    //     }
    //   })

    // })
  });

  function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function countTotalValue(value, disc) {
    const result = value * ((100 - disc) / 100)
    $('#total').val(numberWithCommas(result));
  }
</script>