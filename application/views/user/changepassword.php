<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
} ?>

<div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="cpassword">Current Password</label>
            <input type="password" placeholder="Enter Current Password" id="cpassword" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" placeholder="Password" id="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="upassword">Password</label>
            <input type="password" placeholder="Repeat password" id="upassword" class="form-control">
        </div>
        <button class="btn btn-primary" id="btnchange">Change</button>
    </div>
</div>



<?php $this->load->view('user_footer.php') ?>
<script>
$(document).ready(function () {
    $('#btnchange').click(function (e) { 
        if($('#cpassword').val() == ""){
            swal('error','Current Password tidak boleh kosong','error');
            return false;
        }
        if($('#password').val() == ""){
            swal('error','Password tidak boleh kosong','error');
            return false;
        }
        if($('#upassword').val() == ""){
            swal('error','Ulangi Password tidak boleh kosong','error');
            return false;
        }
        if($('#password').val() != $('#upassword').val()){
            swal('error','Password dan Ulangi Password tidak sama','error');
            return false;
        }
      $.ajax({
          type: "POST",
          url: "<?= site_url('api/changepassword') ?>",
          data: {
              cpassword: $('#cpassword').val(),
              password: $('#password').val()
          },
          dataType: "JSON",
          success: function (response) {
            if(response.success == true){
                swal('success','Password Berhasil Disimpan', 'success').then((val) => {
                    location.reload();
                });
            }else{
                swal('error',response.message,'error');
            }
          }
      });
    });
});
</script>