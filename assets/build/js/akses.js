$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
{
	return {
		"iStart": oSettings._iDisplayStart,
		"iEnd": oSettings.fnDisplayEnd(),
		"iLength": oSettings._iDisplayLength,
		"iTotal": oSettings.fnRecordsTotal(),
		"iFilteredTotal": oSettings.fnRecordsDisplay(),
		"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
		"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
	};
};

var t = $("#tableaccess").dataTable({
	initComplete: function() {
		var api = this.api();
		$('#tableaccess_filter input')
				.off('.DT')
				.on('keyup.DT', function(e) {
					if (e.keyCode == 13) {
						api.search(this.value).draw();
			}
		});
	},
	oLanguage: {
		sProcessing: "loading..."
	},
	processing		: true,
	serverSide		: true,
	bLengthChange	: false,

	ajax: {"url": "akses/get_access", "type": "POST"},
	columns: [
		{
			"data": "id",
			"orderable": false
		},
		
		{"data": "level"},
		{"data": "id_menu"},
	  
		{"data": "view"}
	],
	order: [[1, 'asc']],
	rowCallback: function(row, data, iDisplayIndex) {
		var info = this.fnPagingInfo();
		var page = info.iPage;
		var length = info.iLength;
		var index = page * length + (iDisplayIndex + 1);
		$('td:eq(0)', row).html(index);
	}
});

 $('#tableaccess tbody').on('click', '.edit', function () {
	$id = $(this).attr('data-id');
	
	//alert($id);
	$("#modaledit").modal("show");
	$("#modal-body").load("akses/edit/"+$id); 
});




$('#akses_form').bootstrapValidator({
	// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
	feedbackIcons: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		level: {
			validators: {
					
					notEmpty: {
					message: 'Please Choose Level...'
				}
			}
		},
		 id_menu: {
			validators: {
				 
				notEmpty: {
					message: 'Please Input Id Menu..'
				}
			}
		},
	   
		
	
	}
})

.on('success.form.bv', function(e) {
	$('#success_message').slideDown({ opacity: "show" }, "slow") // Do something ...
	$('#reg_form').data('bootstrapValidator').resetForm();

	// Prevent form submission
	e.preventDefault();

	// Get the form instance
	var $form = $(e.target);

	// Get the BootstrapValidator instance
	var bv = $form.data('bootstrapValidator');

	// Use Ajax to submit form data
	$.post($form.attr('action'), $form.serialize(), function(result) {
		console.log(result);
	}, 'json');
});

