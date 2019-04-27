<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<div>
	<form action="" class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="">Request</label>
				<select name="" id="" class="form-control">
					<option value="">test</option>
					<option value="">test</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Blok</label>
				<select name="" id="" class="form-control">
					<option value="">Test</option>
					<option value="">Test2</option>
				</select>
			</div>
			<div class="form-group">
				<label for="">Unit</label>
				<select name="" id="" class="form-control">
					<option value="">test</option>
					<option value="">test2</option>
				</select>
			</div>
			<div>
				<button class="btn btn-primary btn-lg">Save</button>
			</div>
		</div>
	</form>
</div>
<?php $this->load->view('user_footer.php') ?>
