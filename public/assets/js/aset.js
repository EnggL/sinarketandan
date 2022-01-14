$(document).ready(function(){
	$('.table-history-aset').DataTable({
		"dom": 'f'
		// scrollX: true
	});

	$('#btnAddAset').click(function(){
		ajaxGetModalAddAset();
	});

	$('#btnAddHistoryAset').click(function(){
		ajaxGetModalAddHistoryAset();
	});
});

function ajaxGetModalAddAset()
{
	loading_screen.show();
	$.ajax({
		url : base_url+"aset-pemuda/modal/add",
		type : 'get',
		success : function(data) {
			$('#modalAset .modal-title').text('Tambah Aset');
			$('#modalAset .modal-body').html(data);
			$('#modalAset').modal('show');
			loading_screen.hide();
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}

$(document).on('click', '.showDetailAset', function(){
	let id = $(this).attr('id');
	ajaxViewDetailAset(id);
});

function ajaxViewDetailAset(id)
{
	loading_screen.show();
	$.ajax({
		url : base_url+"aset-pemuda/modal/view",
		type : 'get',
		data: {
			id: id
		},
		success : function(data) {
			$('#modalAset .modal-title').text('Lihat Aset');
			$('#modalAset .modal-body').html(data);
			$('#modalAset').modal('show');
			loading_screen.hide();
		},
		error : function(request,error)
		{
			console.log(request);
			loading_screen.hide();
		}
	});
}

$(document).on('click', '.btn-delAset', function(){
	var id = $(this).attr('id');
	var aset = $(this).attr('data-aset');

	Swal.fire({
		title: 'Hapus Aset '+aset+'?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace(base_url+"aset-pemuda/delete/"+id);
		}
	});
});

$(document).on('click', '.btn-editAset', function(){
	var id = $(this).attr('id');
	ajaxGetModalEditAset(id);
});

function ajaxGetModalEditAset(id)
{
	loading_screen.show();
	$.ajax({
		url : base_url+"aset-pemuda/modal/edit/"+id,
		type : 'get',
		success : function(data) {
			$('#modalAset .modal-title').text('Edit Aset');
			$('#modalAset .modal-body').html(data);
			$('#modalAset').modal('show');
			loading_screen.hide();
		},
		error : function(request,error)
		{
			console.log(request);
			loading_screen.hide();
		}
	});
}

function ajaxGetModalAddHistoryAset() {
	loading_screen.show();
	$.ajax({
		url : base_url+"aset-pemuda/modal/history/add/",
		type : 'get',
		success : function(data) {
			$('#modalAset .modal-title').text('Tambah History Peminjaman Aset');
			$('#modalAset .modal-body').html(data);
			$('#modalAset').modal('show');

			initBasicSelect2OnModal();
			initBasicDatePicker();
			initIcheck();

			loading_screen.hide();
		},
		error : function(request,error)
		{
			console.log(request);
			loading_screen.hide();
		}
	});
}

$(document).on('ifChecked', '#belum-kembali', function(){
	$('#pinjam-sampai').removeClass('basicDatePicker');
	$('#pinjam-sampai').val();
	$('#pinjam-sampai').attr('disabled', true);
});

$(document).on('ifUnchecked', '#belum-kembali', function(){
	$('#pinjam-sampai').addClass('basicDatePicker');
	$('#pinjam-sampai').attr('disabled', false);
});

$(document).on('click', '.editHistoryPinjam', function(){
	let id = $(this).attr('data-id');
	ajaxGetModalEditHistoryAset(id);
});

function ajaxGetModalEditHistoryAset(id) {
	loading_screen.show();
	$.ajax({
		url : base_url+"aset-pemuda/modal/history/edit/"+id,
		type : 'get',
		success : function(data) {
			$('#modalAset .modal-title').text('Edit History Peminjaman Aset');
			$('#modalAset .modal-body').html(data);
			$('#modalAset').modal('show');
			$('#belum-kembali').iCheck('update');

			initBasicSelect2OnModal();
			initBasicDatePicker();
			initIcheck();

			loading_screen.hide();
		},
		error : function(request,error)
		{
			console.log(request);
			loading_screen.hide();
		}
	});
}

$(document).on('click', '.btnDelHistoryAset', function(){
	var id = $(this).attr('id');

	Swal.fire({
		title: 'Hapus History Aset ini?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace(base_url+"aset-pemuda/modal/history/delete/"+id);
		}
	});
});