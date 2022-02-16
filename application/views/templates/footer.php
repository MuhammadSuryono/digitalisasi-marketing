<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Marketing Research Indonesia(MRI) 2019</span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->
</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('auth/logout') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/responsive.bootstrap4.min.js"></script>
<script src="https://unpkg.com/pdfobject@2.2.4/pdfobject.min.js"></script>

<script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/filereader.js"></script>
    <!-- Using jquery version: -->

        <!-- <script type="text/javascript" src="js/jquery.js"></script> -->
        <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/qrcodelib.js"></script>
        <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/webcodecamjquery.js"></script>
        <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/mainjquery.js"></script>

   <!--  <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/qrcodelib.js"></script>
    <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/webcodecamjs.js"></script>
    <script type="text/javascript" src="<?php echo base_url('scan/'); ?>js/main.js"></script>
 -->
<!-- Page level custom scripts -->
<script src="<?php echo base_url('assets/'); ?>js/demo/datatables-demo.js"></script>


<script src="<?php echo base_url('assets/'); ?>js.js"></script>

<script>
 $(document).ready(function(){

       $('#datepicker1').datepicker({
            uiLibrary: 'bootstrap4',
            icons: { rightIcon: '<i class="fas fa-calendar-day"></i>' }
        });

       $('#datepicker2').datepicker({
            uiLibrary: 'bootstrap4',
            icons: { rightIcon: '<i class="fas fa-calendar-day"></i>' }
        });
       $('#datepicker3').datepicker({
            uiLibrary: 'bootstrap4',
            icons: { rightIcon: '<i class="fas fa-calendar-day"></i>' }
        });

      $('#templateP').change(function(){
          var id = $(this).val();

          $.ajax({
              type : 'ajax',
              method : 'GET',
              url : '<?php echo base_url('projectPlan/template') ?>',
              dataType : 'json',
              data : {id:id},
              success:function(data){
                $('#projectPlan').val(data);
              }
          });

      });

      var i=1;
      $('#add').click(function(){
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="file" id="file" name="filedata[]" placeholder="Enter your Name" class="form-control name_list" /></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
      });

      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });

    $('#btnEmail').click(function(){
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengirim...');
        $('#pesan').html('').removeClass();
        $('#btnEmail').prop('disabled', true);
        var id           = $('input[name=nomor_rfq]').val();
        var nama_project = $('input[name=nama_project]').val();
        var nama_customer = $("#cus option:selected").text();
        var text = $('#cus option').toArray().map(item => item.text).join();
        var jenis_surat  = $('#jenis_surat').val();
        var email        = $('textarea[name=email]').val();

        // TAMBAHAN & EDIT BY ADAM SANTOSO
        if(email.trim() == '' || jenis_surat.trim() == ''){
          Swal.fire({
            title: 'Gagal Kirim Email!',
            text: 'Form email info belum diisi atau jenis surat belum dipilih',
            icon: 'error',
            confirmButtonText: 'Tutup',
            willClose: function(){ $('#btnEmail').prop('disabled', false); $('#btnEmail').html('<i class="fas fa-envelope-open-text"></i> Kirim Email'); }
          })
        }else{
          $.ajax({
             type : 'ajax',
             method : 'POST',
             url : '<?php echo base_url() ?>rfq/kirimEmail',
             data : {id:id, nama_project:nama_project, nama_customer:nama_customer, jenis_surat:jenis_surat, email:email},
             dataType : 'json',
             success: function(data){
               $('#btnEmail').prop('disabled', false);
  			        //console.log(data);
                if(data == 'terkirim'){
                  $('#pesan').html('<i class="fas fa-check"></i> Email berhasil terkirim').addClass('text-success');
                }else{
                  $('#pesan').html('<i class="fas fa-times"></i> Email gagal terkirim').addClass('text-danger');
                }
                $('#btnEmail').html('<i class="fas fa-envelope-open-text"></i> Kirim Email');
             }
          });
        }
        //

    });

	  $('#show').click(function(){
		  $('#show-data').html('');
		  var usaha = $('#usaha').val();
		  var mt = $('#methodology').val();
		   $.ajax({
                url:"<?php echo base_url('email/getCus')?>",
                type:"POST",
        				dataType: 'json',
                data:{usaha:usaha, mt:mt},
                success:function(hasil)
                {
					var ht ='';

					for(i=0;i<hasil.length;i++){
						ht += '<tr><td><input type="checkbox" id="testaja" name="id_cus[]" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
					}

					$('#show-data').append(ht);
                }
           });

	  });

    $('#showriway').click(function(){
		  $('#show-datariway').html('');
		  var usaha = $('#usaha').val();
		  // var mt = $('#methodology').val();
		   $.ajax({
                url:"<?php echo base_url('email/testriway')?>",
                type:"POST",
        				dataType: 'json',
                data:{usaha:usaha},
                success:function(hasil)
                {
					var ht ='';

					for(i=0;i<hasil.length;i++){
						ht += '<tr><td><input type="checkbox" id="testaja" name="testaja[]" class="get_value" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
					}

					$('#show-datariway').append(ht);
                }
           });
	  });

    $('#showriway1').click(function(){
		  $('#show-datariway1').html('');
		  //var usaha = $('#testaja').val();

      var languages = [];
           $('.get_value').each(function(){
                if($(this).is(":checked"))
                {
                     languages.push($(this).val());
                }
           });
          //  languages = languages.toString();

      // console.log(languages);
		  // var mt = $('#methodology').val();
		   $.ajax({
                url:"<?php echo base_url('email/testriway1')?>",
                type:"POST",
        				dataType: 'json',
                data:{languages:languages},
                success:function(hasil)
                {
					var ht ='';

					for(i=0;i<hasil.length;i++){
						ht += '<tr><td><input type="checkbox" id="testaja1" name="testaja1[]" class="get_value1" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
					}

					$('#show-datariway1').append(ht);
                }
           });
	  });

    $('#showriway2').click(function(){
		  //$('#show-datariway1').html('');
		  //var usaha = $('#testaja').val();

      var languages = [];
           $('.get_value1').each(function(){
                if($(this).is(":checked"))
                {
                     languages.push($(this).val());
                }
           });
          //  languages = languages.toString();

        console.log(languages);
		  // var mt = $('#methodology').val();
		   $.ajax({
                url:"<?php echo base_url('email/testriway2')?>",
                type:"POST",
        				dataType: 'json',
                data:{languages:languages},
                success:function(hasil)
                {

                  $("#show-datariway1").empty();
                  var ht ='';

                  for(i=0;i<hasil.length;i++){
                    ht += '<tr><td><input type="checkbox" id="testaja1" class="get_value1" name="testaja1[]" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
                  }

                  $('#show-datariway1').append(ht);
                }
           });
	  });

    $('#addriway').click(function(){
		  //$('#show-datariway1').html('');
		  //var usaha = $('#testaja').val();

      var languages = [];
           $('.get_value1').each(function(){
                if($(this).is(":checked"))
                {
                     languages.push($(this).val());
                }
           });
          //  languages = languages.toString();

        console.log(languages);
		  // var mt = $('#methodology').val();
		   $.ajax({
                url:"<?php echo base_url('email/tambahriway')?>",
                type:"POST",
        				dataType: 'json',
                data:{languages:languages},
                success:function(hasil)
                {

                  $("#show-datariway1").empty();
                  var ht ='';

                  for(i=0;i<hasil.length;i++){
                    ht += '<tr><td><input type="checkbox" id="testaja1" class="get_value1" name="testaja1[]" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
                  }

                  $('#show-datariway1').append(ht);
                }
           });
	  });

    $('#cekAllriway').click(function(){
      checkboxes = document.getElementsByName('testaja[]');
      for(var i=0, n=checkboxes.length;i<n;i++){
        checkboxes[i].checked = this.checked;
      }
    });

    $('#cekAllriway1').click(function(){
      checkboxes = document.getElementsByName('testaja1[]');
      for(var i=0, n=checkboxes.length;i<n;i++){
        checkboxes[i].checked = this.checked;
      }
    });

    $('#id_menu').change(function(){
      $("#variable").empty();
      var nilai = $('#id_menu').val();

      console.log(nilai);

      if(nilai == 1){
        var ht = '<tr><td>1.</td><td>[nama project]</td></tr>';
        document.getElementById("variable").innerHTML = ht;
        // $('#variable').append(ht);
      } else if (nilai == 2){
        var ht = '<tr><td>1.</td><td>[nama project]</td></tr><tr><td>2.</td><td>[nomor rfq]</td></tr><tr><td>3.</td><td>[nama customer]</td></tr>';
        $('#variable').append(ht);
      } else {
        var ht = '<tr><td>1.</td><td>[nomor rfq]</td></tr>';
        $('#variable').append(ht);
      }

    });

$('#plus').click(function(){
 	var data = $('#tesnyaiway').serialize();
  // console.log(data);
   	$.ajax({
 		dataType:"json",
 		method:'POST',
 		url:"<?= base_url('email/testajadulu'); ?>",
 		data: {
       data: data
    },
 		success: function(hasil){
       console.log(hasil);
      //  var ht ='';
  		// 	for(i=0;i<hasil.length;i++){
			// 			ht += '<tr><td>Test Test</td></tr>';
			// 		}

			// 		$('#show-data1').append(ht);
  		// }
  	}});
  //  var bahasa = [];
  //   $('.test1').each(function(){
  //               if($(this).is(":checked"))
  //               {
  //                    bahasa.push($(this).val());
  //               }
  //          });

  //          $.ajax({
  //               url:"<?//php echo base_url('email/testajadulu') ?>",
  //               method:"POST",
  //               data:{bahasa:bahasa},
  //               success:function(data){
  //                  var ht ='';

	// 				for(i=0;i<data.length;i++){
  //           ht += '<tr><td>Test Test</td></tr>';
	// 				}

	// 				$('#show-data').append(ht);
  //               }
  //          });

 });


  //   $('#plus').click(function(){
	// 	var data = $('#testaja').val();
	// 	$.ajax({
	// 		type: 'POST',
	// 		url: "<?//php echo base_url('email/subemail')?>",
	// 		data: data,
	// 		success: function() {
	// 			$('#show-data1').load("<?//php echo base_url('email/tampil')?>");
	// 		}
	// 	});
	// });

    // $('#plus').click(function(){
		//   $('#show-data1').html('');
		//   var usaha = $('#usaha').val();
		//   var mt = $('#methodology').val();
		//    $.ajax({
    //             url:"<?//php echo base_url('email/getCus')?>",
    //             type:"POST",
    //     				dataType: 'json',
    //             data:{usaha:usaha, mt:mt},
    //             success:function(hasil)
    //             {
		// 			var ht ='';

		// 			for(i=0;i<hasil.length;i++){
		// 				ht += '<tr><td><input type="checkbox" id="testaja" name="id_cus[]" value="'+hasil[i].id_customer +'"></td><td>'+hasil[i].nama_customer +'</td><td>'+hasil[i].nama_perusahaan +'</td><td>'+hasil[i].email1 +'</td></tr>';
		// 			}

		// 			$('#show-data1').append(ht);
    //             }
    //        });

	  // });


    $('#cekAll').click(function(){
      checkboxes = document.getElementsByName('id_cus[]');
      for(var i=0, n=checkboxes.length;i<n;i++){
        checkboxes[i].checked = this.checked;
      }
    });


	  $('#alasan-gagal').hide();
	  $('#status').change(function(){
		  var status = $('#status').val();
		  if(status == 1){
			  $('#id-gagal').val('');
			  $('#masukan').val('');
			  $('#alasan-gagal').hide();
		  }else if(status == 2){
			$('#alasan-gagal').show();
		  }
	  });

	  var status = $('#status').val();

	  if(status ==2){
		  $('#alasan-gagal').show();
	  }

    console.log(location.href.substring(0, location.href.lastIndexOf('/')+1));
    $('#accordionSidebar a[href~="'+location.href+'"]').addClass('active');
    $('#accordionSidebar a[href~="'+location.href+'"]').parents('div .collapse').addClass('show');
    $('#accordionSidebar a[href~="'+location.href+'"]').parents('li').addClass('active');

    $(".formattedNumberField").on('keyup', function(){
      if($(this).val()==''){
        $(this).val('0');
      }

      var n = parseInt($(this).val().replace(/\D/g,''),10);
      $(this).val(n.toLocaleString(), true);

    });




    $("#alert-target").click(function () {
      toastr["info"]("I was launched via jQuery!")
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })


	//var judul = $('input[name^=id_cus]:checked').map(function(idx, elem){
		//return $(elem).val();
	//});

 });

// HIDE SHOW DIV master plan
$(document).ready(function(){
  $("button").click(function(){
    $("#masterplan1").fadeIn(3000);
  });
});


 </script>

</body>

</html>
