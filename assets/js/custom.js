$(document).ready(function(){
	$('.basicDataTable').DataTable();
	$('.basicDataTable-search').DataTable({
		"dom": 'f'
	});

	$('.modal').on('show.bs.modal', function(e) {
		window.location.hash = "modal";
	});

	$(window).on('hashchange', function (event) {
		if(window.location.hash != "#modal") {
			$('.modal').modal('hide');
		}
	});

	initBasicDatePicker();
	initBasicDatePickerTime();
	initBasicDatePickerTime2();
	initBasicSelect2OnModal();
	initIcheck();
});

function initBasicSelect2OnModal(elemen = '.select2Basic')
{
	var modal = $(elemen).closest('div.modal');
	$(elemen).select2({
		dropdownParent: modal,
		theme: "bootstrap-5"
	});
}

function initBasicDatePicker(elemen = '.basicDatePicker')
{
	$(elemen).daterangepicker({
		singleDatePicker: true,
		timePicker: false,
		showDropdowns: true,
		locale: {
			format: 'YYYY-MM-DD'
		}
	});
}

function initBasicDatePickerTime(elemen = '.basicDatePickerTime')
{
	$(elemen).daterangepicker({
		singleDatePicker: true,
		timePicker: true,
		showDropdowns: true,
		timePicker24Hour: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm'
		}
	});
}

function initBasicDatePickerTime2(elemen = '.basicDatePickerTime2')
{
	$(elemen).daterangepicker({
		singleDatePicker: true,
		timePicker: true,
		autoUpdateInput: true,
		showDropdowns: true,
		timePicker24Hour: true,
		locale: {
			format: 'YYYY-MM-DD HH:mm:ss'
		}
	});
}

function initIcheck(elemen = '.ick')
{
	$(elemen).iCheck({
		checkboxClass: 'icheckbox_square-green',
		radioClass: 'iradio_square-green'
	});
}


class LoadingScreen
{
	show()
	{
		let elemen = 
		`<div id="full-img-loading">

		</div>`
		$('body').append(elemen);
	}

	hide()
	{
		$('#full-img-loading').remove();
	}
}

const loading_screen = new LoadingScreen();

$(document).on('input', '.text-upper', function(){
	$(this).val($(this).val().toUpperCase());
});

$(document).on('submit', 'form', function(){
	setTimeout(function (){
		$('.disableOnSubmit').attr('disabled', true);
	}, 1)
});