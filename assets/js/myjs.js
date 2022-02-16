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
	});
});