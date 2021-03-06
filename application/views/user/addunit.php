<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
   
}
?>
<div>
    <form>
    <div class="col-md-6">
        <input type="hidden" value="<?= $edit? $unit->unitid:'' ?>" id="unitid">
        <div class="form-group">
            <label for="unittitle">Unit Title</label>
            <input type="text" name="unittitle" class="form-control" id="unittitle"  value="<?= $edit? $unit->unittitle:'' ?>" required>
        </div>
        <div class="form-group">
            <label for="telepon">Blok</label>
            <select name="blokid" id="blokid" class="form-control" value="<?= $edit? $user->blokid:'' ?>">
                <?php  foreach ($bloks as $data) { ?>
                    <option <?php if($edit && $unit->blokid == $data['blokid']){ echo 'selected';}?> value="<?= $data['blokid'] ?>"><?= $data['blokname'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label for="unitdescription">Unit Description</label>
            <textarea type="text" name="unitdescription" class="form-control" id="unitdescription" required rows="10" col=""><?= $edit? $unit->unitdescription:'' ?></textarea>
        </div>
        <button type="button" class="btn btn-primary" id="btnsave">Save</button>
    </div>
    
    </form>
</div>
<?php $this->load->view('user_footer.php'); ?>
<script>
    $(document).ready(function () {
        $('#btnsave').click(function (e) { 
            if($('#unittitle').val() == ""){
                swal('error','Judul tidak boleh kosong','error');
                return false;
            }
           $.ajax({
               type: "POST",
               url: "<?= site_url('api/saveunit') ?>",
               data: {
                   'unittitle':$('#unittitle').val(),
                   'unitdescription': $('#unitdescription').val(),
                   'blokid':$('#blokid').val(),
                   'unitid': $('#unitid').val(),
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