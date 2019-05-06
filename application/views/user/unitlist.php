<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
} ?>

<div>
    <table class="table table-hover table-responsive" id="table">
        <thead>
            <th>TITLE</th>
            <th>BLOK</th>
            <th>DESCRIPTION</th>
            <th>STATUS</th>
            <th></th>
        </thead>
        <tbody>
            <?php foreach ($units as $data) {  ?>
            <tr>
                <td><a href="<?= site_url('user/editunit/').$data['unitid'] ?>"><?= $data['unittitle'] ?></a></td>
                <td><?= $data['blokname'] ?></td>
                <td><?= $data['unitdescription'] ?></td>
                <td><?= $data['statusname'] ?></td>
                <td><a class="btndelete" data-unitid="<?= $data['unitid'] ?>" style="cursor: pointer"><i class="mdi mdi-delete " style="font-size: 25px"></i></a></td>
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
           var uid= $(this).data('unitid');
            swal("Anda yakin menghapusnya?.", {
                buttons: {
                    cancel: 'Tidak',
                    value: "Ya",
                    }
            }).then((value) => {
               if(value){
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('api/deleteunit') ?>",
                        data: {
                            unitid: uid
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