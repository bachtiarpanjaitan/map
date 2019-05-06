<?php include_once('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<style>
	body {
		text-align: center;
		background: #f2f6f8;
	}

	.img {
		position: absolute;
		z-index: 20;
	}

	#mapcontainer {
		display: inline-block;
		width: 1890;
		height: 1417;
		margin: 0 auto;
		position: relative;
		border: 5px solid black;
		border-radius: 10px;
		box-shadow: 0 5px 50px #333
	}

	#canvas {
		position: relative;
		z-index: 1;
	}

</style>
<div class="col col-md-12 scroll">
	<div id="mapcontainer" style="opacity: 1">
		<img class="img" usemap="#xmap" alt="canvas" width="1890" height="1417">
		<canvas id="canvas" style="background:url(<?= ASSETS ?>images/map.png)" width="1890" height="1417"
			style='border: 1px black solid;position:absolute;top:opx;left:opx; opacity="0.2"'></canvas>
	</div>
	<map id="xmap" name="xmap"></map>
</div>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
            
			<div class="modal-header">
				
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
            <h5 class="center-text" id="title"></h5>
             <div class="unitperblok row col-md-12"></div>
			<nav>
				<div class="nav nav-tabs nav-pills" id="nav-tab" role="tablist">
                    
					<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
						aria-controls="nav-home" aria-selected="true">Blok Info</a>
					<!-- <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
						aria-controls="nav-profile" aria-selected="false">Order Info</a> -->
					<a class="nav-item nav-link" id="nav-request-tab" data-id="1" data-toggle="tab" href="#nav-request" role="tab" aria-controls="nav-request" aria-selected="false">Request Unit</a>
                    <a class="nav-item nav-link" id="nav-maintenance-tab" data-id="2" data-toggle="tab" href="#nav-maintenance" role="tab" aria-controls="nav-maintenance" aria-selected="false">Request Maintenance</a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<!-- UNIT INFO -->
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<br>
					<div class="col-md-12">
						<input type="hidden" name="id" id="id">
						<div class="form-group">
							<label for="unittitle">Blok Name</label>
							<input type="text" name="unittitle" id="unittitle" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="description">Detail</label>
							<textarea name="description" id="description" class="form-control" cols="30" rows="10"
								readonly></textarea>
						</div>
						<?php if(isAdmin()){ ?>
						<div class="form-group">
							<button type="button" class="btn btn-warning editunit" data-value="0">Edit</button>
							<button type="button" id="saveunit" class="btn btn-primary">Save changes</button>
						</div>
						<?php } ?>
					</div>
				</div>
				<!-- END UNIT INFO -->
				<!-- ORDER INFO -->
				<!-- <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<br>
					<div class="col-md-12">
						<div class="form-group">
							<label for="fullname">FullName</label>
							<input type="text" name="fullname" id="fullname" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="email">Email</label>
							<input type="text" name="email" id="email" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="address">Address</label>
							<input type="text" name="address" id="address" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="phone">Phone</label>
							<input type="text" name="phone" id="phone" class="form-control" readonly>
						</div>
						<div class="form-group">
							<label for="info-remarks">Detail</label>
							<textarea name="info-remarks" id="info-remarks" class="form-control" cols="30" rows="10"
								readonly></textarea>
						</div>
						<?php if(isAdmin()){ ?>
						<div class="form-group">
							<button type="button" class="btn btn-warning editunit" data-value="0">Edit</button>
							<button type="button" id="saveorder" class="btn btn-primary">Save changes</button>
						</div>
						<?php } ?>

					</div>
				</div> -->
				<!-- END ORDER INFO -->

				<!-- UNIT REQUEST -->
				<div class="tab-pane fade show" id="nav-request" role="tabpanel" aria-labelledby="nav-request-tab">
					<br>
					<div class="container container-fluid">
						<form class="row">
							<div class="col-md-6">
								<input type="hidden" id="requestdetailid"
									value="<?= $edit?$request['requestdetailid']:'' ?>">
								<input type="hidden" name="requesttypeid" id="requesttypeid"
									value="<?= $edit?$request['requesttypeid']:REQUESTTYPE_NEW ?>">
								<div class="form-group">
									<label for="">Jenis Unit</label>
									<select name="unittypeid" id="unittypeid" class="unittypeid form-control">
                                        <option value="">Pilih Jenis Unit</option>
										<?php  foreach ($unittypes as $data) { ?>
										<option
											<?php if($edit && $data['unittypeid'] == $request['unittypeid']){ echo 'selected';}?>
											value="<?= $data['unittypeid'] ?>"><?= $data['unittypename'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<!-- <label for="">Blok</label> -->
									<select name="blokid" id="blokid" class="form-control" style="display:none">
										<option value="">Silahkan Pilih Blok</option>
										<?php  foreach ($bloks as $data) { ?>
										<?php if($data['blokid'] == 0){continue;}  ?>
										<option
											<?php if($edit && $data['blokid'] == $request['blokid']){ echo 'selected';}?>
											value="<?= $data['blokid'] ?>"><?= $data['blokname'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Unit</label>
									<select class="form-control unitid" id="unitid" >

									</select>
								</div>
								<!-- <div class="form-group">
									<label for="">No. Handphone</label>
									<input type="number" id="telepon" <?= $edit?$request['telepon']:'' ?>
										class="form-control">
								</div> -->
							</div>
							<div class="col-md-6">
								<?php  if(!isCustomer()){ ?>
								<div class="form-group">
									<label for="">Pegawai</label>
									<select name="" id="username" class="form-control">
										<?php  foreach ($users as $data) { ?>
										<?php if($data['blokid'] == 0){continue;}  ?>
										<option
											<?php if($edit && $data['username'] == $request['username']){ echo 'selected';}?>
											value="<?= $data['username'] ?>"><?= $data['username'] ?></option>
										<?php } ?>
									</select>
								</div>
								<?php } ?>
								<div class="form-group">
									<label for="">Tanggal Masuk</label>
									<input type="text" name="checkindate" id="checkindate"
										value="<?= $edit?$request['checkindate']:'' ?>"
										class="datetimepicker form-control">
								</div>
								<div class="form-group">
									<label for="">Tanggal Keluar</label>
									<input type="text" name="checkoutdate" id="checkoutdate"
										value="<?= $edit?$request['checkoutdate']:'' ?>"
										class="datetimepicker form-control">
								</div>
								<div class="form-group">
									<div class="row col-md-12">
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Surat Keterangan Nikah</label>
												<div class="dropzone imageupload dropzonearea" id="imageupload"></div>
												<div id="template">
													<div class="dz-preview dz-file-preview" id="dz-preview-template">
														<div class="dz-details">
															<div class="dz-filename"><span data-dz-name></span></div>
															<div class="dz-size" data-dz-size></div>
														</div>
														<div class="dz-progress"><span class="dz-upload"
																data-dz-uploadprogress></span></div>
														<div class="dz-success-mark"><span></span></div>
														<div class="dz-error-mark"><span></span></div>
														<div class="dz-error-message"><span data-dz-errormessage></span>
														</div>
													</div>
												</div>
												<input type="hidden" id="images" class="cimages"
													value="<?= $edit?$request['marriagecertificate']:'' ?>">
											</div>
										</div>
										<div class="col-md-6">
											<label for="">Foto Terpilih</label>
											<div id="imgthumbnail" class="imgthumbnail"><img
													src="<?= ASSETS ?>request/<?= $edit?$request['marriagecertificate']: '' ?>"
													width="1500" height="125px" class="img img-responsive"
													alt=""></div>
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
				</div>
				<!-- END UNIT INFO -->
                
                <div class="tab-pane fade show" id="nav-maintenance" role="tabpanel" aria-labelledby="nav-maintenance-tab">
                   <br>
					<div class="container container-fluid">
						<form class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="">Jenis Unit</label>
									<select name="unittypeid" id="mainunittypeid" class="unittypeid form-control">
                                        <option value="">Pilih Jenis Unit</option>
										<?php  foreach ($unittypes as $data) { ?>
										<option
											<?php if($edit && $data['unittypeid'] == $request['unittypeid']){ echo 'selected';}?>
											value="<?= $data['unittypeid'] ?>"><?= $data['unittypename'] ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="">Unit</label>
									<select class="form-control unitid" id="unitid" >

									</select>
								</div>
							</div>
							<div class="col-md-6">
								<?php  if(!isCustomer()){ ?>
								<div class="form-group">
									<label for="">Pegawai</label>
									<select name="" id="mainusername" class="form-control">
										<?php  foreach ($users as $data) { ?>
										<?php if($data['blokid'] == 0){continue;}  ?>
										<option
											<?php if($edit && $data['username'] == $request['username']){ echo 'selected';}?>
											value="<?= $data['username'] ?>"><?= $data['username'] ?></option>
										<?php } ?>
									</select>
								</div>
								<?php } ?>
								<div class="form-group">
									<div class="row col-md-12">
										<div class="col-md-6">
											<div class="form-group">
												<label for="">Lampiran Foto</label>
												<div class="dropzone imageupload dropzonearea" id="imageupload"></div>
												<div id="template">
													<div class="dz-preview dz-file-preview" id="dz-preview-template">
														<div class="dz-details">
															<div class="dz-filename"><span data-dz-name></span></div>
															<div class="dz-size" data-dz-size></div>
														</div>
														<div class="dz-progress"><span class="dz-upload"
																data-dz-uploadprogress></span></div>
														<div class="dz-success-mark"><span></span></div>
														<div class="dz-error-mark"><span></span></div>
														<div class="dz-error-message"><span data-dz-errormessage></span>
														</div>
													</div>
												</div>
												<input type="hidden" id="images" class="cimages"
													value="<?= $edit?$request['image_maintenance']:'' ?>">
											</div>
										</div>
										<div class="col-md-6">
											<label for="">Foto Terpilih</label>
											<div id="imgthumbnail" class="imgthumbnail"><img
													src="<?= ASSETS ?>request/<?= $edit?$request['image_maintenance']: '' ?>"
													width="1500" height="125px" class="img img-responsive"
													alt=""></div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div>
									<button type="button" id="reqbtnsave" class="btn btn-primary btn-lg">Save</button>
								</div>
							</div>
						</form>
					</div>
                </div>
			</div>
			<div class="modal-footer">

			</div>
		</div>
	</div>
</div>
<?php include_once('user_footer.php') ?>
<script>
    var blok = "";
	$(document).ready(function () {

		function clear() {
			$('#title').empty();
			$('#unittitle').attr('readonly');
			$('#description').attr('readonly');
			$('#unitid').empty();
			$('.unitid').empty();
			$('.unitperblok').empty();
		}
		var canvas = document.getElementById('canvas');
		$.ajax({
			type: "POST",
			url: "<?= site_url('api/getunits') ?>",
			data: {

			},
			dataType: "JSON",
			success: function (response) {
                // console.log(response);
				if (response.success == true) {
					var content = "";
					for (var i = 0; i < Object.keys(response.units).length; i++) {
						drawUnit(response.units[i]);
						content += '<area class="objunit" data-desc="' +
							response.units[i]['description'] +
							'" data-title="' + response.units[i]['blokname'] +
							'" data-coords="' + response.units[i]['blokcoords'] +
							'" style="color: green" data-toggle="modal" data-target="#modal" shape="poly" coords="' +
							response.units[i]['blokcoords'] +
							'" title="' + response.units[i]['blokname'] +
							'" data-blok="' + response.units[i]['blokid'] +
							'" data-dormitory="' + response.units[i]['dormitory'] +
							'" alt="obj-' + i + '" />';
					}
					$('#xmap').append(content);
					$('.objunit').click(function (e) {
						clear();
                        $('.unittypeid').attr('disabled', 'disabled');
						var title = $(this).data('title');
						blok = $(this).data('blok');
						if ('<?= getuserlogin('blokid') ?>' != '<?= BLOK_ADMIN ?>') {
							if (blok != '<?= getuserlogin('blokid') ?>') {
								swal('error', 'Anda Tidak Diizinkan mengakses Informasi ini',
									'error');
								return false;
							}
						}
						var desc = $(this).data('desc');
						var statusname = $(this).data('statusname');
                        var blokid = $(this).data('blok');
                        var dormitory = $(this).data('dormitory');
                        // console.log(blokid);
						$('#title').append(title);
						$('#unittitle').val(title);
						$('#description').val(desc);
                        $('#blokid').val(blokid);
                        // console.log(dormitory);
                        if(dormitory == '0'){
                            $('.unittypeid').val(<?= UNITTYPE_REGULER ?>);
                        }else{
                            $('.unittypeid').val(<?= UNITTYPE_DORMITORY ?>);
                        }

                        $.ajax({
                            type: "POST",
                            url: "<?= site_url('api/getunitperblok') ?>",
                            data: {
                                'blokid': blokid
                            },
                            dataType: "JSON",
                            success: function (response) {
                                var append = "";
                                var append2 = "";

                                for(var i = 0; i < Object.keys(response.data).length; i++)
                                {
                                    console.log(response);
                                    if(response.data[i]['statusid'] == <?= STATUS_ALLOWORDER ?>){
                                        append += '<div class="center-text" style="margin: 10px;padding:5px;width: 50px; height:50px;background-color:gainsboro" data-toggle="tooltip" title="'+ response.data[i]['statusname'] +'"><small>'+ response.data[i]['unittitle'] +'</small></div>'
                                    }else if(response.data[i]['statusid'] == <?= STATUS_ONBOOKING ?>){
                                        append += '<div class="center-text" style="margin: 10px;padding:5px;width: 50px; height:50px;background-color:green" data-toggle="tooltip" title="'+ response.data[i]['statusname'] +'"><small>'+ response.data[i]['unittitle'] +'</small></div>'
                                    }else if(response.data[i]['statusid'] == <?= STATUS_MAINTENANCE ?>){
                                        append += '<div class="center-text" style="margin: 10px;padding:5px;width: 50px; height:50px;background-color:brown" data-toggle="tooltip" title="'+ response.data[i]['statusname'] +'"><small>'+ response.data[i]['unittitle'] +'</small></div>'
                                    }
                                   
                                }

                                for(var i = 0; i < Object.keys(response.data).length; i++)
                                {
                                    append2 += '<option value="'+ response.data[i]['unitid'] +'">'+response.data[i]['unittitle']+'</option>'
                                }

                                $('.unitperblok').append(append);
                                $('.unitid').append(append2);
                            }
                        });
					});
				}
			}
		});

		$('.editunit').click(function (e) {
			var value = $('.editunit').data('value');
			if (value == "0") {
				$('.editunit').attr('data-value', '1');
				$('#unittitle').removeAttr('readonly');
				$('#description').removeAttr('readonly');
				$('#fullname').removeAttr('readonly');
				$('#email').removeAttr('readonly');
				$('#address').removeAttr('readonly');
				$('#info-remarks').removeAttr('readonly');
				$('#phone').removeAttr('readonly');
			}

			if (value == "1") {
				$('.editunit').attr('data-value', '0');
				$('#unittitle').attr('readonly', 'readonly');
				$('#description').attr('readonly', 'readonly');
				$('#fullname').attr('readonly', 'readonly');
				$('#email').attr('readonly', 'readonly');
				$('#address').attr('readonly', 'readonly');
				$('#info-remarks').attr('readonly', 'readonly');
				$('#phone').attr('readonly', 'readonly');
			}

		});

		function drawUnit(data) {
			// console.log(data);
			if (canvas.getContext) {
				var ctx = canvas.getContext('2d');
				var arraycoords = data['blokcoords'].split(',');
				ctx.beginPath();
				ctx.globaAlpha = "0";
				// switch (data['statusid']) {
				// 	case "1":
				// 		ctx.fillStyle = '#00c853';
				// 		break;
				// 	case "2":
				// 		ctx.fillStyle = '#ff9800';
				// 		break;
				// 	case "3":
				// 		ctx.fillStyle = '#2196f3';
				// 		break;
				// 	case "4":
				// 		ctx.fillStyle = '#d50000';
				// 		break;
				// 	default:
				// 		ctx.fillStyle = '#000';
				// }

				// draw image in canvas
				ctx.moveTo(arraycoords[0], arraycoords[1]);
				ctx.lineTo(arraycoords[2], arraycoords[3]);
				ctx.lineTo(arraycoords[4], arraycoords[5]);
				ctx.lineTo(arraycoords[6], arraycoords[7]);
				ctx.closePath();
				var obj = ctx.fill();
				// console.log(ctx);
			}
		};

		$('#saveorder').click(function (e) {
			if ($('#fullname').val() == "") {
				swal('error', 'Fullname tidak boleh kosong', 'error');
				return false;
			}
			if ($('#email').val() == "") {
				swal('error', 'Email tidak boleh kosong', 'error');
				return false;
			}
			if ($('#phone').val() == "") {
				swal('error', 'Telepon tidak boleh kosong', 'error');
				return false;
			}
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/saveorder') ?>",
				data: {
					fullname: $('#fullname').val(),
					email: $('#email').val(),
					phone: $('#phone').val(),
					address: $('#address').val(),
					remarks: $('#info-remarks').val(),
					unitid: $('#unitid').val()
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

		$('#saveunit').click(function (e) {
			if ($('#unittitle').val() == "") {
				swal('error', 'Nama Unit tidak boleh kosong', 'error');
				return false;
			}
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/editunit') ?>",
				data: {
					id: $('#unitid').val(),
					title: $('#unittitle').val(),
					description: $('#description').val()
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

	});

</script>

<script>
	$('.datetimepicker').bootstrapMaterialDatePicker({
		format: 'YYYY-MM-DD'
	});

	var uunittype = null;
	Dropzone.autoDiscover = false;
		$(".imageupload").dropzone({
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
								$('.imgthumbnail').empty();
								$('.cimages').val(val.filename);
								var content = '<img src="<?= ASSETS ?>request/' + val.filename +
									'" class="img-responsive img-thumbnail">';
								$('.imgthumbnail').append(content);
							}
						}
					});
				}
				done();
			}
		});

	$(document).ready(function () {
		$('#unittypeid').change(function (e) {
            // console.log($('#blokid').val());
			$('.unitid').empty();
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
                                console.log(a);
								if(a.dormitory == 0){
									content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
								}
							}else{
								if(a.dormitory == 1){
									content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
								}
							}
						});

						$('.unitid').append(content);
					}
				}
			});
		});

		$('#unittypeid').change(function (e) {
			uunittype = $('.unittypeid').val();
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
					'images': $('.cimages').val(),
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

		$('#reqbtnsave').click(function (e) {
			$.ajax({
				type: "POST",
				url: "<?= site_url('api/saverequestdetail') ?>",
				data: {
					'requesttypeid': $('#requesttypeid').val(),
					'unittypeid': $('#mainunittypeid').val(),
					'blokid': $('#blokid').val(),
					'unitid': $('#unitid').val(),
					'telepon': $('#telepon').val(),
					'username': $('#mainusername').val(),
					'images': $('.cimages').val(),
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

		// if( <?= $edit? 'true':'false' ?> ){
		// 	$('#unitid').empty();
		// 	$.ajax({
		// 		type: "POST",
		// 		url: "<?= site_url('api/getunit') ?>",
		// 		data: {
		// 			'blokid': $('#blokid').val(),
		// 		},
		// 		dataType: "JSON",
		// 		success: function (response) {
		// 			if (response.success == true) {
		// 				var content = "";
		// 				var data = response.data;
		// 				$.each(data, function (indexInArray, a) {
		// 					if(a.unitid == '<?= $edit?$request['unitid']:'' ?>'){
		// 						content += '<option selected value="' + a.unitid + '">' + a.unittitle + '</option>';
		// 					}else{
		// 						content += '<option value="' + a.unitid + '">' + a.unittitle + '</option>';
		// 					}
							
		// 				});

		// 				$('#unitid').append(content);
		// 			}
		// 		}
		// 	});
		// }

		
	});

</script>

<script>
    $('.unittypeid').change(function (e) { 
		if($(this).val() == <?= UNITTYPE_DORMITORY ?>){
			$('#blokid').attr('disabled', 'disabled');
		}else{
			$('#blokid').removeAttr('disabled');
		}        
    });

	$('#nav-maintenance-tab').click(function (e) { 
		$('#requesttypeid').val($(this).data('id'));
	});

	$('#nav-request-tab').click(function (e) { 
		$('#requesttypeid').val($(this).data('id'));
	});
</script>