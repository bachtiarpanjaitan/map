<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<div>
	<form class="row">
		<div class="col-md-6">
			<input type="hidden" id="requestdetailid" value="<?= $edit?$request['requestdetailid']:'' ?>">
			<input type="hidden" name="requesttypeid" id="requesttypeid" value="<?= $edit?$request['requesttypeid']:REQUESTTYPE_MAINTENANCE ?>">
            <div class="form-group">
            <?php  if(!isCustomer()){ ?>
                <div class="form-group">
                    <label for="">User</label>
                    <select name="username" id="username" class="form-control">
                        <option value="">Pilih User</option>
                        <?php  foreach ($users as $data) { ?>
                        <?php if($data['blokid'] == 0){continue;}  ?>
                            <option <?php if($edit && $data['username'] == $request['username']){ echo 'selected';}?>
                            value="<?= $data['username'] ?>"><?= $data['username'] ?></option>
                        <?php } ?>
                    </select>
                </div>
			<?php } ?>
			</div>
			<div class="form-group">
				<label for="">Unit</label>
				<select class="form-control" id="unitid">
						
				</select>
			</div>
            <div class="form-group">
            <label for="">Deskripsi</label>
            <textarea name="description" class="form-control" id="description" rows="10"><?= $edit?$request['description']:'' ?></textarea>
            </div>
		</div>
		<div class="row ">
			<div class="form-group">
				<div class="row col-md-12">
						<div class="col-md-6">
					<div class="form-group">
						<label for="">Tambahkan Foto</label>
						<div class="dropzone dropzonearea" id="imageupload"></div>
						<div id="template">
							<div class="dz-preview dz-file-preview" id="dz-preview-template">
								<div class="dz-details">
									<div class="dz-filename"><span data-dz-name></span></div>
									<div class="dz-size" data-dz-size></div>
								</div>
								<div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
								<div class="dz-success-mark"><span></span></div>
								<div class="dz-error-mark"><span></span></div>
								<div class="dz-error-message"><span data-dz-errormessage></span></div>
							</div>
						</div>
						<input type="hidden" id="images" value="<?= $edit?$request['image_maintenance']:'' ?>">
					</div>
				</div>
				<div class="col-md-6">
					<label for="">Foto Terpilih</label>
					<div id="imgthumbnail"><img src="<?= ASSETS ?>request/<?= $edit?$request['image_maintenance']: '' ?>" width="200" height="175px"
						class="img img-responsive img-thumbnail" alt=""></div>
				</div>
				</div>
			</div>
		</div>
		<div class="col-md-12">
			<div>
				<button type="button" id="btnsave" class="btn btn-primary btn-lg">Save</button>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('user_footer.php') ?>
<script>
        Dropzone.autoDiscover = false;
		$("#imageupload").dropzone({
			url: "<?= site_url('api/uploadimage') ?>",
			paramName: 'base64',
			clickable: true,
			maxFiles: 1,
			uploadMultiple: false,
			autoProcessQueue: true,
			dictDefaultMessage: "Upload Gambar",
			previewTemplate: document.querySelector('#template').innerHTML,
			addRemoveLinks: true,
			acceptedFiles: 'image/*',
			maxFilesize: 2,
			accept: function (file, done) {
				reader = new FileReader();
				reader.onload = handleReaderLoad;
				reader.readAsDataURL(file);

				function handleReaderLoad(evt) {
					var file = evt.target.result;
					var name = file.name;
					var type = file.type;
					$.ajax({
						method: "POST",
						timeout: 2000,
						url: "<?= site_url('api/uploadimage') ?>",
						data: {
							base64: file,
							filename: name,
							filetype: type
						},
						success: function (response) {
							var val = JSON.parse(response);
							// console.log(val);
							if (val.success == true) {
								$('#imgthumbnail').empty();
								$('#images').val(val.filename);
								var content = '<img src="<?= ASSETS ?>request/' + val.filename +
									'" class="img-responsive img-thumbnail">';
								$('#imgthumbnail').append(content);
							}
						}
					});
				}
				done();
			}
		});

		$('#btnsave').click(function (e) {
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/savemaintenance') ?>",
				data: {
					'requesttypeid': $('#requesttypeid').val(),
					'unitid': $('#unitid').val(),
					'username': $('#username').val(),
                    'description':$('#description').val(),
					'images': $('#images').val(),
					'id': $('#requestdetailid').val(),
					'edit': <?= $edit?'1': '0' ?>
				},
				dataType: "JSON",
				success: function (response) {
					if (response.success == true) {
						swal('success', 'Data Berhasil Disimpan', 'success').then((val) => {
							location.reload();
						});
					} else {
						swal('error', response.message, 'error');
					}
				}
			});
		});	

        $('#username').change(function (e) {
			$('#unitid').empty();
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/getuserunit') ?>",
				data: {
					'username': $('#username').val(),
				},
				dataType: "JSON",
				success: function (response) {
					if (response.success == true) {
						var content = "";
						var data = response.data;
						
						$.each(data, function (indexInArray, a) {
							content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
						});

						$('#unitid').append(content);
					}
				}
			});
		});

        $('#unitid').empty();
        $.ajax({
            type: "POST",
            url: "<?= site_url('api/getuserunit') ?>",
            data: {
                'username': $('#username').val(),
            },
            dataType: "JSON",
            success: function (response) {
                if (response.success == true) {
                    var content = "";
                    var data = response.data;
                    $.each(data, function (indexInArray, a) {
                        content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
                    });

                    $('#unitid').append(content);
                }
            }
        });

</script>
