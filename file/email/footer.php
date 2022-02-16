        <!-- footer content -->
        <footer>
            <div class="pull-right">
                &copy <?php echo $_SESSION['nama_gereja_full'] ; ?>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        </div>
        </div>

        <!-- jQuery -->
        <script src="/assets/gentelella-master/vendors/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="/assets/gentelella-master/vendors/bootstrap/dist/js/bootstrap.min.js">
        </script>
        <!-- FastClick -->
        <script src="/assets/gentelella-master/vendors/fastclick/lib/fastclick.js"></script>
        <!-- NProgress -->
        <script src="/assets/gentelella-master/vendors/nprogress/nprogress.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="/assets/gentelella-master/vendors/moment/min/moment.min.js"></script>
        <script src="/assets/gentelella-master/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->
        <script
            src="/assets/gentelella-master/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js">
        </script>
        <!-- iCheck -->
        <script src="/assets/gentelella-master/vendors/iCheck/icheck.min.js"></script>
        <!-- Datatables -->
        <script src="/assets/gentelella-master/vendors/datatables.net/js/jquery.dataTables.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-buttons/js/dataTables.buttons.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-buttons/js/buttons.flash.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-buttons/js/buttons.html5.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-buttons/js/buttons.print.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-responsive/js/dataTables.responsive.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js">
        </script>
        <script src="/assets/gentelella-master/vendors/datatables.net-scroller/js/dataTables.scroller.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/jszip/dist/jszip.min.js"></script>
        <script src="/assets/gentelella-master/vendors/pdfmake/build/pdfmake.min.js">
        </script>
        <script src="/assets/gentelella-master/vendors/pdfmake/build/vfs_fonts.js"></script>

        <!-- Custom Theme Scripts -->
        <script src="/assets/gentelella-master/build/js/custom.min.js"></script>

        <!-- Requirement for date picker -->
        <script>
// $('#datepicker').datepicker({
//     uiLibrary: 'bootstrap4'
// });

$('#btnAdd_Member').click(function() {
    var data = $('#formAvailable').serialize();
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kelompok/add_member') ?>",
        async: false,
        data: data,
        success: function(msg) {
            list_available();
            list_member();
        },
        error: function(request, error) {
            list_available();
            list_member();
        }
    })
});

$('#btnDel_Member').click(function() {
    var data = $('#formMember').serialize();
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kelompok/del_member') ?>",
        async: false,
        data: data,
        success: function(msg) {
            list_available();
            list_member();
        }
    })
});

$(".check_all1").click(function () {
  $('#available:checkbox').not(this).prop('checked', this.checked);
});

function list_available() {
    var kelompokid = $('#kelompokid1').val();
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kelompok/list_available') ?>",
        async: false,
        data: {
            kelompokid: kelompokid
        },
        success: function(msg) {
            $('#available_title').text('[ ' +  msg.length + ' ]');
            var html = '';
            for (var i = 0; i < msg.length; i++) {
                html += '<tr>' +
                    '<td><input type="checkbox" name="availableid[]" id="availableid[]" value="' +
                    msg[i].jemaatid + '"></td>' +
                    '<td>' + msg[i].nama + '</td>' +
                    '</tr>';
            }
            $('#available').html(html);
        }
    });
}

function list_member() {
    var kelompokid = $('#kelompokid2').val();
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kelompok/list_member') ?>",
        async: false,
        data: {
            kelompokid: kelompokid
        },
        success: function(msg) {
            $('#member_title').text('[ ' +  msg.length + ' ]');
            var html = '';
            for (var i = 0; i < msg.length; i++) {
                html += '<tr>' +
                    '<td><input type="checkbox" name="anggotaid[]" id="anggotaid[]" value="' +
                    msg[i].jemaatid + '"></td>' +
                    '<td>' + msg[i].nama + '</td>' +
                    '</tr>';
            }
            $('#anggota').html(html);
        }
    });
}

$('#btnAdd_Acara').click(function() {
	var content=$('#acara').val();
	var content_singkat=$('#acara_singkat').val();
	$.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_add/acara') ?>",
        async: false,
        data: {
            content: content,
            content_singkat: content_singkat
        },

        success: function(msg) {
        	kegiatan_list_acara();
        },
        error: function(request, error) {
        }
    })
});

function kegiatan_list_acara() {
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_list_acara')?>",
        async: false,
        success: function(msg) {
            var html = '<option value="0">...</option>';
            for (var i = 0; i < msg.length; i++) {
                html += '<tr>' +
                '<option value="' + msg[i].acaraid + '">' + msg[i].acara + '</option>';
            }
            $('#acaraid').html(html);
        }
    });
}



$('#btnAdd_Lokasi').click(function() {
	var content=$('#lokasi').val();
	var content_singkat=$('#lokasi_singkat').val();
	$.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_add/lokasi') ?>",
        async: false,
        data: {
            content: content,
            content_singkat: content_singkat
        },

        success: function(msg) {
        	kegiatan_list_lokasi();
        },
        error: function(request, error) {
        }
    })
});

function kegiatan_list_lokasi() {
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_list_lokasi')?>",
        async: false,
        success: function(msg) {
            var html = '<option value="0">...</option>';
            for (var i = 0; i < msg.length; i++) {
                html += '<tr>' +
                '<option value="' + msg[i].lokasiid + '">' + msg[i].lokasi + '</option>';
            }
            $('#lokasiid').html(html);
        }
    });
}


$('#btnAdd_Pembicara').click(function() {
	var content=$('#pembicara').val();
	$.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_add2/pembicara') ?>",
        async: false,
        data: {
            content: content
        },

        success: function(msg) {
        	kegiatan_list_pembicara();
        },
        error: function(request, error) {
        }
    })
});

function kegiatan_list_pembicara() {
    $.ajax({
        dataType: "json",
        type: 'ajax',
        method: 'POST',
        url: "<?php echo base_url('kegiatan/modal_kegiatan_list_pembicara')?>",
        async: false,
        success: function(msg) {
            var html = '<option value="0">...</option>';
            for (var i = 0; i < msg.length; i++) {
                html += '<tr>' +
                '<option value="' + msg[i].pembicaraid + '">' + msg[i].pembicara + '</option>';
            }
            $('#pembicaraid').html(html);
        }
    });
}


</script>

</body>

</html>