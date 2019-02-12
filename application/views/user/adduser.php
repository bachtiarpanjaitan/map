<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<div>
    <form>
        <div class="col-md-6">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" placeholder="Enter Username" id="username" class="form-control" value="<?= $edit? $user->username:'' ?>">
            </div>
            <div class="form-group">
                <label for="fullname">Fullname</label>
                <input type="text" placeholder="Enter Fullname" id="fullname" class="form-control" value="<?= $edit? $user->fullname:'' ?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" placeholder="Enter Email" id="email" class="form-control" value="<?= $edit? $user->email:'' ?>">
            </div>
            <div class="form-group">
                <label for="Level">Level</label>
                <select name="level" id="level" class="form-control" value="<?= $edit? $user->levelid:'' ?>">
                    <?php  foreach ($level as $data) { ?>
                        <option <?php if($edit && $user->levelid == $data['levelid']){ echo 'selected';}?> value="<?= $data['levelid'] ?>"><?= $data['levelname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control" value="<?= $edit? $user->roleid:'' ?>">
                    <?php  foreach ($roles as $data) { ?>
                        <option <?php if($edit && $user->roleid == $data['roleid']){ echo 'selected';}?> value="<?= $data['roleid'] ?>"><?= $data['rolename'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="telepon">Telepon</label>
                <input type="text" placeholder="Enter Phone" id="telepon" class="form-control" value="<?= $edit? $user->telepon:'' ?>">
            </div>
            <div class="form-group">
                <label for="telepon">Akses Blok</label>
                <select name="blokid" id="blokid" class="form-control" value="<?= $edit? $user->blokid:'' ?>">
                    <?php  foreach ($bloks as $data) { ?>
                        <option <?php if($edit && $user->blokid == $data['blokid']){ echo 'selected';}?> value="<?= $data['blokid'] ?>"><?= $data['blokname'] ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <input type="checkbox" name="issuspend" id="issuspend" value="<?= $edit? $user->issuspend:'' ?>"> Is Suspend
            </div>
        </div>
        <div class="col-md-6"></div>
        <button type="button" class="btn btn-primary" id="btnsave">Save</button>
    </form>
</div>
<?php $this->load->view('user_footer.php') ?>
<script>
  $(document).ready(function () {
    $('#btnsave').click(function (e) { 
        <?php if(!$edit){ ?>
            if($('#username').val() == ""){
                swal('error','Username tidak boleh kosong', 'error');
                return false;
            }
        <?php  }  ?>

        if($('#fullname').val() == ""){
            swal('error','Fullname tidak boleh kosong','error');
            return false;
        }

        if($('#email').val() == ""){
            swal('error','Email tidak boleh kosong','error');
            return false;
        }
        if($('#telepon').val() == ""){
            swal('error','Telepon tidak boleh kosong', 'error');
            return false;
        }

      $.ajax({
          type: "POST",
          url: "<?= site_url('user/saveuser') ?>",
          data: {
              'username': $('#username').val(),
              'fullname': $('#fullname').val(),
              'email': $('#email').val(),
              'level':  $('#level').val(),
              'role': $('#role').val(),
              'telepon': $('#telepon').val(),
              'issuspend': $('#issuspend').val(),
              'blok': $('#blokid').val(),
              'edit': <?= $edit?'1': '0' ?>
          },
          dataType: "JSON",
          success: function (response) {
              if(response.success == true){
                swal('success','Data Berhasil Disimpan', 'success').then((val) => {
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