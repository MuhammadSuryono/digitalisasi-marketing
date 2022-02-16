<?php
$tgl_ = date('m/d/Y', strtotime('+4 days'));
?>
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Input Sindikasi</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data table > Form Sindikasi</h6>
        </div>

        <div class="card-body">
            <form action="" method="POST" class="row" id="formRFQ" enctype="multipart/form-data">
                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="form-group">
                        <label for="user">Nama Project</label>
                        <input type="text" name="nama_project" class="form-control form-control-user inputProject <?php if (form_error('nama_project')) {
                                                                                                                        echo 'is-invalid';
                                                                                                                    } ?>" id="nama_project" placeholder="Ketik Nama Project" autocomplete="off" value="<?php echo set_value('nama_project'); ?>">
                        <?php echo form_error('nama_project', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

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

                </div>

                <div class="col-xl-6 col-md-6 mb-4">
                    <div class="form-group">
                        <label for="user">Target Sales</label>
                        <input type="text" name="target_sales" class="form-control form-control-user inputProject <?php if (form_error('target_sales')) {
                                                                                                                        echo 'is-invalid';
                                                                                                                    } ?>" id="target_sales" placeholder="Ketik Target Sales" autocomplete="off" value="<?php echo set_value('target_sales'); ?>">
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
                                <?php if (set_value('id_user') == $ud['id_user']) { ?>
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
                            <label class="custom-file-label label-proposal">File</label>
                        </div>
                        <?php echo form_error('proposal', '<small class="text-danger pl-3">', '</small>'); ?>
                        <input type="hidden" name="oldfiledata" value="">
                    </div>

                    <div class="form-group">
                        <button class="btn btn-primary" id="btnSave" type="submit">Save</button>
                        <button onclick="location.href='<?php echo base_url('sindikasi') ?>';" id="btnBack" type="button" class="btn btn-danger">Back</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<script type="text/javascript">
    $('.fileprop').on('change', function(e) {
        console.log('here');
        var label = e.target.files[0].name;
        $(this).next('.label-proposal').html(label);
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

    $(document).ready(function() {
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
                  <div class="col"><label for="pic">Methodology</label></div>
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

        $('#target_sales').keyup(function() {
            const value = $(this).val().replace(/,/ig, '')
            $(this).val(numberWithCommas(value));
        });

    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
</script>