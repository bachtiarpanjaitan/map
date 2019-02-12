<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}?>

<div>
    <table class="table table-hover table-responsive" id="table">
        <thead>
            <th>BLOK ID</th>
            <th>BLOK NAME</th>
            <th>ACTION</th>
        </thead>
        <tbody>
            <?php foreach ($bloks as $data) {  ?>
            <tr>
                <td><a href="<?= site_url('user/blokedit/').$data['blokid'] ?>"><?= $data['blokid'] ?></a></td>
                <td><?= $data['blokname'] ?></td>
                <td><a class="btndelete" data-id="<?= $data['blokid'] ?>" style="cursor: pointer"><i class="mdi mdi-delete " style="font-size: 25px"></i></a></td>
            </tr>
            <?php  }  ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('user_footer.php') ?>
<script>
    $('#table').dataTable({});

    $(document).ready(function () {
        $('.btndelete').click(function (e) { 
           var blokid = $(this).data('id');
            swal("Anda yakin menghapusnya?.", {
                buttons: {
                    cancel: 'Tidak',
                    value: "Ya",
                    }
            }).then((value) => {
               if(value){
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('api/deleteblok') ?>",
                        data: {
                            id: blokid
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.success == true){
                                swal('success','Data Berhasil Dihapus', 'success').then((val) => {
                                location.reload();
                                });
                            }else{
                                swal('error', response.message,'error');
                            }
                        }
                    });
               }
            });
        });
    });
</script>