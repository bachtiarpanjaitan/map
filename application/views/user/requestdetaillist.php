<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
} ?>

<div>
    <table class="table table-hover table-responsive" id="table">
        <thead>
            <th>USERNAME</th>
            <th>TIPE REQUEST</th>
            <th>TIPE UNIT</th>
            <th>BLOK</th>
            <th>UNIT</th>
            <th>CHECK IN</th>
            <th>CHECK OUT</th>
            <th>ACTION</th> 
        </thead>
        <tbody>
            <?php foreach ($requests as $data) {  ?>
            <tr>
                <td><a href="<?= site_url('user/editrequestdetail/').$data['requestdetailid'] ?>"><?= $data['username'] ?></a></td>
                <td><?= $data['requesttypename'] ?></td>
                <td><?= $data['unittypename'] ?></td>
                <td><?= $data['blokname'] ?></td>
                <td><?= $data['unittitle'] ?></td>
                <td><?= $data['checkindate'] ?></td>
                <td><?= $data['checkoutdate'] ?></td>
                <td><a class="btndelete" data-requestdetailid="<?= $data['requestdetailid'] ?>" style="cursor: pointer"><i class="mdi mdi-delete " style="font-size: 25px"></i></a></td>
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
           var id = $(this).data('requestdetailid');
            swal("Anda yakin menghapusnya?.", {
                buttons: {
                    cancel: 'Tidak',
                    value: "Ya",
                    }
            }).then((value) => {
               if(value){
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('api/deleterequestdetail') ?>",
                        data: {
                            id: id
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.success == true){
                                swal('success','Data Berhasil Dihapus', 'success');
                                location.reload();
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