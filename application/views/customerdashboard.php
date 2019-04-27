<?php include_once('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<?php include_once('user_header.php') ?>
<div>
	<main class="content-wrapper">

		<div class="col-md-10 bg-white p-30 box-shadow ">
			<br>
			<div class="section-heading">
				<h3 clasS="text-center">DORMITORI</h3>
			</div>
			<div class="row col-md-12">
				<div class="container text-center col-md-3">
					<h4 class="bg-warning">A</h4>
					<div class="row">
						<table class="container col-md-5 " border="2" cellpadding="4" cellspacing="0">
							<div class="text-center">
								<td>1</td>
							</div>
						</table>
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>9</td>
							</div>
                        </table>
                        
					</div>

				</div>
				<div class="container text-center col-md-3">
					<h4 class="bg-warning">B</h4>
					<div class="row">
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>1</td>
							</div>
						</table>
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>9</td>
							</div>
						</table>
					</div>

				</div>
				<div class="container text-center col-md-3">
					<h4 class="bg-warning">C</h4>
					<div class="row">
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>1</td>
							</div>
						</table>
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>9</td>
							</div>
						</table>
					</div>

				</div>
				<div class="container text-center col-md-3">
					<h4 class="bg-warning">D</h4>
					<div class="row">
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>1</td>
							</div>
						</table>
						<table class="container col-md-5 " border="2" cellpadding="6" cellspacing="0">
							<div class="text-center">
								<td>9</td>
							</div>
						</table>
					</div>

				</div>
			</div>
			

        </div>
	</main>
</div>
<?php include_once('user_footer.php') ?>
