<?php
$tgl_ = date('m/d/Y', strtotime('+4 days'));
?>
<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800">Form Input Research Request</h1>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Data table > Form Research Request</h6>
    </div>

    <div class="card-body">
      <form action="" method="POST" class="row" id="formRFQ" enctype="multipart/form-data">
        <div class="col-xl-6 col-md-6 mb-4">
          <div class="form-group">
            <label for="user">Nomor Request</label>
            <input type="text" value="<?php echo $id ?>" name="nomor_rfq" class="form-control form-control-user <?php if (form_error('nomor_rfq')) {
                                                                                                                  echo 'is-invalid';
                                                                                                                } ?>" id="exampleInputEmail" value="<?php echo set_value('nomor_rfq'); ?>" readonly>
            <?php echo form_error('nomor_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <?php $data = $this->ResearchBrief_model->getAllResearchBrief(); ?>
          <div class="form-group">
            <label for="researchBrief">Research Brief</label>
            <select class="form-control selectpicker show-tick inputProject" id="researchBrief" name="researchBrief" data-live-search="true">
              <option value="">-</option>
              <?php foreach ($data as $d) : ?>
                <?php
                $idDept = $d['id_dept'];
                $queryDept = $this->Dept_model->getDeptById($idDept);
                ?>
                <option value="<?= $d['id_research_brief'] ?>"><?= $d['nama'] . ' (' . $queryDept['dept'] . ') - Dibuat oleh/tanggal: ' . $d['nama_user'] . '/' . date('Y-m-d', strtotime($d['created_at'])) ?></option>
              <?php endforeach; ?>
            </select>
            <?= form_error('researchBrief', '<small class="text-danger ml-3">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="user">Jenis Permintaan Request</label>
            <select name="id_jnsprmt_rfq" id="jenisPermintaan" onchange="setDeadline()" class="selectpicker show-tick form-control <?php if (form_error('id_jnsprmt_rfq')) {
                                                                                                                                      echo 'is-invalid';
                                                                                                                                    } ?>" data-live-search="true" title="Pilih jenis permintaan...">
              <?php
              $data = $this->JenisPermRfq_model->getAllJenisPermRfq();
              foreach ($data as $db) : ?>
                <?php if (set_value('id_jnsprmt_rfq') == $db['id_jnsprmt_rfq']) { ?>
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
            <input type="date" name="tgl_masuk" class="form-control form-control-user <php if(form_error('tgl_masuk')){ echo'is-invalid'; } ?>" id="exampleInputEmail" value="<php echo set_value('tgl_masuk'); ?>">
            <php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
          </div-->

          <div class="form-group" id="selectProposalDate">
            <label for="user">Tanggal Request Masuk <sup>*(MM/DD/YYYY)</sup> </label>
            <input id="datepicker1a" name="tgl_masuk" onchange="setDeadline()" class="form-control form-control-user <?php if (form_error('tgl_masuk')) {
                                                                                                                        echo 'is-invalid';
                                                                                                                      } ?>" placeholder="Pilih tanggal" autocomplete="off" value="<?php echo set_value('tgl_masuk'); ?>">
            <?php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>


          <!--div class="form-group">
            <label for="user">Kode Request</label>
            <input type="text" name="kode_project" class="form-control form-control-user </?php if(form_error('kode_project')){ echo'is-invalid'; } ?>" id="exampleInputEmail" placeholder="Ketik kode request" autocomplete="off" value="</?php echo set_value('kode_project'); ?>">
            </?php echo form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
          </div-->

          <!-- Tambahan Adam Santoso -->
          <div class="form-group">
            <label for="user">Kode Request</label>
            <table width="100%" cellspacing="0">
              <tr>
                <td width="20%"><input type="text" name="dlKP" id="dlKP" onkeyup="toUpper(this)" class="form-control inputProject <?php if (form_error('dlKP')) {
                                                                                                                                    echo 'is-invalid';
                                                                                                                                  } ?>" placeholder="........................" autocomplete="off" value="<?php echo set_value('dlKP'); ?>" data-toggle="tooltip" data-html="true" title="<b>Isi dengan nilai D/L</b><br>D : Dalam Negeri<br>L : Luar Negeri"></td>
                <td width="1%">/</td>
                <td width="35%"><input type="text" name="blnThnKP" class="form-control" autocomplete="off" value="<?= $blnThnKP; ?>" readonly></td>
                <td width="1%">/</td>
                <td width="20%"><input type="text" name="asKP" id="asKP" onkeyup="toUpper(this)" class="form-control inputProject <?php if (form_error('asKP')) {
                                                                                                                                    echo 'is-invalid';
                                                                                                                                  } ?>" placeholder="........................" autocomplete="off" value="<?php echo set_value('asKP'); ?>" data-toggle="tooltip" data-html="true" title="<b>Isi dengan nilai A/S</b><br>A : Adhoc<br>S : Sindikasi"></td>
                <td width="1%">/</td>
                <td width="22%"><input type="text" name="noUrutKP" class="form-control" autocomplete="off" value="<?= $noUrutKP; ?>" readonly></td>
              </tr>
            </table>
          </div>


          <div class="form-group">
            <label for="user">Subject Request</label>
            <input type="text" name="nama_project" class="form-control form-control-user inputProject <?php if (form_error('nama_project')) {
                                                                                                        echo 'is-invalid';
                                                                                                      } ?>" id="exampleInputEmail" placeholder="Ketik subject request" autocomplete="off" value="<?php echo set_value('nama_project'); ?>">
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
                <?php if (set_value('id_perusahaan') == $db['id_perusahaan']) { ?>
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
              <select name="id_customer" id="cuss" class="form-control <.?php if(form_error('id_customer')){ echo'is-invalid'; } ?>" data-live-search="true" title="Pilih customer...">
                <option style="display:none;">Pilih perusahaan terlebih dahulu</option>
              </select>
              <.?php echo form_error('id_customer', '<small class="text-danger pl-3">', '</small>'); ?>
            </div-->

          <!-- Tambahan Adam Santoso -->
          <div class="form-group">
            <div class="row">
              <div class="col"><label for="user">Customer</label></div>
              <div id="cusState" class="col text-right" style="display:none;"><a class="addcustomer btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
            </div>
            <select name="id_customer[]" id="cus" class="form-control <?php if (form_error('id_customer[]')) {
                                                                        echo 'is-invalid';
                                                                      } ?>" title="Pilih customer..." required>
              <option value="" style="display:none;">Pilih perusahaan terlebih dahulu</option>
            </select>
            <?php echo form_error('id_customer[]', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="customer"></div>
          <hr class="sidebar-divider">
          <!-- ======== -->


          <div class="jenis-pekerjaan">
            <div class="form-group">
              <div class="row">
                <div class="col">
                  <label for="user">Jenis Pekerjaan Request</label>
                </div>
                <div class="col text-right"><a class="add-jenis-pekerjaan btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
              </div>
              <select name="id_krj_rfq[]" id="id_krj_rfq" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_krj_rfq')) {
                                                                                                                    echo 'is-invalid';
                                                                                                                  } ?>" data-live-search="true" title="Pilih jenis pekerjaan...">
                <?php
                $data = $this->JenisKerjaRfq_model->getAllJenisKerjaRfq();
                foreach ($data as $db) : ?>
                  <?php if (set_value('id_krj_rfq') == $db['id_krj_rfq']) { ?>
                    <option value="<?php echo $db['id_krj_rfq'] ?>" selected><?php echo $db['jenis_pekerjaan'] ?></option>
                  <?php } else { ?>
                    <option value="<?php echo $db['id_krj_rfq'] ?>"><?php echo $db['jenis_pekerjaan'] ?></option>
                  <?php } ?>
                <?php endforeach; ?>
              </select>
              <?php echo form_error('id_krj_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <!-- Di ubah Tedy EDIT Adam Santoso -->
          <div class="form-group">
            <div class="row">
              <div class="col"><label for="user">Methodology</label></div>
              <div class="col text-right"><a class="addmetode btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
            </div>
            <select name="id_methodology[]" id="methodology" class="selectpicker show-tick form-control <?php if (form_error('id_methodology[]')) {
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
          <div class="metode"></div>
          <!-- ======== -->

        </div>

        <div class="col-xl-6 col-md-6 mb-4">

          <!-- Tambahan dari Adam Santoso -->
          <div class="form-group">
            <div class="row">
              <div class="col"><label for="user">Topic Research</label></div>
              <div class="col text-right"><a class="addtopic btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
            </div>
            <select name="id_topic[]" id="id_topic" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_topic[]')) {
                                                                                                              echo 'is-invalid';
                                                                                                            } ?>" data-live-search="true" title="Pilih topic research...">
              <?php
              $data = $this->Topic_model->getAllTopic();
              foreach ($data as $db) : ?>
                <?php if (set_value('id_topic[0]') == $db['id_topic']) { ?>
                  <option value="<?php echo $db['id_topic'] ?>" selected><?php echo $db['topic'] ?>- <?php echo $db['keterangan'] ?></option>
                <?php } else { ?>
                  <option value="<?php echo $db['id_topic'] ?>"><?php echo $db['topic'] ?> - <?php echo $db['keterangan'] ?></option>
                <?php } ?>
              <?php endforeach; ?>
            </select>
            <?php echo form_error('id_topic[]', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="topic"></div>
          <hr class="sidebar-divider">

          <div class="form-group">
            <div class="row">
              <div class="col"><label for="user">Dokumen</label></div>
              <div class="col text-right"><a class="adddokumen btn-sm btn-success text-light" style="cursor:pointer;"><i class="fas fa-plus"></i> Tambah</a></div>
            </div>
            <select name="id_dokumen[]" id="id_dokumen" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_dokumen[]')) {
                                                                                                                  echo 'is-invalid';
                                                                                                                } ?>" data-live-search="true" title="Pilih dokumen...">
              <?php
              $data = $this->Dokumen_model->getAllDokumen();
              foreach ($data as $db) : ?>
                <?php if (set_value('id_dokumen[0]') == $db['id_dokumen']) { ?>
                  <option value="<?php echo $db['id_dokumen'] ?>" selected><?php echo $db['dokumen'] ?>- <?php echo $db['keterangan'] ?></option>
                <?php } else { ?>
                  <option value="<?php echo $db['id_dokumen'] ?>"><?php echo $db['dokumen'] ?> - <?php echo $db['keterangan'] ?></option>
                <?php } ?>
              <?php endforeach; ?>
            </select>
            <?php echo form_error('id_dokumen[]', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>
          <div class="dokumen"></div>
          <hr class="sidebar-divider">
          <!-- ======== -->

          <div class="form-group">
            <label for="user">Request By</label>
            <select name="id_request" id="id_request" class="selectpicker show-tick form-control inputProject <?php if (form_error('id_request')) {
                                                                                                                echo 'is-invalid';
                                                                                                              } ?>" data-live-search="true" title="Pilih Request By...">
              <?php $this->load->model('Request_model');
              $data1 = $this->Request_model->getAllRequest();
              foreach ($data1 as $db1) : ?>
                <?php if (set_value('id_request') == $db1['id_request']) { ?>
                  <option value="<?php echo $db1['id_request'] ?>" selected><?php echo $db1['nama_request'] ?></option>
                <?php } else { ?>
                  <option value="<?php echo $db1['id_request'] ?>"><?php echo $db1['nama_request'] ?></option>
                <?php } ?>
              <?php endforeach; ?>
            </select>
            <?php echo form_error('id_request', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="user">Term of Reference</label>
            <div class="custom-file">
              <input type="file" name="filedata" id="filedata" class="custom-file-input filetor inputProject <?php if (form_error('filedata')) {
                                                                                                                echo 'is-invalid';
                                                                                                              } ?>" value="<?php echo set_value('filedata'); ?>">
              <label class="custom-file-label labeltor">File Term of Reference</label>
            </div>
            <?php echo form_error('filedata', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="user">Catatan Term of Reference</label>
            <input type="text" name="catatan_tor" id="catatan_tor" class="form-control inputProject" placeholder="Catatan Term of Reference" autocomplete="off" value="<?php echo set_value('catatan_tor'); ?>">
          </div>

          <div class="form-group" id="selectDeadlineDate">
            <label for="user">RFQ/RFP Submission Date <sup>*(MM/DD/YYYY)</sup> </label>
            <input id="datepicker1" name="date_system" class="form-control form-control-user inputProject <?php if (form_error('date_system')) {
                                                                                                            echo 'is-invalid';
                                                                                                          } ?>" value="<?php echo $tgl_  ?>">
            <?php echo form_error('date_system', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-group" id="selectDeadlineDate2" style="display:none;">
            <label for="validationTooltipUsername">RFQ/RFP Submission Date <sup>*(MM/DD/YYYY)</sup></label>
            <div class="input-group">
              <input type="text" class="form-control inputProject" id="setDeadlineDate" value="" disabled>
              <div class="input-group-append">
                <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-calendar-day"></i></span>
              </div>
            </div>
          </div>

          <div class="form-group">
            <label for="user">Deadline from Customer <sup>*(MM/DD/YYYY)</sup></label>
            <input id="datepicker2" name="date_customer" class="form-control form-control-user inputProject <?php if (form_error('date_customer')) {
                                                                                                              echo 'is-invalid';
                                                                                                            } ?>" id="exampleInputEmail" value="<?php echo $tgl_  ?>">
            <?php echo form_error('date_customer', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-group" style="display:none;">
            <label for="user">Tanggal Submit <sup>*(MM/DD/YYYY)</sup></label>
            <input id="datepicker3" name="tgl_submit" class="form-control form-control-user inputProject" id="exampleInputEmail" placeholder="Pilih tanggal" value="<?php echo set_value('tgl_submit'); ?>">
            <?php echo form_error('tgl_submit', '<small class="text-danger pl-3">', '</small>'); ?>
          </div>

          <div class="form-group">
            <button class="btn btn-primary" id="btnSave" type="submit">Save</button>
            <button onclick="location.href='<?php echo base_url('rfq') ?>';" id="btnBack" type="button" class="btn btn-danger">Back</button>
          </div>

        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
  if ($('#jenisPermintaan').val() == 3) {
    $('.inputProject').val('');
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

  $('#perusahaan').change(function() {
    const id = $(this).val();
    console.log(id);
    $('.customer').empty();
    $.ajax({
      url: '<?php echo base_url('rfq/customer') ?>',
      method: 'GET',
      dataType: 'json',
      data: {
        id: id
      },
      success: function(hasil) {
        //console.log(hasil.length);
        $('#cusState').show();
        var html = '';
        for (var i = 0; i < hasil.length; i++) {
          html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
        }

        $('#cus').html(html);
      }
    });

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

  $(".jenis-pekerjaan").on("click", ".del-jenis-pekerjaan", function(event) {
    $(this).closest("#selectJenisPekerjaan").remove();
  });

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
    return [month, day, year].join('/');
  }

  function setDeadline() {
    var jenis = $("#jenisPermintaan").val();
    var tglProposal = $("#datepicker1a").val();
    if (!!tglProposal) {
      if (jenis == 1) {
        var date = formatDate(tglProposal);
        $("#selectDeadlineDate").hide();
        $("#setDeadlineDate").val(date);
        $("#datepicker1").val(date);
        $("#selectDeadlineDate2").show();
      } else if (jenis == 2) {
        var date = formatDate(tglProposal);
        $("#selectDeadlineDate").hide();
        $("#setDeadlineDate").val(date);
        $("#datepicker1").val(date);
        $("#selectDeadlineDate2").show();
      } else {
        var date = '<?php echo date('m/d/Y'); ?>';
        $("#datepicker1").val(date);
        $("#selectDeadlineDate").show();
        $("#selectDeadlineDate2").hide();
      }
    }
  }

  function toUpper(obj) {
    obj.maxLength = 1;
    obj.value = obj.value.toUpperCase();
  }

  $(document).ready(function() {
    $('.filetor').on('change', function(e) {
      var label = e.target.files[0].name;
      $(this).next('.labeltor').html(label);
    });

    $("#formRFQ").submit(function() {
      if ($('#cus').val() != '') {
        $('#btnSave').prop('disabled', true);
        $('#btnSave').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Menyimpan...');
        $('#btnBack').prop('disabled', true);
      }
    });
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

    $('#datepicker1a').datepicker({
      uiLibrary: 'bootstrap4',
      icons: {
        rightIcon: '<i class="fas fa-calendar-day"></i>'
      }
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
                <select required name="id_customer[]" class="form-control" data-live-search="true" title="Pilih customer...">`
          for (let j = 0; j < hasil.length; j++) {
            method += `<option value="` + hasil[j].id_customer + `">` + hasil[j].status + ` ` + hasil[j].nama + `</option>`
          }
          method += `
              </select>
    					</div>`

          $(".customer").append(method);
        }
      })
    });

    $(".customer").on("click", ".delcustomer", function(event) {
      $(this).closest("#selectCustomer").remove();
    });

  });
</script>