<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Master Plan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

        <div class="card-body">

          <!-- Mulai codingan -->
          <form action="" method="POST" enctype="multipart/form-data">

            <div class="form-group">
              <label>Email address : </label>
                <input type="email" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
              <label>Nama : </label>
                <select class="form-control" name="nama" id="nama" required>
                  <option value="">Pilih Nama</option>
                  <?php
                  foreach ($masterplannama as $nama) {
                    ?>
                  <option value="<?php echo $nama['Id'];?>"><?php echo $nama['Nama']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Project : </label>
                <select class="form-control" name="project" id="project">
                  <option value="">Pilih Project</option>
                  <?php
                  foreach ($masterplanproject as $project) {
                    ?>
                  <option value="<?php echo $project['kode'];?>"><?php echo $project['nama']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Kota : </label>
                <select class="kota form-control" name="kota" id="kota">
                  <option value="">Pilih kota</option>
                </select>
            </div>

            <div id="tampilancabang"></div>

            <div class="form-group">
              <label>Kota dari : </label>
                <select class="form-control" name="kotadari" id="kotadari">
                  <option value="">Pilih Kota dari</option>
                  <?php
                  foreach ($masterplankota as $kota) {
                    ?>
                  <option value="<?php echo $kota['kabupaten'];?>"><?php echo $kota['kabupaten']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Kota Dinas : </label>
                <select class="form-control" name="kotadari" id="kotadari">
                  <option value="">Pilih Kota dinas</option>
                  <?php
                  foreach ($masterplankota as $kota) {
                    ?>
                  <option value="<?php echo $kota['kabupaten'];?>"><?php echo $kota['kabupaten']; ?></option>
                    <?php
                  }
                  ?>
                <select>
            </div>

            <div class="form-group">
              <label>Penugasan : </label>
                <select class="form-control" name="penugasan" id="penugasan">
                  <option value="">Pilih penugasan</option>
                  <option value="Setempat">Setempat</option>
                  <option value="Dinas">Dinas</option>
                  <option value="Mutasi">Mutasi</option>
                <select>
            </div>

            <div class="row">

              <div class="col-sm-4">
                <div class="form-group">
                 <label>Tanggal Mulai Penugasan : </label>
                  <input type="date" name="tglmulai" class="form-control">
                </div>
              </div>

              <div class="col-sm-4">
                <div class="form-group">
                  <label>Tanggal Selesai Penugasan : </label>
                    <input type="date" name="tglselesai" class="form-control">
                </div>
              </div>

            </div>

            


          </br></br>
            <button type="submit" name="submit" class="btn btn-success">Submit</button>

          </form>
          <!-- //End Coding -->

        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
    $(document).ready(function(){
        $('#project').change(function(){
            var id=$(this).val();
            $.ajax({
                url : "<?php echo base_url('stkbmasterplan/getkotaproject') ?>",
                method : "POST",
                data : {id: id},
                async : false,
                dataType : 'json',
                success: function(hasil){
                  $("#kota").empty();
                  var y = 0;
                  var cetak = "<option>Pilih Kota</option>";;
                  for (var i = 0; i < hasil.length; i++) {
                    cetak += "<option value='" + hasil[i]['kota'] + "'>" + hasil[i]['kota'] + "</option>";
                  }
                  $("#kota").append(cetak);
                }
            });
        });


      $('#kota').change(function(){
        var id = $("#project").val(),
            kota = $("#kota").val();

            // console.log(id + " --> " + kota);
        $.ajax({
          url : "<?php echo base_url('stkbmasterplan/getdaftarcabang') ?>",
          method : "POST",
          data : {id: id, kota: kota},
          async : false,
          dataType : 'json',
          success : function(coba){
            // console.log(coba);
            $("#tampilancabang").empty();
            var y = 0;
            var cobaah = "";
            for (var i = 0; i < coba.length; i++){
              cobaah += "<div class='row'>"
              cobaah += "<div class='col-sm-4'>"
              cobaah += "<div class='checkbox'>";
              cobaah += "<label><input type='checkbox' name='cabang[]' value='" + coba[i]['kode'] + "'>" + coba[i]['nama'] + "</label>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "<div class='col-sm-1'>"
              cobaah += "<div class='form-group'>";
              cobaah += "<div class='checkbox'>";
              cobaah += "<label><input type='checkbox' name='q1_" + coba[i]['kode'] + "' value='001'>Q1</label>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "<div class='col-sm-1'>"
              cobaah += "<div class='form-group'>";
              cobaah += "<div class='checkbox'>";
              cobaah += "<label><input type='checkbox' name='q2" + coba[i]['kode'] + "' value='002'>Q2</label>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "<div class='col-sm-1'>"
              cobaah += "<div class='form-group'>";
              cobaah += "<div class='checkbox'>";
              cobaah += "<label><input type='checkbox' name='q3" + coba[i]['kode'] + "' value='003'>Q3</label>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "<div class='col-sm-2'>"
              cobaah += "<div class='form-group'>";
              cobaah += "<div class='checkbox'>";
              cobaah += "<label><input type='checkbox' name='atmc_" + coba[i]['kode'] + "' value='atmc'>ATM Centre</label>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "</div>";
              cobaah += "</div>";
            }
            $("#tampilancabang").append(cobaah);
          }
        })
      });
    });
</script>
