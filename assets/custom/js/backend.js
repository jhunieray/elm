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
		select:       true,
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
        /*
        "columnDefs": [ {
            "targets": 9,
            "data": null,
            "defaultContent": "<div class='btn-group'><button class='btn btn-warning btn-sm menu_btn' type='button' data-toggle='collapse' data-target='#panel_edit' aria-expanded='false' aria-controls='panel_edit'><i class='fa fa-edit'></i></button><button class='btn btn-danger btn-sm menu_btn' type='button' data-toggle='collapse' data-target='#panel_delete' aria-expanded='false' aria-controls='panel_delete'><i class='fa fa-trash'></i></button></div>"
        } ],
        */
        "order": [[ 0, "desc" ]]

    });

    $('#subscribers tbody').on( 'click', 'tr', function () {
        subs.rows().deselect();
        $(this).toggleClass('selected');
        
        var data = subs.row(this).data();
        $('#edit_category').val(data.category).change();
        $('#edit_fname').val(data.fname);
        $('#edit_lname').val(data.lname);
        $('#edit_email').val(data.email);
        $('#edit_address').val(data.address);
        $('#edit_contact_no').val(data.contact_no);

        $('#edit_btn').prop('disabled', false);
    } );

    $('#form_add_subscriber').submit(function(e) {
        e.preventDefault();

        var serialize = $(this).serialize();
        
        $('#save_subscriber').prop('disabled', true);
        $('#save_ethnicity').html('Loading...');
        $('#category').prop('disabled', true);
        $('#fname').prop('disabled', true);
        $('#lname').prop('disabled', true);
        $('#email_add').prop('disabled', true);
        $('#contact_no').prop('disabled', true);
        $('#address').prop('disabled', true);

        // Use Ajax to submit form data
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: serialize,
            success: function(result) {
                // ... Process the result ...

                // Enable Save Button
                $('#save_subscriber').prop('disabled', false);
                $('#save_subscriber').html('Save');

                // Enable Fields
                $('#category').prop('disabled', false);
                $('#fname').prop('disabled', false);
                $('#lname').prop('disabled', false);
                $('#email_add').prop('disabled', false);
                $('#contact_no').prop('disabled', false);
                $('#address').prop('disabled', false);

                // Reset Fields
                document.getElementById('form_add_subscriber').reset();

                $('#create_new_msg').text('Subscriber Saved Successfully.').attr('class', 'pull-left text-success');
                setTimeout( function() { 
                    $("#refresh").click();
                }, 3000);
            },
            error: function(xhr, error) {
                var e = JSON.parse(xhr.responseText);
                $('#create_new_msg').text('There was an error processing your request. '+e['error']).attr('class', 'pull-left text-danger');
                
                // Enable Save Button
                $('#save_subscriber').prop('disabled', false);
                $('#save_subscriber').html('Save');

                // Enable Fields
                $('#category').prop('disabled', false);
                $('#fname').prop('disabled', false);
                $('#lname').prop('disabled', false);
                $('#email_add').prop('disabled', false);
                $('#contact_no').prop('disabled', false);
                $('#address').prop('disabled', false);
            }
        });
    });

    $(".menu_btn").click( function(e) {
        jQuery('.collapse').collapse('hide');

        if("#panel_create_new" == $(this).data('target')) {
            $.getJSON($("#base_url").val()+"api/categories/all", function(json){
                $('#category').empty();
                //$('#category').append($('<option>').text("Select Category").attr('value', -1));
                $.each(json, function(i, obj){
                    $('#category').append($('<option>').text(obj.name).attr('value', obj.id));
                });
            });
        }
    });

    $("#refresh").on('click', function() {
    	subs.ajax.reload();
    });
});