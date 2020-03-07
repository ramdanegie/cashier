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

var t = $("#tablecustomer").dataTable({
	initComplete: function() {
		var api = this.api();
		$('#tablecustomer_filter input')
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

	ajax: {"url": "customer/get_customer", "type": "POST"},
	columns: [
		{
			"data": "id_customer",
			"orderable": false
		},
		
		{"data": "id_customer"},
		{"data": "customer_name"},
		{"data": "customer_phone"},
		{"data": "customer_address"},
	  
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

 $('#tablecustomer tbody').on('click', '.edit', function () {
	$id = $(this).attr('data-id');
	
	//alert($id);
	$("#modaledit").modal("show");
	$("#modal-body").load("customer/edit/"+$id); 
});




$('#cust_form').bootstrapValidator({
	// To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
	feedbackIcons: {
		valid: 'glyphicon glyphicon-ok',
		invalid: 'glyphicon glyphicon-remove',
		validating: 'glyphicon glyphicon-refresh'
	},
	fields: {
		name: {
			validators: {
					
					notEmpty: {
					message: 'Please Input Name...'
				}
			}
		},
		 phone: {
			validators: {
				 
				notEmpty: {
					message: 'Please Input Phone..'
				}
			}
		},
		address: {
			validators: {
				 
				notEmpty: {
					message: 'Please Input Address..'
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

