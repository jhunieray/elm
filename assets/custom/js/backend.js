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
        } ],
        "order": [[ 0, "desc" ]],
        scrollX:        true,
        scrollCollapse: true,
        fixedColumns:   {
            leftColumns: 1,
            rightColumns: 1
        }
    });

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