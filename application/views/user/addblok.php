<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
   
}?>
<div>
    <form>
    <div class="col-md-6">
        <input type="hidden" value="<?= $edit? $blok->blokid:'' ?>" id="blokid">
        <div class="form-group">
            <label for="unitcoords">Blok Name</label>
            <input type="text" name="blokname" class="form-control" id="blokname" placeholder="exp. Blok A"  value="<?= $edit? $blok->blokname:'' ?>" required>
        </div>
         <div class="form-group">
            <input type="checkbox" name="dormitory" id="dormitory" placeholder="exp. Blok A"  value="1" <?= $edit? $blok->dormitory == 1?'checked':'':'' ?>> Blok Memiliki type dormitory
        </div>
        <button type="button" class="btn btn-primary" id="btnsave">Save</button>
    </div>
    
    </form>
</div>
<?php $this->load->view('user_footer.php'); ?>
<script>
    $(document).ready(function () {
        $('#btnsave').click(function (e) { 
            if($('#blokname').val() == ""){
                swal('error','Nama Blok tidak boleh kosong','error');
                return false;
            }
           $.ajax({
               type: "POST",
               url: "<?= site_url('api/saveblok') ?>",
               data: {
                   'blokname': $('#blokname').val(),
                   'blokid': $('#blokid').val(),
                   'dormitory': $('#dormitory').val() == 1?'1':0,
                   'edit': '<?= $edit?>'
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