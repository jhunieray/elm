/**
 * Scripts for Admin Panel
 */

$(document).ready(function() {
	console.log("Admin Panel");

    var active_panel = "";

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
        "scrollX": true,
        "lengthMenu": [100, 250, 500, 1000]

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
                }, 2000);
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

    $('#form_category').submit(function(e) {
        e.preventDefault();

        var serialize = $(this).serialize();
        
        $('#save_category').prop('disabled', true);
        $('#save_category').html('Loading...');
        $('#input_category').prop('disabled', true);
        // Use Ajax to submit form data
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: serialize,
            success: function(result) {
                // ... Process the result ...
                $('#save_category').prop('disabled', false);
                $('#save_category').html('Save');
                $('#input_category').prop('disabled', false);
                $(active_panel + ' select[id="category"]').append($('<option>').text($('#input_category').val()).attr('value', result));
                $(active_panel + ' select[id="category"]').val(result).change();
                $('#input_category').val('');
                $('#msg_category').text('Category Saved.');
                setTimeout(
                    function() {
                        $('#error_category').text('');
                        $('#msg_category').text('');
                        $('#close_category').click();
                    }, 1000
                );
                
            },
            error: function(error) {
                $('#error_category').text('There was an error processing your request.\n Errors found: '+error.error);
                $('#save_category').prop('disabled', false);
                $('#save_category').html('Save');
                $('#input_category').prop('disabled', false);
            }
        });
    });

    $('#form_list').submit(function(e) {
        e.preventDefault();

        var serialize = $(this).serialize();
        
        $('#save_list').prop('disabled', true);
        $('#save_list').html('Loading...');
        $('#input_list').prop('disabled', true);
        // Use Ajax to submit form data
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: serialize,
            success: function(result) {
                // ... Process the result ...
                $('#save_list').prop('disabled', false);
                $('#save_list').html('Save');
                $('#input_list').prop('disabled', false);
                $(active_panel + ' select[id="list"]').append($('<option>').text($('#input_list').val()).attr('value', result));
                $(active_panel + ' select[id="list"]').val(result).change();
                $('#input_list').val('');
                $('#msg_list').text('List Saved.');
                setTimeout(
                    function() {
                        $('#error_list').text('');
                        $('#msg_list').text('');
                        $('#close_list').click();
                    }, 1000
                );
                
            },
            error: function(error) {
                $('#error_list').text('There was an error processing your request.\n Errors found: '+error.error);
                $('#save_list').prop('disabled', false);
                $('#save_list').html('Save');
                $('#input_list').prop('disabled', false);
            }
        });
    });

    $(".menu_btn").click( function(e) {
        jQuery('.collapse').collapse('hide');

        if("#panel_create_new" == $(this).data('target')) {
            active_panel = "#panel_create_new";
            if($('#panel_create_new select[id="category"] option').length<=0) {
                $.getJSON($("#base_url").val()+"api/categories/all", function(json){
                    $('#panel_create_new select[id="category"]').empty();
                    $.each(json, function(i, obj){
                        $('#panel_create_new select[id="category"]').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                });
            }
            if($('#panel_create_new select[id="list"] option').length<=0) {
                $.getJSON($("#base_url").val()+"api/lists/all", function(json){
                    $('#panel_create_new select[id="list"]').empty();
                    $.each(json, function(i, obj){
                        $('#panel_create_new select[id="list"]').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                });
            }
        } else if("#panel_import" == $(this).data('target')) {
            active_panel = "#panel_import";
            if($('#panel_import select[id="category"] option').length<=0) {
                $.getJSON($("#base_url").val()+"api/categories/all", function(json){
                    $('#panel_import select[id="category"]').empty();
                    $.each(json, function(i, obj){
                        $('#panel_import select[id="category"]').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                });
            }
            if($('#panel_import select[id="list"] option').length<=0) {
                $.getJSON($("#base_url").val()+"api/lists/all", function(json){
                    $('#panel_import select[id="list"]').empty();
                    $.each(json, function(i, obj){
                        $('#panel_import select[id="list"]').append($('<option>').text(obj.name).attr('value', obj.id));
                    });
                });
            }
        }
    });

    $("#refresh").on('click', function() {
    	subs.ajax.reload();
    });

    var inputType = "string";
    var stepped = 0, rowCount = 0, errorCount = 0, firstError;
    var start, end;
    var firstRun = true;
    var maxUnparseLength = 10000;

    $('#fileupload').on('change', function() {
        $('#import_btn').prop('disabled', !$('#fileupload')[0].files.length)
    });

    $('#import_btn').click(function() {
        if ($(this).prop('disabled') == "true")
            return;

        stepped = 0;
        rowCount = 0;
        errorCount = 0;
        firstError = undefined;

        var config = buildConfig();

        // Allow only one parse at a time
        $(this).prop('disabled', true);

        if (!firstRun)
            console.log("--------------------------------------------------");
        else
            firstRun = false;

        if (!$('#fileupload')[0].files.length)
        {
            alert("Please choose at least one file to parse.");
            return enableButton();
        }

        $('#fileupload').parse({
            config: config,
            before: function(file, inputElem)
            {
                start = now();
                console.log("Parsing file...", file);
            },
            error: function(err, file)
            {
                console.log("ERROR:", err, file);
                firstError = firstError || err;
                errorCount++;
            },
            complete: function()
            {
                end = now();
                printStats("Done with all files");
            }
        });
    } );

    function printStats(msg)
    {
        if (msg)
            console.log(msg);
            console.log("       Time:", (end-start || "(Unknown; your browser does not support the Performance API)"), "ms");
            console.log("  Row count:", rowCount);
        if (stepped)
            console.log("    Stepped:", stepped);
            console.log("     Errors:", errorCount);
        if (errorCount)
            console.log("First error:", firstError);
    }



    function buildConfig()
    {
        return {
            delimiter: ',',
            //header: $('#header').prop('checked'),
            dynamicTyping: true,
            //skipEmptyLines: $('#skipEmptyLines').prop('checked'),
            //preview: parseInt($('#preview').val() || 0),
            //step: true,
            //encoding: $('#encoding').val(),
            worker: true,
            //comments: $('#comments').val(),
            complete: completeFn,
            error: errorFn,
            //download: inputType == "remote"
        };
    }

    function stepFn(results, parser)
    {
        stepped++;
        if (results)
        {
            if (results.data)
                rowCount += results.data.length;
            if (results.errors)
            {
                errorCount += results.errors.length;
                firstError = firstError || results.errors[0];
            }
        }
    }

    function completeFn(results)
    {
        end = now();

        if (results && results.errors)
        {
            if (results.errors)
            {
                errorCount = results.errors.length;
                firstError = results.errors[0];
            }
            if (results.data && results.data.length > 0)
                rowCount = results.data.length;
        }

        //printStats("Parse complete");
        //console.log("    Results:", results);
        var result = results.data;
        var skip_line = 0;
        var imported = 0;
        var txt = "";
        var response = [];

        result.forEach(function(item, index) {
            response.push(item);
            txt = 'Uploading '+(index+1)+' of '+result.length+': '+item[2]+'\n';
            console.log(txt);
            if(item.length==5) { // Change if necessary
                $.ajax({
                    url: $('#site_url').val() + "api/subscribers/add",
                    type: 'POST',
                    data: {
                        'category'  : $('#panel_import select[id="category"]').val(),
                        'fname'     : item[0], 
                        'lname'     : item[1],
                        'email_add' : item[2],
                        'contact_no': item[3],
                        'address'   : item[4]
                    },
                    success: function(res) {
                        // ... Process the result ...
                        console.log(res);
                        txt = item[2]+' uploaded successfully.\n';
                        console.log(txt);
                        imported++;
                    },
                    error: function(data) {
                        var responseText=JSON.parse(data.responseText);
                        txt = 'Error uploading '+item[2]+'. Errors found: '+responseText.error+'\n';
                        console.log(txt);
                        skip_line++;
                    },
                    complete: function() {
                        if(response.length  === result.length) {
                            txt = imported+' email(s) uploaded successfully. '+skip_line+' skipped.\n';
                            $('#panel_import p[id="upload_msg"]').text(txt).css("color","#00a65a");
                            response.push(item);
                            setTimeout(
                                function() {
                                    
                                    $('#panel_import select[id="category"] option:first').prop('selected', true);
                                    $('#panel_import select[id="list"] option:first').prop('selected', true);
                                    $('#fileupload').val('');
                                    $('#import_close').click();
                                }, 1000
                            );
                        }
                    }
                });
            } else {
                txt = 'Error: Malformed format.\n';
                console.log(txt);
                skip_line++;
            }

            if(response.length  === result.length) {
                txt = imported+' email(s) uploaded successfully. '+skip_line+' skipped.\n';
                $('#panel_import p[id="upload_msg"]').text(txt).css("color","#00a65a");
                response.push(item);
                setTimeout(
                    function() {
                        $('#panel_import select[id="category"] option:first').prop('selected', true);
                        $('#panel_import select[id="list"] option:first').prop('selected', true);
                        $('#fileupload').val('');
                        $('#import_close').click();
                    }, 1000
                );
            }
        });

        // icky hack
        setTimeout(enableButton, 100);
    }

    function errorFn(err, file)
    {
        end = now();
        console.log("ERROR:", err, file);
        enableButton();
    }

    function enableButton()
    {
        $('#import_btn').prop('disabled', false);
    }

    function now()
    {
        return typeof window.performance !== 'undefined'
                ? window.performance.now()
                : 0;
    }
});
