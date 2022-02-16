const flashData = $('.flash-data').data('flashdata');

if (flashData) {
	Swal({
		position: 'top',
		type: 'success',
		title: flashData,
		showConfirmButton: false,
		timer: 2000
	})
}

const flashData2 = $('.flash-data2').data('flashdata');

if (flashData2) {

    Swal({
        position: 'top',
        type: 'error',
        title: 'Oops...',
        text: flashData2,
				showConfirmButton: false,
				timer: 2000
    })

}

// tombol-hapus
$('.tombol-hapus').on('click', function (e) {

	e.preventDefault();
	const href = $(this).attr('href');

	Swal({
		title: 'Apakah anda yakin',
		text: "data akan dihapus",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Hapus Data!'
	}).then((result) => {
		if (result.value) {
			document.location.href = href;
		}
	})

});

//modal edit kota
$(document).ready(function () {
	$('#edit-data').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#kota').attr("value", div.data('kota'));
	});
	// TAMBAHAN ADAM SANTOSO
	$(".dataTable").on('click','.tombol-hapus', function (e) {
		e.preventDefault();
		const href = $(this).attr('href');

		Swal({
			title: 'Apakah anda yakin',
			text: "data akan dihapus",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Hapus Data!'
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
			}
		})
	});
});

//modal edit jabatan
$(document).ready(function () {
	$('#edit-jabatan').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#jabatan').attr("value", div.data('jabatan'));
	});
});

//modal edit dept
$(document).ready(function () {
	$('#edit-dept').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#dept').attr("value", div.data('dept'));
	});
});

//modal edit kota
$(document).ready(function () {
	$('#edit-data2').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#bidang').attr("value", div.data('bidang'));
		modal.find('#ket').attr("value", div.data('ket'));
	});
});

//model edit methodology

$(document).ready(function () {
	$('#edit-methodology').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#m').attr("value", div.data('m'));
		modal.find('#ket').attr("value", div.data('ket'));
	});
});

$(document).ready(function () {
	$('#edit-costing').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#id').attr("value", div.data('id'));
		modal.find('#gb1').val(div.data('gb1'));
		modal.find('#gb2').val(div.data('gb2'));
		modal.find('#ket').attr("value", div.data('ket'));
		modal.find('#st').attr("value", div.data('st'));
		modal.find('#jml').attr("value", div.data('jml'));
	});
});

$(document).ready(function () {
    var i = 1;

    $(".addrow").on("click", function () {

      $.ajax({
        url : 'carimethod',
        method : "POST",
        async : false,
        dataType : 'json',
        success: function(hasil) {

          var ht =`<li>
										<div class="form-group">
										<label for="user">Methodology</label>
											<select name="id_methodology`+i+`" class="form-control">`
											for (let j = 0; j < hasil.length; j++) {
												ht +=`<option value="`+hasil[j].id_methodology+`">`+hasil[j].methodology+` - `+hasil[j].keterangan+`</option>`
											}
							ht +=`</select>
										</div>
										<div class="col-md-1">
												<button class="ibtnDel btn-sm btn-danger"><i class="fas fa-minus"></i></button>
										</div>
										</li>`

        $(".umum").append(ht);

        $("#jmlkeranjangumum").attr('value', i);

        i++;

        $('.select2').select2()

      }

    })

  });



    $(".umum").on("click", ".ibtnDel", function (event) {
        $(this).closest("li").remove();
        i -= 1
    });


});
