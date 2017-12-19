/**
 * Scripts for Admin Panel
 */

$(document).ready(function() {
	console.log("Admin Panel");
	
	// Sortable
	var el = $('.sortable');
	for (var i=0; i<el.length; i++) {
		var sortable = Sortable.create(el[i]);
	}

	// Spectrum color picker
	$(".colorpicker").spectrum({
		// options here
	});

	var subs = $("#subscribers").DataTable( {
		"processing": true,
        "ajax": $("#base_url").val()+"api/subscribers/all",
        "columns": [
        	{ "data": "id" },
            { "data": "category" },
            { "data": "email" },
            { "data": "name" },
            { "data": "address" },
            { "data": "contact_no" },
            { "data": "date_added" },
            { "data": "date_updated" },
            { "data": "status" }
        ],
        "columnDefs": [ {
            "targets": 9,
            "data": null,
            "defaultContent": "<div class='btn-group'><a class='btn btn-warning btn-sm'><i class='fa fa-edit'></i></a><a class='btn btn-danger btn-sm'><i class='fa fa-trash'></i></a></div>"
        } ]
    });

    $("#refresh").on('click', function() {
    	subs.ajax.reload();
    });
});