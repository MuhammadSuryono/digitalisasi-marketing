 <!-- Begin Page Content -->
 <div class="container-fluid">
     <!-- Page Heading -->
     <h1 class="h3 mb-4 text-gray-800">Data Absensi <?php echo $kegiatan[$absen['kegiatan']] .' '. $absen['nama_project']  ?></h1>
     <!-- DataTales Example -->
     <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Scan QR-Code</h6>
         </div>

         <div class="card-body">
            <div class="container" id="QR-Code">
            <div class="panel panel-info">
                <div class="row  justify-content-center text-center">
                    <div class="col-md-6">
                        <div id="scan">
                            <div class="well" style="position: relative;display: inline-block;">
                                <canvas width="320" height="240" id="webcodecam-canvas"></canvas>
                                <div class="scanner-laser laser-rightBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-rightTop" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftBottom" style="opacity: 0.5;"></div>
                                <div class="scanner-laser laser-leftTop" style="opacity: 0.5;"></div>
                            </div>
                            <div class="well" style="width: 100%;">
                                <label id="zoom-value" width="100">Zoom: 2</label>
                                <input id="zoom" onchange="Page.changeZoom();" type="range" min="10" max="30" value="20">
                               
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="camera-select"></select>
                                <button title="Play" class="btn btn-success btn-sm" id="play" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-play"><i class="fas fa-play"></i></span></button>
                                <button title="Pause" class="btn btn-warning btn-sm" id="pause" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-pause"><i class="fas fa-pause"></i></span></button>
                                <button title="Stop streams" class="btn btn-danger btn-sm" id="stop" type="button" data-toggle="tooltip"><span class="glyphicon glyphicon-stop"><i class="fas fa-stop"></i></span></button>
                            </div>
                        </div>
                        <div id="notif"></div>
                    </div>
                </div>
                <div class="row  justify-content-center text-center">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jam</th>
                            </tr>
                        </thead>
                        <tbody id="showAbsen">
                            
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="thumbnail" id="result">
                        <div class="well" style="overflow: hidden;">
                            <img width="320" height="240" id="scanned-img" src="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
         </div>
     </div>

     <input type="hidden" name="rfq" id="rfq" value="<?php echo $absen['id_absensi'] ?>" >

 </div>
 <!-- /.container-fluid -->

 </div>
<script type="text/javascript">
    $("#scanned-img").hide();
    $("#camera-select").hide();


    showAbsen();

    function showAbsen()
    {
        var id = '<?php echo $absen['id_absensi'] ?>';

        $.ajax({
            url : '<?php echo base_url('absensi/showdata') ?>',
            method : 'GET',
            dataType :'json',
            data : {id : id},
            success : function(hasil){
                var no = 1;
                var html = "";
                for(var i = 0; i<hasil.length; i++){
                    html += '<tr>';
                    html += '<td>'+ no +'</td>'
                    html += '<td>'+ hasil[i].nama_user +'</td>'
                    html += '<td>'+ hasil[i].date +'</td>'
                    html +='</tr>';
                }

                $('#showAbsen').html(html);
            }
        });
    }
</script>
