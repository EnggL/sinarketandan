$(document).ready(function() {
	$('#btnAddUangKas').click(function(){
		ajaxGetModalAddUangKas();
	});
});

function ajaxGetModalAddUangKas()
{
	loading_screen.show();
	$.ajax({
		url : base_url+"uang_kas/modal/add",
		type : 'get',
		success : function(data) {
			$('#modalUangKas .modal-body').html(data);
			loading_screen.hide();
			initBasicDatePicker();
			$('#modalUangKas').modal('show');
		},
		error : function(request,error)
		{
			loading_screen.hide();
			alert("Request: "+JSON.stringify(request));
		}
	});
}

$(document).on('click', '.edit-kas', function(){
	var id = $(this).attr('id');
	ajaxGetModalEditUangKas(id);
});

function ajaxGetModalEditUangKas(id)
{
	if(!id) return false;

	loading_screen.show();
	$.ajax({
		url : base_url+"uang_kas/modal/edit",
		type : 'get',
		data: {
			id: id
		},
		success : function(data) {
			$('#modalUangKas .modal-body').html(data);
			loading_screen.hide();
			initBasicDatePicker();
			$('#modalUangKas').modal('show');
		},
		error : function(request,error)
		{
			loading_screen.hide();
			alert("Request: "+JSON.stringify(request));
		}
	});
}

$(document).on('click', '.btnDelKas', function(){
	var id = $(this).attr('data-id');
	var keterangan = $(this).attr('keterangan');

	Swal.fire({
		title: 'Hapus '+keterangan+'?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location.replace(base_url+"uang_kas/delete?id="+id);
		}
	});
});