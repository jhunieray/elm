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
			//category
			cat.ajax.reload();
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
            //delimiter: $('#delimiter').val(),
            //header: $('#header').prop('checked'),
            dynamicTyping: true,
            //skipEmptyLines: $('#skipEmptyLines').prop('checked'),
            //preview: parseInt($('#preview').val() || 0),
            step: true,
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

        printStats("Parse complete");
        console.log("    Results:", results);

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


				//Categories ................................................................
				var cat = $("#categories").DataTable( {
					select:       true,
			        "processing": true,
			        "ajax": {"url":$("#base_url").val()+"api/categories/all","dataSrc":""},
			        "columns": [
			        	{ "data": "id" },
			            { "data": "name" }
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

					$('#form_add_categories').submit(function(e) {
			        e.preventDefault();

			        var serialize = $(this).serialize();

			        $('#save_subscriber').prop('disabled', true);
			        $('#save_ethnicity').html('Loading...');
			        $('#category').prop('disabled', true);
			        $('#cname').prop('disabled', true);

							console.log($(this).attr('action'));
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
			                $('#cname').prop('disabled', false);

			                // Reset Fields
			                document.getElementById('form_add_categories').reset();

			                $('#create_new_msg').text('Category Saved Successfully.').attr('class', 'pull-left text-success');
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
			                $('#cname').prop('disabled', false);
			            }
			        });
			    });

					$('#categories tbody').on( 'click', 'tr', function () {
			        $(this).toggleClass('selected');
			        $('#cat_del_btn').prop('disabled', !(cat.rows('.selected').data().length>0));
							$('#cat_edit_btn').prop('disabled', !(cat.rows('.selected').data().length==1));
							$('#copy_btn').prop('disabled', !(cat.rows('.selected').data().length==1));
							console.log(cat.rows('.selected').data());
			    } );

					$('#cat_del_btn').click( function () {
			        if(confirm('Are you sure you want to delete selected rows?')) {
			            var data = cat.rows('.selected').data();
			            var new_data = [];
			            $.each(data, function( index, value ) {
			              console.log( "Adding object to array: " + value.id );
			              new_data.push(value.id);
			            });
			            // Use Ajax to submit form data
			            $.ajax({
			                url: $('#site_url').val() + "api/categories/remove",
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
			            cat.rows('.selected').remove().draw( false );
			            $('#cat_del_btn').prop('disabled', true);
			            $("#refresh").click();
			        }
			    } );

					$('#cat_edit_btn').click( function () {
								//set category name
								$('#edit_cname').val(cat.rows('.selected').data()[0].name);
								$('#id').val(cat.rows('.selected').data()[0].id);
					});

					$('#form_edit_categories').submit(function (e) {
						e.preventDefault();
						if(confirm('Are you sure you want to save changes?')) {
								var serialize = $(this).serialize();
								// Use Ajax to submit form data
								$.ajax({
										url: $('#site_url').val() + "api/categories/edit",
										type: 'POST',
										data: serialize,
										success: function(result) {
												// ... Process the result ...
												console.log('SUCCESS');
										},
										error: function(xhr, error) {
												var e = JSON.parse(xhr.responseText);
												alert(e['error']);
										}
								});
								$("#refresh").click();
						}
					});

					$('#copy_btn').click(function () {
						// this will copy the category
						var $temp = $("<input>");
					  $("body").append($temp);
					  $temp.val(cat.rows('.selected').data()[0].name).select();
					  document.execCommand("copy");
					  $temp.remove();
						console.log("df");
					});

});
