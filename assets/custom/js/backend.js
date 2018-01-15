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
            { "data": "fname" },
            { "data": "lname" },
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
        "order": [[ 0, "desc" ]],
        "scrollX": true

    });

    $('#subscribers tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
        $('#del_btn').prop('disabled', !(subs.rows('.selected').data().length>0));
    } );

    $('#del_btn').click( function () {
        if(confirm('Are you sure you want to delete selected rows?')) { 
            var data = subs.rows('.selected').data();
            var new_data = [];
            $.each(data, function( index, value ) {
              console.log( "Adding object to array: " + value.id );
              new_data.push(value.id);
            });
            // Use Ajax to submit form data
            $.ajax({
                url: $('#site_url').val() + "api/subscribers/remove",
                type: 'DELETE',
                data: JSON.stringify(new_data),
                success: function(result) {
                    // ... Process the result ...
                    console.log('SUCCESS');
                },
                error: function(xhr, error) {
                    var e = JSON.parse(xhr.responseText);
                    alert(e['error']);
                }
            });
            subs.rows('.selected').remove().draw( false );
            $('#del_btn').prop('disabled', true);
            $("#refresh").click();
        }
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
            if($('#category option').length<=0) {
                $.getJSON($("#base_url").val()+"api/categories/all", function(json){
                    $('#category').empty();
                    //$('#category').append($('<option>').text("Select Category").attr('value', -1));
                    $.each(json, function(i, obj){
                        $('#category').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                });
            }
        }
    });

    $("#refresh").on('click', function() {
    	subs.ajax.reload();
    });

    /*jslint unparam: true, regexp: true */
    /*global window, $ */
    $(function () {
        'use strict';
        // Change this to the location of your server-side upload handler:
        var url = window.location.hostname === 'localhost' ?
                    'http://localhost/email_ms/admin/fileupload' : 'https://elm.solidnode.net/admin/fileupload',
            uploadButton = $('<button/>')
                .addClass('btn btn-primary btn-xs pull-right')
                .prop('disabled', false)
                .text('Import')
                .on('click', function () {
                    /*
                    var $this = $(this),
                        data = $this.data();
                    $this
                        .off('click')
                        .text('Abort')
                        .on('click', function () {
                            $this.remove();
                            data.abort();
                        });
                    data.submit().always(function () {
                        $this.remove();
                    });
                    */
                });
        $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            autoUpload: true,
            acceptFileTypes: /(\.|\/)(csv|txt)$/i,
            maxFileSize: 999000
        }).on('fileuploadadd', function (e, data) {
            data.context = $('<div/>').appendTo('#files');
            $.each(data.files, function (index, file) {
                var node = $('<p/>')
                        .append($('<span/>').text(file.name));
                if (!index) {
                    node
                        //.append('<br>')
                        .append(uploadButton.clone(true).data(data));
                }
                node.appendTo(data.context);
            });
        }).on('fileuploadprocessalways', function (e, data) {
            var index = data.index,
                file = data.files[index],
                node = $(data.context.children()[index]);
            if (file.preview) {
                node
                    .prepend('<br>')
                    .prepend(file.preview);
            }
            if (file.error) {
                node
                    .append('<br>')
                    .append($('<span class="text-danger"/>').text(file.error));
            }
            if (index + 1 === data.files.length) {
                data.context.find('button')
                    .text('Import')
                    .prop('disabled', !!data.files.error);
            }
        }).on('fileuploadprogressall', function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }).on('fileuploaddone', function (e, data) {
            $.each(data.result.files, function (index, file) {
                if (file.url) {
                    var link = $('<a>')
                        .attr('target', '_blank')
                        .prop('href', file.url);
                    $(data.context.children()[index])
                        .wrap(link);
                } else if (file.error) {
                    var error = $('<span class="text-danger"/>').text(file.error);
                    $(data.context.children()[index])
                        .append('<br>')
                        .append(error);
                }
            });
        }).on('fileuploadfail', function (e, data) {
            $.each(data.files, function (index) {
                var error = $('<span class="text-danger"/>').text('File upload failed.');
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            });
        }).prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
    });

    /*
    if($('#edit_category option').length<=0) {
        $.getJSON($("#base_url").val()+"api/categories/all", function(json){
            $('#edit_category').empty();
            //$('#category').append($('<option>').text("Select Category").attr('value', -1));
            $.each(json, function(i, obj){
                $('#edit_category').append($('<option>').text(obj.name).attr('value', obj.id));
            });
        });
    }

    var data = subs.row(this).data();
    $('#edit_category').val(data.category).change();
    $('#edit_fname').val(data.fname);
    $('#edit_lname').val(data.lname);
    $('#edit_email_add').val(data.email);
    $('#edit_address').val(data.address);
    $('#edit_contact_no').val(data.contact_no);

    $('#edit_btn').prop('disabled', false);
    */
});