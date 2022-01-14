console.log('anggota.js loaded');
$(document).ready(function(){
	$('#btnAddAnggota').click(function(){
		ajaxGetModalTambahAnggota();
	});
});

function ajaxGetModalTambahAnggota()
{
	$.ajax({
		url : base_url+"daftar_anggota/modal/add",
		type : 'get',
		success : function(data) {
			$('#modalAddAnggota .modal-body').html(data);
			initBasicSelect2OnModal();
			$('#modalAddAnggota').modal('show');
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}

$(document).on('click', '.edit-anggota', function(){
	var id = $(this).attr('id');
	ajaxGetModalEditAnggota(id);
});

function ajaxGetModalEditAnggota(id)
{
	$.ajax({
		url : base_url+"daftar_anggota/modal/edit",
		type : 'get',
		data: {
			id: id
		},
		success : function(data) {
			$('#modalAddAnggota .modal-body').html(data);
			initBasicSelect2OnModal();
			$('#modalAddAnggota').modal('show');
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}

$(document).on('click', '.btnDelAnggota', function(){
	var id = $(this).attr('id');
	var nama = $(this).attr('nama');

	Swal.fire({
		title: 'Hapus '+nama+'?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace(base_url+"daftar_anggota/delete?id="+id);
		}
	});
});