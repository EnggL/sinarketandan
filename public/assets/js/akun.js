/*JS tentang Akun*/
console.log('akun.js loaded');

$(document).ready(function(){
	$('#btn-add-akun').click(function(){
		getFormTambahAkun();
		$("#modalAddAkun #exampleModalLabel").text("Tambah Akun");
	});
});

$(document).on('click', '.btnDeleteAkun', function(){
	var urutan = $(this).val();
	var id = $('for-id').eq(urutan).text();
	var username = $(this).closest('td').attr('username');
	
	alertDeleteAkun(username, id);
});

$(document).on('click', '.btnEditAkun', function(){
	var urutan = $(this).val();
	var id = $('for-id').eq(urutan).text();
	var username = $(this).closest('td').attr('username');
	
	$("#modalAddAkun #exampleModalLabel").text("Edit Akun "+username);
	ajaxGetModalEditAkun(id);
});

function alertDeleteAkun(username, id)
{
	Swal.fire({
		title: 'Hapus Akun '+username+'?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			ajaxDeleteAkun(id);
		}
	});
}

function ajaxDeleteAkun(id)
{
	$.ajax({
		url : base_url+"akun/delete",
		type : 'post',
		data : {
			'id' : id
		},
		dataType:'json',
		success : function(data) {
			if (data.error)
				SwalAlert('Gagal!', "Error ketika Hapus Data", 'error');
			else
				alertSuccessDeleteThenReload();
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}

function alertSuccessDeleteThenReload()
{
	Swal.fire({
		title: 'Deleted!',
		text: "Your Data has been deleted!",
		icon: 'success',
	}).then((result) => {
		location.reload();
	})
}

function SwalAlert(title, html, icon)
{
	Swal.fire({
		title: title,
		text: html,
		icon: icon,
	});
}

function getFormTambahAkun()
{
	$.ajax({
		url : base_url+"akun/modal/add",
		type : 'get',
		success : function(data) {
			$('#modalAddAkun .modal-body').html(data);
			initBasicSelect2OnModal();
			$('#modalAddAkun').modal('show');
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}

function ajaxGetModalEditAkun(id)
{
	$.ajax({
		url : base_url+"akun/modal/edit",
		type : 'get',
		data: {
			id:id
		},
		success : function(data) {
			$('#modalAddAkun .modal-body').html(data);
			initBasicSelect2OnModal();
			$('#modalAddAkun').modal('show');
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
		}
	});
}