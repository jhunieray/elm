<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<div class="box-title hidden-xs hidden-sm">
					<i class="fa fa-users"></i> Subscribers
				</div>
				<div class="box-title hidden-md hidden-lg text-center">
					<i class="fa fa-users"></i>
				</div>
				<div class="box-tools pull-right hidden-xs hidden-sm">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new"><i class="fa fa-plus"></i> Add New</button>
					<!--<button class="btn btn-sm btn-warning btn-flat menu_btn" id="edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit"><i class="fa fa-edit"></i> Update</button>-->
					<button class="btn btn-sm btn-warning btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_import" aria-expanded="false" aria-controls="panel_import"><i class="fa fa-upload"></i> Import</button>
					<button class="btn btn-sm btn-info btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_export"><i class="fa fa-download"></i> Export</button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn" id="del_btn" disabled=""><i class="fa fa-trash"></i> Remove Selected</button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh"><i class="fa fa-refresh"></i> Refresh</button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters"><i class="fa fa-filter"></i> Filters</button>
				</div>
				<div class="box-tools hidden-md hidden-lg">
					<button class="btn btn-sm btn-success btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new" title="Add New"><i class="fa fa-plus"></i> </button>
					<!--<button class="btn btn-sm btn-warning btn-flat menu_btn" id="edit_btn" disabled="" type="button" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit" title="Update"><i class="fa fa-edit"></i> </button>-->
					<button class="btn btn-sm btn-warning btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_import" aria-expanded="false" aria-controls="panel_import" title="Import"><i class="fa fa-upload"></i> </button>
					<button class="btn btn-sm btn-info btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_export" title="Export"><i class="fa fa-download"></i> </button>
					<button class="btn btn-sm btn-danger btn-flat menu_btn" id="del_btn" title="Remove Selected" disabled=""><i class="fa fa-trash"></i> </button>
					<button class="btn btn-sm btn-default btn-flat menu_btn" id="refresh" title="Refresh"><i class="fa fa-refresh"></i> </button>
					<button class="btn btn-sm btn-primary btn-flat menu_btn" type="button" data-toggle="collapse" data-target="#panel_filters" aria-expanded="false" aria-controls="panel_filters" title="Filters"><i class="fa fa-filter"></i> </button>
				</div>
			</div>
			<div class="box-body">
				<div class="collapse custom_panel" id="panel_create_new">
					<?= form_open('api/subscribers/add', array('id' => 'form_add_subscriber')) ?>
				  	<div class="box box-success">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Category</label>
				  						<select class="form-control" name="category" id="category" autofocus="">
				  						</select>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">First Name</label>
				  						<input type="text" id="fname" name="fname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Last Name</label>
				  						<input type="text" id="lname" name="lname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Email Address</label>
				  						<input type="email" id="email_add" name="email_add" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Contact No</label>
				  						<input type="text" id="contact_no" name="contact_no" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Address</label>
				  						<input type="text" id="address" name="address" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  			</div>
				  			<div class="row">
				  				<div class="col-md-12 text-right">
				  					<p id="create_new_msg" class="pull-left"></p>
				  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_create_new" aria-expanded="false" aria-controls="panel_create_new">Close</button>
				  					<button id="save_subscriber" type="submit" class="btn btn-flat btn-success">Save</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_edit">
					<?= form_open('api/subscribers/edit', array('id' => 'form_edit_subscriber')) ?>
				  	<div class="box box-warning">
				  		<div class="box-body">
				  			<div class="row">
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Category</label>
				  						<select class="form-control" name="category" id="edit_category" autofocus="">
				  						</select>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">First Name</label>
				  						<input type="text" id="edit_fname" name="fname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Last Name</label>
				  						<input type="text" id="edit_lname" name="lname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Email Address</label>
				  						<input type="email" id="edit_email_add" name="email_add" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Contact No</label>
				  						<input type="text" id="edit_contact_no" name="contact_no" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-2">
				  					<div class="form-group">
				  						<label class="form-label">Address</label>
				  						<input type="text" id="edit_address" name="address" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  			</div>
				  			<div class="row">
				  				<div class="col-md-12 text-right">
				  					<input type="hidden" id="id" name="id" />
				  					<p id="edit_msg" class="pull-left"></p>
				  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_edit" aria-expanded="false" aria-controls="panel_edit">Close</button>
				  					<button id="save_subscriber_edit" type="submit" class="btn btn-flat btn-warning">Save</button>
				  				</div>
				  			</div>
				  		</div>
				  	</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_import">
				  	<?= form_open('api/subscribers/edit', array('id' => 'form_edit_subscriber')) ?>
				  	<div class="row">
				  		<div class="col-md-6">
						  	<div class="box box-default">
						  		<div class="box-body">
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
											    <!-- The fileinput-button span is used to style the file input field as button -->
											    <center>
												    <span class="btn btn-success fileinput-button">
												        <i class="glyphicon glyphicon-plus"></i>
												        <span>Add files...</span>
												        <!-- The file input field used as target for the file upload widget -->
												        <input id="fileupload" type="file" name="files[]" multiple accept=".csv,text/plain">
												    </span>
												</center>
											    <br>
											    <br>
											    <!-- The global progress bar -->
											    <div id="progress" class="progress">
											        <div class="progress-bar progress-bar-success"></div>
											    </div>
											    <!-- The container for the uploaded files -->
											    <div id="files" class="files"></div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12 text-right">
						  					<p id="import_img" class="pull-left"></p>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						</div>
						<idv class="col-md-6">
						  	<div class="box box-info">
						  		<div class="box-body">
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
											    <div class="panel panel-default">
											        <div class="panel-heading">
											            <h3 class="panel-title">Demo Notes</h3>
											        </div>
											        <div class="panel-body">
											            <ul>
											                <li>The maximum file size for uploads in this demo is <strong>999 KB</strong> (default file size is unlimited).</li>
											                <li>Only image files (<strong>JPG, GIF, PNG</strong>) are allowed in this demo (by default there is no file type restriction).</li>
											                <li>Uploaded files will be deleted automatically after <strong>5 minutes or less</strong> (demo files are stored in memory).</li>
											                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="https://github.com/blueimp/jQuery-File-Upload/wiki/Browser-support">Browser support</a>).</li>
											                <li>Please refer to the <a href="https://github.com/blueimp/jQuery-File-Upload">project website</a> and <a href="https://github.com/blueimp/jQuery-File-Upload/wiki">documentation</a> for more information.</li>
											                <li>Built with the <a href="http://getbootstrap.com/">Bootstrap</a> CSS framework and Icons from <a href="http://glyphicons.com/">Glyphicons</a>.</li>
											            </ul>
											        </div>
											    </div>
						  					</div>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						</idv>
					</div>
				  	<?= form_close() ?>
				</div>
				<div class="collapse custom_panel" id="panel_export">
				  	<h1>EXPORT</h1>
				</div>
				<div class="collapse custom_panel" id="panel_filters">
				  	<h1>FILTERS</h1>
				</div>
				<table id="subscribers" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style="white-space: nowrap;">ID</th>
							<th style="white-space: nowrap;">Category</th>
							<th style="white-space: nowrap;">Email</th>
							<th style="white-space: nowrap;">First Name</th>
							<th style="white-space: nowrap;">Last Name</th>
							<th style="white-space: nowrap;">Address</th>
							<th style="white-space: nowrap;">Contact</th>
							<th style="white-space: nowrap;">Date Added</th>
							<th style="white-space: nowrap;">Date Updated</th>
							<th style="white-space: nowrap;">Status</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>
