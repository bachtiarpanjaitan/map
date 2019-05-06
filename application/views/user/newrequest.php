<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<div>
	<form class="row">
		<div class="col-md-6">
			<input type="hidden" id="requestdetailid" value="<?= $edit?$request['requestdetailid']:'' ?>">
			<input type="hidden" name="requesttypeid" id="requesttypeid" value="<?= $edit?$request['requesttypeid']:REQUESTTYPE_NEW ?>">
			<div class="form-group">
				<label for="">Jenis Unit</label>
				<select name="unittypeid" id="unittypeid" <?= $edit?"disabled":'' ?> class="form-control">
					<?php  foreach ($unittypes as $data) { ?>
					<option <?php if($edit && $data['unittypeid'] == $request['unittypeid']){ echo 'selected';}?>
						value="<?= $data['unittypeid'] ?>"><?= $data['unittypename'] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="">Blok</label>
				<select name="blokid" id="blokid" <?= $edit?"disabled":'' ?> class="form-control">
				<option value="">Silahkan Pilih Blok</option>
					<?php  foreach ($bloks as $data) { ?>
					<?php if($data['blokid'] == 0){continue;}  ?>
					<option <?php if($edit && $data['blokid'] == $request['blokid']){ echo 'selected';}?>
						value="<?= $data['blokid'] ?>"><?= $data['blokname'] ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<label for="">Unit</label>
				<select class="form-control" <?= $edit?"disabled":'' ?> id="unitid">
						
				</select>
			</div>
			<div class="form-group">
				<label for="">No. Handphone</label>
				<input type="number" id="telepon" <?= $edit?$request['telepon']:'' ?> class="form-control">
			</div>
		</div>
		<div class="col-md-6">
			<?php  if(!isCustomer()){ ?>
			<div class="form-group">
				<label for="">Pegawai</label>
				<select name="" id="username" class="form-control">
					<?php  foreach ($users as $data) { ?>
					<?php if($data['blokid'] == 0){continue;}  ?>
					<option <?php if($edit && $data['username'] == $request['username']){ echo 'selected';}?>
						value="<?= $data['username'] ?>"><?= $data['username'] ?></option>
					<?php } ?>
				</select>
			</div>
			<?php } ?>
			<div class="form-group">
				<label for="">Tanggal Masuk</label>
				<input type="text" name="checkindate" id="checkindate" value="<?= $edit?$request['checkindate']:'' ?>" class="datetimepicker form-control">
			</div>
			<div class="form-group">
				<label for="">Tanggal Keluar</label>
				<input type="text" name="checkoutdate" id="checkoutdate" value="<?= $edit?$request['checkoutdate']:'' ?>" class="datetimepicker form-control">
			</div>
			<div class="form-group">
				<div class="row col-md-12">
						<div class="col-md-6">
					<div class="form-group">
						<label for="">Surat Keterangan Nikah</label>
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
						<input type="hidden" id="images" value="<?= $edit?$request['marriagecertificate']:'' ?>">
					</div>
				</div>
				<div class="col-md-6">
					<label for="">Foto Terpilih</label>
					<div id="imgthumbnail"><img src="<?= ASSETS ?>request/<?= $edit?$request['marriagecertificate']: '' ?>" width="200" height="175px"
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
	$('.datetimepicker').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD'
	});

	var uunittype = null;
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

	$(document).ready(function () {
		$('#blokid').change(function (e) {
			$('#unitid').empty();
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/getunit') ?>",
				data: {
					'blokid': $('#blokid').val(),
				},
				dataType: "JSON",
				success: function (response) {
					if (response.success == true) {
						var content = "";
						var data = response.data;
						
						$.each(data, function (indexInArray, a) {
							if(uunittype == <?= REQUESTTYPE_NEW ?>){
								if(a.dormitory == 0){
									content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
								}
							}else{
								if(a.dormitory == 1){
									content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
								}
							}
						});

						$('#unitid').append(content);
					}
				}
			});
		});

		$('#unittypeid').change(function (e) {
			uunittype = $('#unittypeid').val();
		});

		$('#btnsave').click(function (e) {
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/saverequestdetail') ?>",
				data: {
					'requesttypeid': $('#requesttypeid').val(),
					'unittypeid': $('#unittypeid').val(),
					'blokid': $('#blokid').val(),
					'unitid': $('#unitid').val(),
					'telepon': $('#telepon').val(),
					'username': $('#username').val(),
					'checkindate': $('#checkindate').val(),
					'checkoutdate': $('#checkoutdate').val(),
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

		if( <?= $edit? 'true':'false' ?> ){
			$('#unitid').empty();
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/getunit') ?>",
				data: {
					'blokid': $('#blokid').val(),
				},
				dataType: "JSON",
				success: function (response) {
					if (response.success == true) {
						var content = "";
						var data = response.data;
						$.each(data, function (indexInArray, a) {
							if(a.unitid == '<?= $edit?$request['unitid']:'' ?>'){
								content += '<option selected value="' + a.unitid + '">' + a.unittitle + '</option>';
							}else{
								content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
							}
							
						});

						$('#unitid').append(content);
					}
				}
			});
		}

		
	});

</script>
