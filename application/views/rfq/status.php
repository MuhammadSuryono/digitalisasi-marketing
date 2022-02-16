<?php // INISIALISASI KODE PROJECT THIS CODE ADDED BY ADAM SANTOSO
$KP = explode('/', $rfq['kode_project']);
$dlKP = $KP[0];
$blnThnKP = $KP[1];
$asKP = $KP[2];
$noUrutKP = $KP[3];
function templateFile($file)
{
  if ($file != null) {
    return substr($file, 0, 20) . '... <small><a onclick="view(\'' . $file . '\');" class="text-primary" data-toggle="modal" data-target="#viewModal" style="cursor:pointer;">View</a> - <a href="' . base_url('rfq/download/' . $file) . '" class="text-primary">Download</a></small>';
  }
}
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Research Request - <?php echo $rfq['nomor_rfq'] ?></h1>
  <!-- DataTales Example -->
  <div class="row">
    <div class="col-lg-8">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
        </div>

        <div class="card-body">
          <form action="" method="POST" class="row" enctype="multipart/form-data">
            <div class="col-lg col-md-6 mb-4">
              <input type="hidden" value="<?php echo $rfq['nomor_rfq'] ?>" name="id">
              <div class="form-group">
                <label for="user">Nomor Request</label>
                <input type="text" value="<?php echo $rfq['nomor_rfq'] ?>" name="nomor_rfq" class="form-control form-control-user <?php if (form_error('nomor_rfq')) {
                                                                                                                                    echo 'is-invalid';
                                                                                                                                  } ?>" readonly>
                <?php echo form_error('nomor_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="form-group">
                <label for="user">Jenis Permintaan</label>
                <select name="id_jnsprmt_rfq" id="jenisPermintaan" onchange="setDeadline()" class="selectpicker show-tick form-control <?php if (form_error('id_jnsprmt_rfq')) {
                                                                                                                                          echo 'is-invalid';
                                                                                                                                        } ?>" data-live-search="true" title="Pilih jenis permintaan...">
                  <?php
                  $data = $this->JenisPermRfq_model->getAllJenisPermRfq();
                  foreach ($data as $db) : ?>
                    <?php if ($rfq['id_jnsprmt_rfq'] == $db['id_jnsprmt_rfq']) { ?>
                      <option value="<?php echo $db['id_jnsprmt_rfq'] ?>" selected><?php echo $db['jenis_permintaan'] ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $db['id_jnsprmt_rfq'] ?>"><?php echo $db['jenis_permintaan'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_jnsprmt_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!--div class="form-group">
								 <label for="user">Tanggal Masuk</label>
								 <input type="date" name="tgl_masuk" class="form-control form-control-user <php if(form_error('tgl_masuk')){ echo'is-invalid'; } ?>"  value="<php echo $rfq['tgl_masuk'] ?>">
								 <php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
							 </div-->
              <div class="form-group" id="selectProposalDate">
                <label for="user">Tanggal Request Masuk</label>
                <input id="datepickers1a" type="date" name="tgl_masuk" onchange="setDeadline()" class="form-control form-control-user <?php if (form_error('tgl_masuk')) {
                                                                                                                                        echo 'is-invalid';
                                                                                                                                      } ?>" placeholder="Pilih tanggal" value="<?php echo $rfq['tgl_masuk']; ?>">
                <?php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <!--div class="form-group">
								 <label for="user">Kode Request</label>
								 <input type="text" name="kode_project" class="form-control form-control-user </?php if(form_error('kode_project')){ echo'is-invalid'; } ?>" value="</?php echo $rfq['kode_project'] ?>">
								 </?php echo form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
							 </div-->
              <div class="form-group">
                <label for="user">Kode Request</label>
                <table width="100%" cellspacing="0">
                  <tr>
                    <td width="20%"><input type="text" name="dlKP" id="dlKP" onkeyup="toUpper(this)" maxlength="1" class="form-control inputProject <?php if (form_error('dlKP')) {
                                                                                                                                                      echo 'is-invalid';
                                                                                                                                                    } ?>" placeholder="........................" autocomplete="off" value="<?php echo set_value('dlKP', $dlKP); ?>" data-toggle="tooltip" data-html="true" title="<b>Isi dengan nilai D/L</b><br>D : Dalam Negeri<br>L : Luar Negeri"></td>
                    <td width="1%">/</td>
                    <td width="35%"><input type="text" name="blnThnKP" class="form-control" autocomplete="off" value="<?= $blnThnKP; ?>" readonly></td>
                    <td width="1%">/</td>
                    <td width="20%"><input type="text" name="asKP" id="asKP" onkeyup="toUpper(this)" maxlength="1" class="form-control inputProject <?php if (form_error('asKP')) {
                                                                                                                                                      echo 'is-invalid';
                                                                                                                                                    } ?>" placeholder="........................" autocomplete="off" value="<?php echo set_value('asKP', $asKP); ?>" data-toggle="tooltip" data-html="true" title="<b>Isi dengan nilai A/S</b><br>A : Adhoc<br>S : Sindikasi"></td>
                    <td width="1%">/</td>
                    <td width="22%"><input type="text" name="noUrutKP" class="form-control" autocomplete="off" value="<?= $noUrutKP; ?>" readonly></td>
                  </tr>
                </table>
              </div>

              <div class="form-group">
                <label for="user">Subject Request</label>
                <input type="text" name="nama_project" class="form-control form-control-user inputProject <?php if (form_error('nama_project')) {
                                                                                                            echo 'is-invalid';
                                                                                                          } ?>" value="<?php echo $rfq['nama_project'] ?>">
                <?php echo form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>


              <div class="form-group">
                <label for="user">Perusahaan</label>
                <select name="id_perusahaan" id="perusahaan" class="selectpicker show-tick form-control <?php if (form_error('id_perusahaan')) {
                                                                                                          echo 'is-invalid';
                                                                                                        } ?>" data-live-search="true" title="Pilih perusahaan...">
                  <?php
                  $data = $this->Perusahaan_model->getAllPerusahaan();
                  foreach ($data as $db) : ?>
                    <?php if ($rfq['id_perusahaan'] == $db['id_perusahaan']) { ?>
                      <option value="<?php echo $db['id_perusahaan'] ?>" selected><?php echo $db['nama'] ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $db['id_perusahaan'] ?>"><?php echo $db['nama'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('id_perusahaan', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <!--div class="form-group">
								 <label for="user">Customer</label>
								 <select name="id_customer" id="customer" class="selectpicker show-tick form-control </?php if(form_error('id_customer')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih customer...">
									 </?php
										$data = $this->Customer_model->getAllCustomer();
										foreach ($data as $db) : ?>
									</?php if ($rfq['id_customer'] == $db['id_customer'] ) { ?>
									<option value="</?php echo $db['id_customer'] ?>" selected></?php echo $db['nama_cus'] ?></option>
									</?php }else{ ?>
									 <option value="</?php echo $db['id_customer'] ?>"></?php echo $db['nama_cus'] ?></option>
									</?php } ?>
									 </?php endforeach; ?>
								 </select>
								  </?php echo form_error('id_customer', '<small class="text-danger pl-3">', '</small>'); ?>
							  </div-->


              <!-- Tambahan dari Adam Santoso -->
              <div class="customerdef">
                <?php echo form_error('id_customer[]', '<small class="text-danger pl-3">', '</small>'); ?>
                <?php $cekCustomer = @unserialize($rfq['id_customer']);
                if ($cekCustomer !== false) {
                  $data = $this->Customer_model->getAllCustomerByPerusahaan($rfq['id_perusahaan']);
                  $id_customer = unserialize($rfq['id_customer']);
                  $cusLn = count($id_customer);
                } else {
                  $datas = $this->Customer_model->getCustomerByIdArray($rfq['id_customer']);
                  $id_customer = $datas[0]['id_customer'];
                  $data = $this->Customer_model->getAllCustomerByPerusahaan($rfq['id_perusahaan']);
                  $cusLn = count($datas);
                }

                for ($i = 0; $i < $cusLn; $i++) {
                  echo '
                        <div class="form-group" id="selectCustomer">
                          <div class="row">
                            <div class="col"><label for="user">Customer</label></div>';
                  if ($i == 0) {
                    echo '<div class="col text-right"><a class="addcustomer btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>';
                  } else {
                    echo '<div class="col text-right"><a class="delcustomer btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>';
                  }
                  echo '
                          </div>
                          <select required name="id_customer[]" id="cus" class="form-control" data-live-search="true" title="Pilih customer...">';
                  foreach ($data as $db) {
                    if ($id_customer[$i] == $db['id_customer']) {
                      echo '<option value="' . $db['id_customer'] . '" selected>' . $db['status'] . ' ' . $db['nama_cus'] . '</option>';
                    } else {
                      echo '<option value="' . $db['id_customer'] . '">' . $db['status'] . ' ' . $db['nama_cus'] . '</option>';
                    }
                  }
                  echo '</select></div>';
                }
                ?>
              </div>
              <div class="form-group" id="customerChange" style="display:none">
                <div class="row">
                  <div class="col"><label for="user">Customer</label></div>
                  <div id="cusState" class="col text-right" style="display:none;"><a class="addcustomer btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                </div>
                <select name="id_customer[]" id="cus" class="form-control <?php if (form_error('id_customer[]')) {
                                                                            echo 'is-invalid';
                                                                          } ?>" data-live-search="true" title="Pilih customer...">
                </select>
                <?php echo form_error('id_customer[]', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>
              <div class="customer"></div>
              <hr class="sidebar-divider">
              <!-- ======== -->

              <!-- <div class="jenis-pekerjaan">
                <div class="form-group">
                  <div class="row">
                    <div class="col">
                      <label for="user">Jenis Pekerjaan</label>
                    </div>
                    <div class="col text-right"><a class="add-jenis-pekerjaan btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                  </div>
                  <select name="id_krj_rfq[]" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_krj_rfq')) {
                                                                                                        echo 'is-invalid';
                                                                                                      } ?>" data-live-search="true" title="Pilih jenis pekerjaan...">
                    <?php
                    $data = $this->JenisKerjaRfq_model->getAllJenisKerjaRfq();
                    foreach ($data as $db) : ?>
                      <?php if ($rfq['id_krj_rfq'] == $db['id_krj_rfq']) { ?>
                        <option value="<?php echo $db['id_krj_rfq'] ?>" selected><?php echo $db['jenis_pekerjaan'] ?></option>
                      <?php } else { ?>
                        <option value="<?php echo $db['id_krj_rfq'] ?>"><?php echo $db['jenis_pekerjaan'] ?></option>
                      <?php } ?>
                    <?php endforeach; ?>
                  </select>
                  <?php echo form_error('id_krj_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
              </div> -->
              <div class="jenis-pekerjaan">
                <?php if ($rfq['id_jnsprmt_rfq'] == 3) : ?>
                  <div class="form-group">
                    <div class="row">
                      <div class="col"><label for="user">Jenis Pekerjaan</label></div>
                      <div class="col text-right"><a class="add-jenis-pekerjaan btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                    </div>
                    <select name="id_krj_rfq[]" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_krj_rfq[]')) {
                                                                                                          echo 'is-invalid';
                                                                                                        } ?>" data-live-search="true" title="Pilih jenis pekerjaan...">
                      <?php
                      $data = $this->JenisKerjaRfq_model->getAllJenisKerjaRfq();
                      foreach ($data as $db) : ?>
                        <?php if (set_value('id_krj_rfq[0]') == $db['id_krj_rfq']) { ?>
                          <option value="<?php echo $db['id_krj_rfq'] ?>" selected><?php echo $db['jenis_pekerjaan'] ?></option>
                        <?php } else { ?>
                          <option value="<?php echo $db['id_krj_rfq'] ?>"><?php echo $db['jenis_pekerjaan'] ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_krj_rfq[]', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                <?php else : ?>

                  <?php echo form_error('id_krj_rfq[]', '<small class="text-danger pl-3">', '</small>'); ?>
                  <?php $cekMetode = @unserialize($rfq['id_krj_rfq']);
                  $data = $this->JenisKerjaRfq_model->getAllJenisKerjaRfq();
                  if ($cekMetode !== false) {
                    $id_metod = unserialize($rfq['id_krj_rfq']);
                    $metodLn = count($id_metod);
                  } else {
                    $datas = $this->JenisKerjaRfq_model->getJenisKerjaRfqByIdArray($rfq['id_krj_rfq']);
                    $id_metod = $datas[0]['id_krj_rfq'];
                    $metodLn = count($datas);
                  }

                  for ($i = 0; $i < $metodLn; $i++) {
                    echo '
                        <div class="form-group" id="selectJenisPekerjaan">
                          <div class="row">
                            <div class="col"><label for="user">Jenis Pekerjaan</label></div>';
                    if ($i == 0) {
                      echo '<div class="col text-right"><a class="add-jenis-pekerjaan  btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>';
                    } else {
                      echo '<div class="col text-right"><a class="del-jenis-pekerjaan btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>';
                    }
                    echo '
                          </div>
                          <select required name="id_krj_rfq[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih methodology...">';
                    foreach ($data as $db) {
                      if ($id_metod[$i] == $db['id_krj_rfq']) {
                        echo '<option value="' . $db['id_krj_rfq'] . '" selected>' . $db['jenis_pekerjaan'] . '</option>';
                      } else {
                        echo '<option value="' . $db['id_krj_rfq'] . '">' . $db['jenis_pekerjaan'] . '</option>';
                      }
                    }
                    echo '</select></div>';
                  }
                  ?>
                <?php endif; ?>
              </div>

              <div class="metode">
                <?php if ($rfq['id_jnsprmt_rfq'] == 3) : ?>
                  <div class="form-group">
                    <div class="row">
                      <div class="col"><label for="user">Methodology</label></div>
                      <div class="col text-right"><a class="addmetode btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                    </div>
                    <select name="id_methodology[]" id="methodology" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_methodology[]')) {
                                                                                                                                echo 'is-invalid';
                                                                                                                              } ?>" data-live-search="true" title="Pilih methodology...">
                      <?php
                      $data = $this->Methodology_model->getAllMethodology();
                      foreach ($data as $db) : ?>
                        <?php if (set_value('id_methodology[0]') == $db['id_methodology']) { ?>
                          <option value="<?php echo $db['id_methodology'] ?>" selected><?php echo $db['methodology'] ?>- <?php echo $db['keterangan'] ?></option>
                        <?php } else { ?>
                          <option value="<?php echo $db['id_methodology'] ?>"><?php echo $db['methodology'] ?> - <?php echo $db['keterangan'] ?></option>
                        <?php } ?>
                      <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_methodology[]', '<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                <?php else : ?>

                  <?php echo form_error('id_methodology[]', '<small class="text-danger pl-3">', '</small>'); ?>
                  <?php $cekMetode = @unserialize($rfq['id_methodology']);
                  $data = $this->Methodology_model->getAllMethodology();
                  if ($cekMetode !== false) {
                    $id_metod = unserialize($rfq['id_methodology']);
                    $metodLn = count($id_metod);
                  } else {
                    $datas = $this->Methodology_model->getMethodologyByIdArray($rfq['id_methodology']);
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
                <?php endif; ?>
              </div>
              <!-- ======== -->

            </div>
            <div class="col-lg col-md-6 mb-4">
              <!-- Tambahan dari Adam Santoso -->
              <div class="topic">
                <?php echo form_error('id_topic[]', '<small class="text-danger pl-3">', '</small>'); ?>
                <?php $cekTopic = @unserialize($rfq['id_topic']);
                $data = $this->Topic_model->getAllTopic();
                if ($cekTopic !== false) {
                  $id_topic = unserialize($rfq['id_topic']);
                  $topicLn = count($id_topic);
                  for ($i = 0; $i < $topicLn; $i++) {
                    echo '
                       <div class="form-group" id="selectTopic">
                         <div class="row">
                           <div class="col"><label for="user">Topic Research</label></div>';
                    if ($i == 0) {
                      echo '<div class="col text-right"><a class="addtopic btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>';
                    } else {
                      echo '<div class="col text-right"><a class="deltopic btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>';
                    }
                    echo '
                         </div>
                         <select required name="id_topic[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih topic research...">';
                    foreach ($data as $db) {
                      if ($id_topic[$i] == $db['id_topic']) {
                        echo '<option value="' . $db['id_topic'] . '" selected>' . $db['topic'] . '- ' . $db['keterangan'] . '</option>';
                      } else {
                        echo '<option value="' . $db['id_topic'] . '">' . $db['topic'] . ' - ' . $db['keterangan'] . '</option>';
                      }
                    }
                    echo '</select></div>';
                  }
                } else {
                  echo '
                       <div class="form-group" id="selectTopic">
                         <div class="row">
                           <div class="col"><label for="user">Topic Research</label></div>
                           <div class="col text-right"><a class="addtopic btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                         </div>
                         <select required name="id_topic[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih topic research...">';
                  foreach ($data as $db) {
                    echo '<option value="' . $db['id_topic'] . '">' . $db['topic'] . ' - ' . $db['keterangan'] . '</option>';
                  }
                  echo '</select></div>';
                }
                ?>
              </div>
              <hr class="sidebar-divider">
              <div class="dokumen">
                <?php echo form_error('id_dokumen[]', '<small class="text-danger pl-3">', '</small>'); ?>
                <?php $cekDokumen = @unserialize($rfq['id_dokumen']);
                $data = $this->Dokumen_model->getAllDokumen();
                if ($cekDokumen !== false) {
                  $id_dok = unserialize($rfq['id_dokumen']);
                  $dokLn = count($id_dok);
                  for ($i = 0; $i < $dokLn; $i++) {
                    echo '
                        <div class="form-group" id="selectDocument">
                          <div class="row">
                            <div class="col"><label for="user">Dokumen</label></div>';
                    if ($i == 0) {
                      echo '<div class="col text-right"><a class="adddokumen btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>';
                    } else {
                      echo '<div class="col text-right"><a class="deldokumen btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>';
                    }
                    echo '
                          </div>
                          <select required name="id_dokumen[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih dokumen...">';
                    foreach ($data as $db) {
                      if ($id_dok[$i] == $db['id_dokumen']) {
                        echo '<option value="' . $db['id_dokumen'] . '" selected>' . $db['dokumen'] . '- ' . $db['keterangan'] . '</option>';
                      } else {
                        echo '<option value="' . $db['id_dokumen'] . '">' . $db['dokumen'] . ' - ' . $db['keterangan'] . '</option>';
                      }
                    }
                    echo '</select></div>';
                  }
                } else {
                  echo '
                        <div class="form-group" id="selectDocument">
                          <div class="row">
                            <div class="col"><label for="user">Dokumen</label></div>
                            <div class="col text-right"><a class="adddokumen btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
                          </div>
                          <select required name="id_dokumen[]" class="selectpicker show-tick form-control inputProject" data-live-search="true" title="Pilih dokumen...">';
                  foreach ($data as $db) {
                    echo '<option value="' . $db['id_dokumen'] . '">' . $db['dokumen'] . ' - ' . $db['keterangan'] . '</option>';
                  }
                  echo '</select></div>';
                }
                ?>
              </div>
              <hr class="sidebar-divider">
              <!-- ======== -->

              <div class="form-group">
                <label for="user">Request</label>
                <select name="id_request" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_request')) {
                                                                                                    echo 'is-invalid';
                                                                                                  } ?>" data-live-search="true" title="Pilih Request By...">
                  <?php
                  $data = $this->Request_model->getAllRequest();
                  foreach ($data as $db) : ?>
                    <?php if ($rfq['request'] == $db['id_request']) { ?>
                      <option value="<?php echo $db['id_request'] ?>" selected><?php echo $db['nama_request'] ?></option>
                    <?php } else { ?>
                      <option value="<?php echo $db['id_request'] ?>"><?php echo $db['nama_request'] ?></option>
                    <?php } ?>
                  <?php endforeach; ?>
                </select>
                <?php echo form_error('request', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="user">Term of Reference</label>
                <div class="custom-file">
                  <input type="file" name="filedata" class="custom-file-input filetor inputProject <?php if (form_error('filedata')) {
                                                                                                      echo 'is-invalid';
                                                                                                    } ?>" value="<?php echo set_value('filedata'); ?>">
                  <label class="custom-file-label labeltor">File Term of Reference</label>
                </div>
                <?php echo form_error('filedata', '<small class="text-danger pl-3">', '</small>'); ?>
                <?= templateFile($rfq['file_project']); ?>
                <input type="hidden" name="oldfiledata" value="<?php echo $rfq['file_project'] ?>">
              </div>
              <div class="form-group">
                <label for="user">Catatan Term of Reference</label>
                <input type="text" name="catatan_tor" class="form-control inputProject" placeholder="Catatan Term of Reference" autocomplete="off" value="<?php echo set_value('catatan_tor', $rfq['catatan_tor']); ?>">
              </div>



              <div class="form-group" id="selectDeadlineDate">
                <label for="user">RFQ/RFP Submission Date</label>
                <input id="datepickers1" type="date" name="date_system" class="form-control form-control-user inputProject <?php if (form_error('date_system')) {
                                                                                                                              echo 'is-invalid';
                                                                                                                            } ?>" value="<?php echo $rfq['date_system']; ?>">
                <?php echo form_error('date_system', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <div class="form-group">
                <label for="user">Deadline from Customer</label>
                <input type="date" name="date_customer" class="form-control form-control-user inputProject <?php if (form_error('date_customer')) {
                                                                                                              echo 'is-invalid';
                                                                                                            } ?>" value="<?php echo $rfq['date_customer']; ?>">
                <?php echo form_error('date_customer', '<small class="text-danger pl-3">', '</small>'); ?>
              </div>

              <!--div class="form-group">
								 <label for="user">Tanggal Submit</label>
								 <input type="date" name="tgl_submit" class="form-control form-control-user </?php if(form_error('tgl_submit')){ echo'is-invalid'; } ?>" value="</?php echo $rfq['tgl_submit']?>">
								 </?php echo form_error('tgl_submit', '<small class="text-danger pl-3">', '</small>'); ?>
							 </div-->
            </div>
        </div>
      </div>
    </div>

    <div class="col-lg-4">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Status terakhir </h6>
        </div>
        <div class="card-body">
          <div class="form-group row">
            <div class="col-lg-7">
              <label for="user">Tanggal Feedback</label>
              <input type="date" value="<?php echo $rfq['tgl_feedback'] ?>" name="tgl_feedback" class="form-control form-control-user <?php if (form_error('feedback')) {
                                                                                                                                        echo 'is-invalid';
                                                                                                                                      } ?>" value="<?php echo set_value('feedback'); ?>">
              <?php echo form_error('feedback', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="col-lg-5">
              <label for="user">Status</label>
              <input type="hidden" id="helperStatus" value="<?= set_value('status', $rfq['last_status']); ?>" />
              <select name="status" id="status" onchange="setStatus()" class="form-control" title="Pilih status...">
                <?php // Tambahan Adam Santoso
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
          <div id="alasan-gagal" style="display:none">
            <div class="form-group">
              <label>Tanggal No Deal</label>
              <input type="date" value="<?php $tgl = $rfq['tgl_nodeal'];
                                        echo substr($tgl, 0, 10) . 'T' . substr($tgl, -8); ?>" name="tgl_nodeal" class="form-control form-control-user <?php if (form_error('tgl_nodeal')) {
                                                                                                                                                          echo 'is-invalid';
                                                                                                                                                        } ?> is-invalid" value="<?php echo set_value('tgl_nodeal'); ?>">
              <?php echo form_error('tgl_nodeal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="user">Alasan Gagal</label>
              <select name="id_batal" class="form-control <?php if (form_error('id_batal')) {
                                                            echo 'is-invalid';
                                                          } ?> is-invalid" data-live-search="true" title="Pilih alasan gagal...">
                <?php
                $data = $this->Batal_model->getAllBatal();
                foreach ($data as $db) : ?>
                  <option value=""> </option>
                  <?php if ($rfq['id_batal'] == $db['id_batal']) { ?>
                    <option value="<?php echo $db['id_batal'] ?>" selected><?php echo $db['alasan_batal'] ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $db['id_batal'] ?>"><?php echo $db['alasan_batal'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <?php echo form_error('id_batal', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
            <div class="form-group">
              <label for="user">Masukan Customer</label>
              <textarea name="masukan" id="masukan" class="form-control is-invalid" rows="5"><?php echo $rfq['masukan'] ?> </textarea>
              <?php echo form_error('masukan', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div id="kirimProposal" style="display:none;">
            <div class="form-group">
              <label>Tanggal Kirim Proposal/Quotation</label>
              <input type="datetime-local" value="<?php $tgl = $rfq['tgl_kirim_proposal'];
                                                  echo substr($tgl, 0, 10) . 'T' . substr($tgl, -8); ?>" name="tgl_kirim_proposal" class="form-control form-control-user <?php if (form_error('tgl_kirim_proposal')) {
                                                                                                                                                                            echo 'is-invalid';
                                                                                                                                                                          } ?>" value="<?php echo set_value('tgl_kirim_proposal'); ?>">
              <?php echo form_error('tgl_kirim_proposal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <div class="form-group">
              <div class="custom-file">
                <input type="file" name="file_proposal" class="custom-file-input fileprop <?php if (form_error('file_proposal')) {
                                                                                            echo 'is-invalid';
                                                                                          } ?>" value="<?php echo set_value('file_proposal'); ?>">
                <label class="custom-file-label labelprop">File Proposal</label>
              </div>
              <?php echo form_error('file_proposal', '<small class="text-danger pl-3">', '</small>'); ?>
              <?= templateFile($rfq['file_proposal']); ?>
              <input type="hidden" name="oldfile_proposal" value="<?php echo $rfq['file_proposal'] ?>">
            </div>
          </div>

          <div id="presentasiProposal" style="display:none;">
            <div class="form-group">
              <label>Tanggal Presentasi Proposal</label>
              <input type="datetime-local" value="<?php $tgl = $rfq['tgl_presentasi'];
                                                  echo substr($tgl, 0, 10) . 'T' . substr($tgl, -8); ?>" name="tgl_presentasi" class="form-control form-control-user <?php if (form_error('tgl_presentasi')) {
                                                                                                                                                                        echo 'is-invalid';
                                                                                                                                                                      } ?>" value="<?php echo set_value('tgl_presentasi'); ?>">
              <?php echo form_error('tgl_presentasi', '<small class="text-danger">', '</small>'); ?>
            </div>
          </div>

          <div id="negoProposal" style="display:none;">
            <div class="form-group row">
              <div class="col-lg-7">
                <label>Tanggal Negosiasi</label>
                <input type="datetime-local" value="<?php $tgl = $rfq['tgl_negosiasi'];
                                                    echo substr($tgl, 0, 10) . 'T' . substr($tgl, -8); ?>" name="tgl_negosiasi" class="form-control form-control-user <?php if (form_error('tgl_negosiasi')) {
                                                                                                                                                                        echo 'is-invalid';
                                                                                                                                                                      } ?>" value="<?php echo set_value('tgl_negosiasi'); ?>">
                <?php echo form_error('tgl_negosiasi', '<small class="text-danger">', '</small>'); ?>
              </div>
              <div class="col-lg-5">
                <label for="diskon">Diskon</label>
                <div class="input-group">
                  <input type="number" name="diskon" min="0" max="100" value="<?php $diskon = $rfq['diskon'];
                                                                              echo !!$diskon ? $diskon : '0' ?>" class="form-control">
                  <div class="input-group-append">
                    <span class="input-group-text" id="validationTooltipUsernamePrepend">%</span>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div id="statusDeal" style="display:none;">
            <div class="form-group">
              <label>Tanggal Deal</label>
              <input type="date" value="<?php $tgl = $rfq['tgl_deal'];
                                        echo substr($tgl, 0, 10); ?>" name="tgl_deal" class="form-control form-control-user <?php if (form_error('tgl_deal')) {
                                                                                                                              echo 'is-invalid';
                                                                                                                            } ?>" value="<?php echo set_value('tgl_deal'); ?>">
              <?php echo form_error('tgl_deal', '<small class="text-danger">', '</small>'); ?>
            </div>
            <!-- <div class="form-group">
                <label>Template Project Execution</label>
   						  <select name="template_project" class="form-control </?php if(form_error('template_project')){ echo'is-invalid'; } ?>">
                  <option value="" style="display:none;">Pilih template project execution</option>
                   </?php // Tambahan Adam Santoso
                    $data = $this->TemplateProjectPlan_model->getAllTemplatepp();
                    foreach ($data as $db){
                      if ($data['template_project'] == $db['id_template_project']) {
                        echo '<option value="'.$db['id_template_project'].'" selected>'.$db['nama_template'].'</option>';
                      }else{
                        echo '<option value="'.$db['id_template_project'].'">'.$db['nama_template'].'</option>';
                      }
                    }
                   ?>
   						 </select>
   						 </?php echo form_error('template_project', '<small class="text-danger pl-3">', '</small>'); ?>
              </div> -->
          </div>

          <div class="form-group">
            <button class="btn btn-primary" type="submit"><i class="fas fa-save"></i> Save</button>
            <button type="button" onclick="history.back(-1)" class=" btn btn-danger"><i class="fas fa-arrow-circle-left"></i> Back</button>
          </div>

          <div class="form-group">
            <label> Email info ke </label>
            <textarea name="email" class="form-control" rows="3"></textarea>
            <small class="">*Jika mengirim lebih dari satu email, pisahkan dengan koma ( , )</small>
          </div>

          <div class="form-group">
            <label>Jenis surat</label>
            <select class="form-control" id="jenis_surat" name="jenis_surat">
              <option value="" style="display:none;">Pilih jenis surat</option>
              <?php
              $jenis = $this->Surat_model->getAllSurat();
              // $jenis = $this->db->query('Select * From daftar_surat where id_menu=2')->result_array();
              foreach ($jenis as $db) { ?>
                <option value="<?php echo $db['id_surat'] ?>"><?php echo $db['jenis_surat'] ?></option>
              <?php
              }
              ?>
            </select>
          </div>



          <button class="btn btn-info" id="btnEmail" type="button" name="kirim_email"><i class="fas fa-envelope-open-text"></i> Kirim Email</button>
          <a href="<?php echo base_url('rfq/cetak/' . $rfq['nomor_rfq']) ?>" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Cetak PDF</a>

          </form>
          <br>
          <small class="" id="pesan"></small>
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


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script>
  $(document).ready(function() {
    if ($('#jenisPermintaan').val() == 3) {
      $('.inputProject').prop('disabled', true);
      $('.selectpicker').selectpicker('refresh');
    }
    const test = $('#jenisPermintaan').change(function() {
      if ($(this).val() == 3) {
        $('.inputProject').val('');
        $('.inputProject').prop('disabled', true);
        $('.selectpicker').selectpicker('refresh');
      } else {
        $('.inputProject').prop('disabled', false);
        $('.selectpicker').selectpicker('refresh');
      }
    });
  })

  //Tambahan Adam Santoso
  function formatDate(date) {
    var jenis = $("#jenisPermintaan").val();
    var now = new Date(date);
    if (jenis == 1) {
      now.setDate(now.getDate() + 1); // H+1 tanggal proposal
    } else if (jenis == 2) {
      now.setDate(now.getDate() + 5); // H+5 tanggal proposal
    }
    var d = new Date(now),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();
    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
  }

  function setDeadline() {
    var jenis = $("#jenisPermintaan").val();
    var tglProposal = $("#datepickers1a").val();
    if (!!tglProposal) {
      if (jenis == 1) {
        var date = formatDate(tglProposal);
        $("#datepickers1").val(date);
        $("#datepickers1").attr('readonly', true);
      } else if (jenis == 2) {
        var date = formatDate(tglProposal);
        $("#datepickers1").val(date);
        $("#datepickers1").attr('readonly', true);
      } else {
        var date = '<?php echo $rfq['date_system']; ?>';
        $("#datepickers1").val(date);
        $("#datepickers1").attr('readonly', false);
      }
    }
  }

  function setStatus(status) {
    if (!status) {
      var status = $('#status').val();
    }
    if (status == 1) {
      $('#statusDeal').show();
      $('#alasan-gagal').hide();
      $('#kirimProposal').hide();
      $('#presentasiProposal').hide();
      $('#negoProposal').hide();
    } else if (status == 2) {
      $('#alasan-gagal').show();
      $('#kirimProposal').hide();
      $('#presentasiProposal').hide();
      $('#negoProposal').hide();
      $('#statusDeal').hide();
    } else if (status == 4) {
      $('#kirimProposal').show();
      $('#alasan-gagal').hide();
      $('#presentasiProposal').hide();
      $('#negoProposal').hide();
      $('#statusDeal').hide();
    } else if (status == 5) {
      $('#presentasiProposal').show();
      $('#alasan-gagal').hide();
      $('#kirimProposal').hide();
      $('#negoProposal').hide();
      $('#statusDeal').hide();
    } else if (status == 6) {
      $('#negoProposal').show();
      $('#alasan-gagal').hide();
      $('#kirimProposal').hide();
      $('#presentasiProposal').hide();
      $('#statusDeal').hide();
    } else {
      $('#alasan-gagal').hide();
      $('#kirimProposal').hide();
      $('#presentasiProposal').hide();
      $('#negoProposal').hide();
      $('#statusDeal').hide();
    }
  }

  function toUpper(obj) {
    obj.maxLength = 1;
    obj.value = obj.value.toUpperCase();
  }

  function view(e) {
    var url = '<?php echo base_url('file/rfq/') ?>';
    var options = {
      height: "500px"
    };
    PDFObject.embed(url + e, "#viewDocument", options);
  }

  $('#perusahaan').change(function() {
    const id = $(this).val();
    if ($(".customerdef").length == 0) {
      $(".customer").empty();
    } else {
      $('.customerdef').remove();
    }
    $('#customerChange').show();
    $.ajax({
      url: '<?php echo base_url('rfq/customer') ?>',
      method: 'GET',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(hasil) {
        $('#cusState').show();
        var html = '';
        for (var i = 0; i < hasil.length; i++) {
          html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
        }

        $('#cus').html(html);
      }
    });

  });

  $(document).ready(function() {
    var status = $('#helperStatus').val();
    $('#status').val(status);
    setDeadline();
    setStatus(status);

    $("#dlKP").keypress(function(e) {
      var chr = String.fromCharCode(e.which);
      if ("dlDL".indexOf(chr) < 0 && e.which != 13)
        return false;
    });
    $("#asKP").keypress(function(e) {
      var chr = String.fromCharCode(e.which);
      if ("asAS".indexOf(chr) < 0 && e.which != 13)
        return false;
    });

    $('.filetor').on('change', function(e) {
      var label = e.target.files[0].name;
      $(this).next('.labeltor').html(label);
    });

    $('.fileprop').on('change', function(e) {
      var label = e.target.files[0].name;
      $(this).next('.labelprop').html(label);
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

    $(".add-jenis-pekerjaan").on("click", function() {
      $.ajax({
        url: '<?php echo base_url('rfq/carijenispekerjaan'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        success: function(hasil) {
          var method = `
          <div class="form-group" id="selectJenisPekerjaan">
            <div class="row">
              <div class="col"><label for="user">Jenis Pekerjaan</label></div>
              <div class="col text-right"><a class="del-jenis-pekerjaan btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select required name="id_krj_rfq[]" class="form-control" data-live-search="true" title="Pilih methodology...">`
          for (let j = 0; j < hasil.length; j++) {
            method += `<option value="` + hasil[j].id_krj_rfq + `">` + hasil[j].jenis_pekerjaan + `</option>`
          }
          method += `
          </select>
          </div>`

          $(".jenis-pekerjaan").append(method);
        }
      })
    });

    $(".metode").on("click", ".delmetode", function(event) {
      $(this).closest("#selectMethod").remove();
    });

    $(".jenis-pekerjaan").on("click", ".del-jenis-pekerjaan", function(event) {
      $(this).closest("#selectJenisPekerjaan").remove();
    });

    $(".adddokumen").on("click", function() {
      $.ajax({
        url: '<?php echo base_url('rfq/caridokumen'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        success: function(hasil) {
          var doc = `
          <div class="form-group" id="selectDocument">
            <div class="row">
              <div class="col"><label for="user">Dokumen</label></div>
              <div class="col text-right"><a class="deldokumen btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select required name="id_dokumen[]" class="form-control" data-live-search="true" title="Pilih dokumen...">`
          for (let j = 0; j < hasil.length; j++) {
            doc += `<option value="` + hasil[j].id_dokumen + `">` + hasil[j].dokumen + ` - ` + hasil[j].keterangan + `</option>`
          }
          doc += `
          </select>
          </div>`

          $(".dokumen").append(doc);
        }
      })
    });

    $(".dokumen").on("click", ".deldokumen", function(event) {
      $(this).closest("#selectDocument").remove();
    });

    $(".addtopic").on("click", function() {
      $.ajax({
        url: '<?php echo base_url('rfq/caritopic'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        success: function(hasil) {
          var doc = `
          <div class="form-group" id="selectTopic">
            <div class="row">
              <div class="col"><label for="user">Topic Research</label></div>
              <div class="col text-right"><a class="deltopic btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select required name="id_topic[]" class="form-control" data-live-search="true" title="Pilih topic research...">`
          for (let j = 0; j < hasil.length; j++) {
            doc += `<option value="` + hasil[j].id_topic + `">` + hasil[j].topic + ` - ` + hasil[j].keterangan + `</option>`
          }
          doc += `
          </select>
          </div>`

          $(".topic").append(doc);
        }
      })
    });

    $(".topic").on("click", ".deltopic", function(event) {
      $(this).closest("#selectTopic").remove();
    });


    $(".addcustomer").on("click", function() {
      const id = $('#perusahaan').val();
      $.ajax({
        url: '<?php echo base_url('rfq/customer'); ?>',
        method: "GET",
        async: false,
        dataType: 'json',
        data: {
          id: id
        },
        success: function(hasil) {
          var method = `
          <div class="form-group" id="selectCustomer">
            <div class="row">
              <div class="col"><label for="customer">Customer</label></div>
              <div class="col text-right"><a class="delcustomer btn-sm btn-danger text-light" style="cursor:pointer;"><i class="fas fa-minus"></i> Hapus</a></div>
            </div>
            <select required name="id_customer[]" id="cus" class="form-control" data-live-search="true" title="Pilih customer...">`
          for (let j = 0; j < hasil.length; j++) {
            method += `<option value="` + hasil[j].id_customer + `">` + hasil[j].status + ` ` + hasil[j].nama + `</option>`
          }
          method += `
          </select>
          </div>`

          if ($(".customerdef").length == 0) {
            $(".customer").append(method);
          } else {
            $(".customerdef").append(method);
          }
        }
      })
    });

    $(".customer").on("click", ".delcustomer", function(event) {
      $(this).closest("#selectCustomer").remove();
    });
    $(".customerdef").on("click", ".delcustomer", function(event) {
      $(this).closest("#selectCustomer").remove();
    });
  });
</script>