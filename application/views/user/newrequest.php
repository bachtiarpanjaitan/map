<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<div>
	<form action="" class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Jenis Request</label>
					<select name="requesttypeid" id="requesttypeid" class="form-control">
						<?php  foreach ($requesttypes as $data) { ?>
							<option <?php if($edit && $data['requesttypeid'] == $request['requesttypeid']){ echo 'selected';}?> value="<?= $data['requesttypeid'] ?>"><?= $data['requesttypename'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Jenis Unit</label>
					<select name="unittypeid" id="unittypeid" class="form-control">
						<?php  foreach ($unittypes as $data) { ?>
							<option <?php if($edit && $data['unittypeid'] == $request['unittypeid']){ echo 'selected';}?> value="<?= $data['unittypeid'] ?>"><?= $data['unittypename'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Blok</label>
					<select name="blokid" id="blokid" class="form-control">
						<?php  foreach ($bloks as $data) { ?>
							<?php if($data['blokid'] == 0){continue;}  ?>
							<option <?php if($edit && $data['blokid'] == $request['blokid']){ echo 'selected';}?> value="<?= $data['blokid'] ?>"><?= $data['blokname'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Unit</label>
					<select class="form-control" id="unitid">
							
					</select>
				</div>
				<div class="form-group">
					<label for="">No. Handphone</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Pegawai</label>
					<select name="" id="" class="form-control">
						<?php  foreach ($users as $data) { ?>
							<?php if($data['blokid'] == 0){continue;}  ?>
							<option <?php if($edit && $data['username'] == $request['username']){ echo 'selected';}?> value="<?= $data['username'] ?>"><?= $data['username'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group">
					<label for="">Tanggal Masuk</label>
					<input type="text" name="checkindate" id="checkindate" class="datetimepicker form-control">
				</div>
				<div class="form-group">
					<label for="">Tanggal Keluar</label>
					<input type="text" name="checkoutdate" id="checkoutdate" class="datetimepicker form-control">
				</div>
				<div class="form-group">
					<label for="">Surat Keterangan Nikah</label>
					<input type="file" class="input-group">
				</div>
			</div>
			<div class="col-md-12">
				<div>
					<button class="btn btn-primary btn-lg">Save</button>
				</div>
			</div>
	</form>
</div>
<?php $this->load->view('user_footer.php') ?>
<script>

	$('.datetimepicker').bootstrapMaterialDatePicker({
		format: 'LLLL'
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
					if(response.success == true){
						var content = "";
						var data = response.data;
						$.each(data, function (indexInArray, a) { 
							 content += '<option value="'+ a.blokid +'">'+ a.unittitle +'</option>';
						});

						$('#unitid').append(content);
					}
				}
			});
		});
	});
</script>
