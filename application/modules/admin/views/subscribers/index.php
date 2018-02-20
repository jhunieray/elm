<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-header with-border">
				<div class="box-title hidden-xs hidden-sm">
					<i class="fa fa-envelope"></i> Email Lists
				</div>
				<div class="box-title hidden-md hidden-lg text-center">
					<i class="fa fa-envelope"></i>
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
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">Category</label>
				  						<div class="input-group">
					  						<select class="form-control" name="category" id="category" autofocus="">
					  						</select>
					  						<span class="input-group-btn">
												<button id="add_category" type="button" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal_category">
								                    <i class="fa fa-plus"></i>
								                </button>
								            </span>
					  					</div>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">List</label>
				  						<div class="input-group">
					  						<select class="form-control" name="list" id="list" autofocus="">
					  						</select>
					  						<span class="input-group-btn">
												<button id="add_list" type="button" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal_list">
								                    <i class="fa fa-plus"></i>
								                </button>
								            </span>
					  					</div>
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">First Name</label>
				  						<input type="text" id="fname" name="fname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">Last Name</label>
				  						<input type="text" id="lname" name="lname" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">Email Address</label>
				  						<input type="email" id="email_add" name="email_add" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-3">
				  					<div class="form-group">
				  						<label class="form-label">Contact No</label>
				  						<input type="text" id="contact_no" name="contact_no" class="form-control" required />
				  						<span class="text-danger"></span>
				  					</div>
				  				</div>
				  				<div class="col-md-6">
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
				<div class="collapse custom_panel" id="panel_import">
				  	<div class="row">
				  		<div class="col-md-6">
						  	<div class="box box-default">
						  		<div class="box-body">
						  			<div class="row">
						  				<div class="col-md-4">
						  					<label>Category:</label>
						  				</div>
						  				<div class="col-md-8">
						  					<div class="input-group">
						  						<select class="form-control" name="category" id="category" autofocus="">
						  						</select>
						  						<span class="input-group-btn">
													<button id="add_category" type="button" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal_category">
									                    <i class="fa fa-plus"></i>
									                </button>
									            </span>
						  					</div>
					  						<span class="text-danger"></span>
						  				</div>
						  			</div>
						  			<hr/>
						  			<div class="row">
						  				<div class="col-md-4">
						  					<label>List:</label>
						  				</div>
						  				<div class="col-md-8">
						  					<div class="input-group">
						  						<select class="form-control" name="list" id="list" autofocus="">
						  						</select>
						  						<span class="input-group-btn">
													<button id="add_list" type="button" class="btn btn-flat btn-info" data-toggle="modal" data-target="#modal_list">
									                    <i class="fa fa-plus"></i>
									                </button>
									            </span>
						  					</div>
					  						<span class="text-danger"></span>
						  				</div>
						  			</div>
						  			<hr/>
						  			<div class="row">
						  				<div class="col-md-4">
						  					<label>Select File:</label>
						  				</div>
						  				<div class="col-md-8">
						  					<div class="form-group">
												<input id="fileupload" type="file" name="files[]" multiple accept=".csv,text/plain">
												<span class="text-danger" id="file_error"></span>
						  					</div>
						  				</div>
						  			</div>
						  			<hr/>
						  			<div class="row">
						  				<div class="col-md-7 text-left">
											<p class="text-danger" id="upload_msg"></p>
						  				</div>
						  				<div class="col-md-5 text-right">
											<button class="btn btn-primary btn-flat btn-sm" id="import_btn" disabled=""><i class="fa fa-upload fa-fw"></i> Import</button>
											<button class="btn btn-default btn-flat btn-sm" id="import_close" data-toggle="collapse" data-target="#panel_import" aria-expanded="false" aria-controls="panel_import"><i class="fa fa-times fa-fw"></i> Close</button>
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
											            <h3 class="panel-title">Notes</h3>
											        </div>
											        <div class="panel-body">
											            <ul>
											                <li>The maximum file size for uploads in this module is <strong>25 MB</strong>.</li>
											                <li>Only these files (<strong>CSV, TXT</strong>) are allowed to be imported.</li>
											                <li>Files are not stored in server. It only <strong>reads data</strong> from the file you selected.</li>
											                <li>You can <strong>drag &amp; drop</strong> files from your desktop on this webpage (see <a href="#">Browser support</a>).</li>
											                <li>Emails imported are automatically scrubbed in the suppression list. Emails found are ignored automatically. So does malformed formats.</li>
											                <li>Built with the <a href="http://papaparse.com/">Papa Parse 4</a>. The powerful, in-browser CSV parser for big boys and girls.</li>
											            </ul>
											        </div>
											    </div>
						  					</div>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						</div>
					</div>
				</div>
				<div class="collapse custom_panel" id="panel_export">
				  	<div class="row">
				  		<div class="col-md-8 col-md-offset-2">
						  	<?= form_open('api/export', array('id' => 'form_export', 'class' => 'form-horizontal')) ?>
						  	<div class="box box-info">
						  		<div class="box-body">
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
						  						<label class="form-label col-md-4">
						  							Categories: 
						  						</label>
						  						<div class="col-md-6">
								  					<select class="form-control select2" id="category" name="category[]" multiple="multiple" data-placeholder="Select Category" style="width: 100%;"></select>
							  						<span class="text-danger"></span>
							  					</div>
						  						<div class="col-md-2">
						  							<select class="form-control" name="category_operator">
						  								<option value="OR">ANY</option>
						  								<option value="AND">ALL</option>
						  							</select>
						  						</div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
						  						<label class="form-label col-md-4">Operator Match:</label>
						  						<div class="col-md-8">
								  					<label class="radio-inline">
								  						<input type="radio" value="OR" checked="" name="operator_match" /> OR
								  					</label>
								  					<label class="radio-inline">
								  						<input type="radio" value="AND" name="operator_match" /> AND
								  					</label>
							  						<span class="text-danger"></span>
							  					</div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
						  						<label class="form-label col-md-4">Lists:</label>
						  						<div class="col-md-6">
								  					<select class="form-control select2" name="list[]" id="list" multiple="multiple" data-placeholder="Select List" style="width: 100%;"></select>
							  						<span class="text-danger"></span>
							  					</div>
							  					<div class="col-md-2">
						  							<select class="form-control" name="list_operator">
						  								<option value="OR">ANY</option>
						  								<option value="AND">ALL</option>
						  							</select>
						  						</div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
						  						<label class="form-label col-md-4">File Format:</label>
						  						<div class="col-md-8">
								  					<label class="radio-inline">
								  						<input type="radio" value="csv" checked="" name="file_type" /> CSV
								  					</label>
								  					<label class="radio-inline">
								  						<input type="radio" value="txt" name="file_type" /> TXT
								  					</label>
							  						<span class="text-danger"></span>
							  					</div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12">
						  					<div class="form-group">
						  						<label class="form-label col-md-4">Archived (ZIP)?:</label>
						  						<div class="col-md-8">
								  					<div class="checkbox">
								  						<label>
									  						<input type="checkbox" value="1" name="compressed" />
									  					</label>
								  					</div>
							  						<span class="text-danger"></span>
							  					</div>
						  					</div>
						  				</div>
						  			</div>
						  			<div class="row">
						  				<div class="col-md-12 text-right">
						  					<p id="export_msg" class="pull-left"></p>
						  					<button type="button" class="btn btn-flat btn-default" data-toggle="collapse" data-target="#panel_export" aria-expanded="false" aria-controls="panel_export">Close</button>
						  					<button id="export_subscriber" type="submit" class="btn btn-flat btn-info">Export</button>
						  				</div>
						  			</div>
						  		</div>
						  	</div>
						  	<?= form_close() ?>
						</div>
					</div>
				</div>
				<div class="collapse custom_panel" id="panel_filters">
				  	<h1>FILTERS</h1>
				</div>
				<table id="subscribers" class="display" cellspacing="0" width="100%">
					<thead>
						<tr>
							<th style="white-space: nowrap;">ID</th>
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
<div class="modal fade" id="modal_category">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php echo form_open('api/categories/add', array('id' => 'form_category')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add Category</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="input_category" class="form-control" id="input_category" placeholder="Create Category" required autofocus />
		<span class="text-danger" id="error_category"></span>
      </div>
      <div class="modal-footer text-right">
      	<p class="pull-left text-success" id="msg_category"></p>
        <button type="button" id="close_category" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="save_category" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<div class="modal fade" id="modal_list">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <?php echo form_open('api/lists/add', array('id' => 'form_list')); ?>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><i class="fa fa-plus"></i> Add List</h4>
      </div>
      <div class="modal-body">
        <input type="text" name="input_list" class="form-control" id="input_list" placeholder="Create List" required autofocus />
		<span class="text-danger" id="error_list"></span>
      </div>
      <div class="modal-footer text-right">
      	<p class="pull-left text-success" id="msg_list"></p>
        <button type="button" id="close_list" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" id="save_list" class="btn btn-primary">Save</button>
      </div>
      <?php echo form_close(); ?>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
