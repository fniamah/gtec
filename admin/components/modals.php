<div class="modal fade" id="contact_upload" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog">
        <form method="post" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h6 class="modal-title">Import Contacts From File</h6>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <p style="text-align: center;">You can download sample file to know the format OR  Please select the file you wish to import.</p>
                            <p style="text-align: center;">Allowed XLSX, CSV, and XLX, Max size of 3MB</p>
                        </div>
                        <div class="col-md-6" align="right">
                            <a class="btn btn-lg btn-primary"><span class="icon icon-download10"></span>   Download Format</a>
                        </div>
                        <div class="col-md-6" align="left">
                            <label>
                                <input type="file" class="form-control" style="display:none" name="clogo"/>
                                <span><a class="btn btn-lg btn-success"><span class="icon-upload10"></span>   Upload Data</a></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </form><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<div id="loader" class="modal fade" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" style="width: 400px; height: 50px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <img src="assets/images/preview.gif" class="img-responsive" style="width: 200px; height: 180px;"/>
                    </div>
                    <div class="col-md-12" style="text-align: center;">
                        <p id="loadermsg"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="blank_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center" id="blank_msg">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="delete_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="deleteId" />
                    <input type="hidden" id="deleteTable" />
                    <div class="col-md-12" align="center">
                        <img src="../admin/assets/images/pnotify/warning.PNG" style="width: 80px; height: 80px;" class="img-responsive" />
                    </div>
                    <div class="col-md-12">
                        <p style="text-align: center; font-weight: bold; font-size: x-large">Are you sure?</p>
                        <p style="text-align: center; font-size: large">You won't be able to revert this!</p>
                    </div>
                    <div id="deletehide">
                        <div class="col-md-6" align="right"><button type="button" class="btn btn-success" onclick="deleteRecord()"/>Yes, delete it</div>
                        <div class="col-md-6" align="left"><button type="button" class="btn btn-danger"  data-dismiss="modal" />Cancel</div>
                    </div>
                    <div id="deleteloader" class="hidden">
                        <div class="col-md-12" align="center">
                            <img src="assets/images/spinner.gif" class="img-responsive" style="width: 50px; height: 50px;"/>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <p>Deleting record.....</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="reject_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <input type="hidden" id="rejectId" />
                    <input type="hidden" id="rejectTable" />
                    <input type="hidden" id="rejectStatus" />
                    <input type="hidden" id="rejectIsced" />
                    <input type="hidden" id="rejectProg" />
                    <div class="col-md-12" align="center">
                        <img src="../admin/assets/images/pnotify/warning.PNG" style="width: 80px; height: 80px;" class="img-responsive" />
                    </div>
                    <div class="col-md-12">
                        <p style="text-align: center; font-weight: bold; font-size: x-large" id="rejectMsg"></p>
                        <p style="text-align: center; font-size: large">You won't be able to revert this!</p>
                    </div>
                    <div class="col-md-12" style="margin-bottom: 20px;">
                        <label>Brief Note(Optional)</label>
                        <textarea id="rejectNote" rows="4" maxlength="150" class="form-control" placeholder="Brief Note (optional)"></textarea>
                    </div>
                    <div id="approveshow" class="hidden">
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <label>Accredited Date</label>
                            <input id="rejectaccdate" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                        </div>
                        <div class="col-md-12" style="margin-bottom: 20px;">
                            <label>Expiry Date</label>
                            <input id="rejectexpirydate" type="date" class="form-control" value="<?php echo date('Y-m-d'); ?>" />
                        </div>
                    </div>
                    <div id="rejecthide">
                        <div class="col-md-6" align="right"><button type="button" class="btn btn-success" onclick="rejectRecord()"/>Yes</div>
                        <div class="col-md-6" align="left"><button type="button" class="btn btn-danger"  data-dismiss="modal" />Cancel</div>
                    </div>
                    <div id="rejectloader" class="hidden">
                        <div class="col-md-12" align="center">
                            <img src="assets/images/spinner.gif" class="img-responsive" style="width: 50px; height: 50px;"/>
                        </div>
                        <div class="col-md-12" style="text-align: center;">
                            <p>Rejecting.....</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="alertt_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <img src="../admin/assets/images/pnotify/danger.png" style="width: 80px; height: 80px;" class="img-responsive" />
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <p style="text-align: center; font-size: medium" id="alertMsg" ></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="bulk_upload" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <strong id="uploadtitle"></strong>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-12" align="left" style="font-style: italic; font-size: small; ">Click on the link below to download the template, fill and upload using the form below</div>
                        <div class="col-md-12" align="left" id="filedownload"></div>
                    </div>
                    <div class="row" style="margin: 20px;">
                        <div class="col-md-4" align="right">Upload File</div>
                        <div class="col-md-8" align="left">
                            <input type="file" class="form-control" id="uploadFile" onchange="validateFile()"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12" align="center">
                            <img src="../admin/assets/images/loader.gif" style="width: 200px; height: 100px;" class="img-responsive" /><br/>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="success_modal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12" align="center">
                        <img src="../admin/assets/images/pnotify/success.png" style="width: 80px; height: 80px;" class="img-responsive" />
                    </div>
                    <div class="col-md-12">
                        <br/>
                        <p style="text-align: center; font-size: medium" id="successMsg" ></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
