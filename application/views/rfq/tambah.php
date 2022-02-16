<?php
$tgl_ = date('m/d/Y', strtotime('+4 days'));

?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Input Data Request</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data table > Form </h6>
        </div>

        <div class="card-body">
            <form action="" method="POST" class="row" enctype="multipart/form-data">
                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="form-group">
                        <label for="user">Nomor Request</label>
                        <input type="text" value="<?php echo $id ?>" name="nomor_rfq" class="form-control form-control-user <?php if (form_error('nomor_rfq')) {
                                                                                                                                echo 'is-invalid';
                                                                                                                            } ?>" id="exampleInputEmail" value="<?php echo set_value('nomor_rfq'); ?>" readonly>
                        <?php echo form_error('nomor_rfq', '<small class="text-danger pl-3">', '</small>'); ?>
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

                    <div class="form-group">
                        <label for="user">Tanggal Masuk</label>
                        <input type="date" name="tgl_masuk" class="form-control form-control-user <?php if (form_error('tgl_masuk')) {
                                                                                                        echo 'is-invalid';
                                                                                                    } ?>" id="exampleInputEmail" value="<?php echo set_value('tgl_masuk'); ?>">
                        <?php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="user">Kode Request</label>
                        <input type="text" name="kode_project" class="form-control form-control-user <?php if (form_error('kode_project')) {
                                                                                                            echo 'is-invalid';
                                                                                                        } ?>" id="exampleInputEmail" value="<?php echo set_value('kode_project'); ?>">
                        <?php echo form_error('kode_project', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group">
                        <label for="user">Nama Request</label>
                        <input type="text" name="nama_project" class="form-control form-control-user <?php if (form_error('nama_project')) {
                                                                                                            echo 'is-invalid';
                                                                                                        } ?>" id="exampleInputEmail" value="<?php echo set_value('nama_project'); ?>">
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

                    <div class="form-group">
                        <label for="user">Customer</label>
                        <select name="id_customer" id="cus" class="form-control <?php if (form_error('id_customer')) {
                                                                                    echo 'is-invalid';
                                                                                } ?>" data-live-search="true" title="Pilih customer...">

                        </select>
                        <?php echo form_error('id_customer', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                </div>

                <div class="col-xl-5 col-md-6 mb-4">
                    <div class="form-group">
                        <label for="user">Jenis Pekerjaan Request</label>
                        <select name="id_krj_rfq" class="selectpicker show-tick form-control <?php if (form_error('id_krj_rfq')) {
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

                    <!-- Di Ubah tedy -->
                    <div class="col-md-1">
                        <button type="button" class="addrow btn-sm btn-success"><i class="fas fa-plus"></i> Tambah</button>
                    </div>
                    <ul class="umum">
                        <li>
                            <div class="form-group">
                                <label for="user">Methodology</label>
                                <select name="id_methodology" class="selectpicker show-tick form-control <?php if (form_error('id_methodology')) {
                                                                                                                echo 'is-invalid';
                                                                                                            } ?>" data-live-search="true" title="Pilih methodology...">
                                    <?php
                                    $data = $this->Methodology_model->getAllMethodology();
                                    foreach ($data as $db) : ?>
                                        <?php if (set_value('id_methodology') == $db['id_methodology']) { ?>
                                            <option value="<?php echo $db['id_methodology'] ?>" selected><?php echo $db['methodology'] ?>- <?php echo $db['keterangan'] ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $db['id_methodology'] ?>"><?php echo $db['methodology'] ?> - <?php echo $db['keterangan'] ?></option>
                                        <?php } ?>
                                    <?php endforeach; ?>
                                </select>
                                <?php echo form_error('methodology', '<small class="text-danger pl-3">', '</small>'); ?>
                            </div>
                        </li>
                    </ul>

                    <input type="hidden" id="jmlkeranjangumum" name="jmlkeranjangumum" value="0">

                    <br /><br />
                    <!-- //Di Ubah tedy -->

                    <div class="form-group">
                        <label for="user">Request Oleh</label>
                        <select name="id_request" class="selectpicker show-tick form-control <?php if (form_error('id_request')) {
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
                        <label for="user">Project Spec</label>
                        <input type="file" name="filedata" class="form-control form-control-user <?php if (form_error('file_project')) {
                                                                                                        echo 'is-invalid';
                                                                                                    } ?>" id="exampleInputEmail" value="<?php echo set_value('file_project'); ?>">
                        <?php echo form_error('file_project', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group" id="selectDeadlineDate">
                        <label for="user">Deadline Standard <sup>*(MM/DD/YYYY)</sup> </label>
                        <input id="datepicker1" name="date_system" class="form-control form-control-user <?php if (form_error('date_system')) {
                                                                                                                echo 'is-invalid';
                                                                                                            } ?>" value="<?php echo $tgl_  ?>">
                        <?php echo form_error('tgl_masuk', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group" id="selectDeadlineDate2" style="display:none;">
                        <label for="validationTooltipUsername">Deadline Standard <sup>*(MM/DD/YYYY)</sup></label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="setDeadlineDate" value="" disabled>
                            <div class="input-group-append">
                                <span class="input-group-text" id="validationTooltipUsernamePrepend"><i class="fas fa-calendar-day"></i></span>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="user">Deadline from Customer <sup>*(MM/DD/YYYY)</sup></label>
                        <input id="datepicker2" name="date_customer" class="form-control form-control-user <?php if (form_error('date_customer')) {
                                                                                                                echo 'is-invalid';
                                                                                                            } ?>" id="exampleInputEmail" value="<?php echo $tgl_  ?>">
                        <?php echo form_error('date_customer', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                        <label for="user">Tanggal Submit <sup>*(MM/DD/YYYY)</sup></label>
                        <input id="datepicker3" name="tgl_submit" class="form-control form-control-user" id="exampleInputEmail" value="<?php echo set_value('tgl_submit'); ?>">

                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Save</button>
                        <a href="<?php echo base_url('rfq') ?>" class=" btn btn-danger"> Back</a>
                    </div>

                </div>
            </form>
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
                <h5 class="modal-title" id="exampleModalLabel">Form Input Dept</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('customer/tambahDept') ?>">
                    <div class="form-group">
                        <input type="text" name="dept" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Dept">
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

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Input Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('customer/tambahJabatan') ?>">
                    <div class="form-group">
                        <input type="text" name="jabatan" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Input Jabatan">
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
    $('#perusahaan').change(function() {
        const id = $(this).val();

        $.ajax({
            url: '<?php echo base_url('rfq/customer') ?>',
            method: 'GET',
            dataType: 'json',
            data: {
                id: id
            },
            success: function(hasil) {
                //console.log(hasil.length);
                var html = '';
                for (var i = 0; i < hasil.length; i++) {
                    html += '<option value="' + hasil[i].id_customer + '">' + hasil[i].status + ' ' + hasil[i].nama + '</option>';
                }

                $('#cus').html(html);
            }
        });
    });

    function setDeadline() {
        var jenis = $("#jenisPermintaan").val();
        if (jenis == 1) {
            var date = '<?php echo date('m/d/Y', strtotime('+1 days')); ?>';
            $("#selectDeadlineDate").hide();
            $("#setDeadlineDate").val(date);
            $("#datepicker1").val(date);
            $("#selectDeadlineDate2").show();
        } else if (jenis == 2) {
            var date = '<?php echo date('m/d/Y', strtotime('+5 days')); ?>';
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
</script>