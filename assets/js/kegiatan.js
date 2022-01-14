console.log("kegiatan Loaded");

$(document).ready(function(){
	$('#btnDelKegiatan').click(function(){
		var id = $(this).val();
		var kegiatan = $(this).attr('kegiatan');

		Swal.fire({
			title: 'Hapus Kegiatan '+kegiatan+'?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!'
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.replace(base_url+"kegiatan/delete/kegiatan/"+id);
			}
		});
	});

	$('#btnPresensi').click(function(){
		$('#modalPresensi').modal('show');
	});

	$('#slc_peserta').select2({
		dropdownParent: $('#modalPresensi'),
		theme: "bootstrap-5",
		placeholder: 'Pilih Salah Satu!',
		ajax: {
			url: base_url+"kegiatan/ajax/peserta",
			dataType: 'json',
			delay: 250,
			data: function (params) {
				return {
					q: params.term,
					id_kegiatan: id_kegiatan
				};
			},
			processResults: function (data, params) {
				return {
					results: $.map(data, function(obj) {
						console.log(obj.id_peserta);
						return {
							id: obj.id_peserta,
							text: obj.nama
						};
					})
				};
			},
			cache: true
		},
	});
});


$(document).on('ifChecked', '.chkAllPeserta', function(){
	$('.chkPeserta').iCheck('check');
});
$(document).on('ifUnchecked', '.chkAllPeserta', function(){
	$('.chkPeserta').iCheck('uncheck');
});

$(document).on('ifChecked', '#chkTidakTentu', function(){
	$('#waktuSelesai').attr('disabled', true);
});
$(document).on('ifUnchecked', '#chkTidakTentu', function(){
	$('#waktuSelesai').attr('disabled', false);
});

$(document).on('click', '.removeImageKegiatan', function(){
	var id = $(this).attr('id');
	var img = $(this).attr('src');

	Swal.fire({
		title: 'Hapus Foto Ini?',
		text: "You won't be able to revert this!",
		imageUrl: img,
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			ajaxDeleteImageKegiatan(id);
		}
	});
});

function ajaxDeleteImageKegiatan(id)
{
	loading_screen.show();
	$.ajax({
		url : base_url+"kegiatan/delete/image",
		type : 'post',
		data : {
			id: id
		},
		success : function(data) {
			window.location.reload();
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
			loading_screen.hide();
		}
	});
}

$(document).on('click', '.removeSaranKegiatan', function(){
	var id = $(this).attr('id');
	var text = $(this).text();

	Swal.fire({
		title: 'Hapus Saran Ini?',
		text: text,
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
		if (result.isConfirmed) {
			ajaxDeleteSaranKegiatan(id);
		}
	});
});

function ajaxDeleteSaranKegiatan(id)
{
	loading_screen.show();
	$.ajax({
		url : base_url+"kegiatan/delete/saran",
		type : 'post',
		data : {
			id: id
		},
		success : function(data) {
			window.location.reload();
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
			loading_screen.hide();
		}
	});
}

$(document).on('click', '#btnPresensiSekarang', function(){
	var peserta = $('#slc_peserta').val();
	console.log(peserta);

	if (!peserta) {
		Swal.fire(
			'Oops..',
			'Harap lengkapi form!',
			'error'
			);
	}else{
		ajaxDoPresensi(peserta);
	}
});

function ajaxDoPresensi(peserta)
{
	if(typeof id_kegiatan === 'undefined') return false;

	loading_screen.show();
	$.ajax({
		url : base_url+"kegiatan/presensi",
		type : 'post',
		data : {
			id: peserta,
		},
		success : function(data) {
			if(data.error){
				swalAlert(
					'Error',
					data.desc,
					'error'
					);
			}else{
				swalAlert(
					'Berhasil Presensi',
					"",
					'success',
					true
					);
			}

			loading_screen.hide();
		},
		error : function(request,error)
		{
			alert("Request: "+JSON.stringify(request));
			loading_screen.hide();
		}
	});
}

function swalAlert(title = '', html = '', icon = 'error', reload = false)
{
	Swal.fire({
		title: title,
		html: html,
		icon: icon,
		confirmButtonColor: '#3085d6',
	}).then((result) => {
		if (result.isConfirmed) {
			if(reload)
				window.location.reload();
		}
	});
}

$(document).on('click', '.approvePresensi', function(){
	var peserta = $(this).attr('peserta');
	var id = $(this).attr('data-id');
	var waktu = $(this).text();

	$('#namaPeserta').text(peserta);
	$('#btnApprove').val(id);
	$('#Waktu_presensi').daterangepicker({
		singleDatePicker: true,
		timePicker: true,
		startDate: waktu,
		autoUpdateInput: true,
		showDropdowns: true,
		timePicker24Hour: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm:ss'
		}
	});

	$('#modalApprove').modal('show');
});