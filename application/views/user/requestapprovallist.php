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
            <th>APPROVE STATUS</th>
            <th>APPROVE BY</th>
            <th>APPROVE DATE</th>
            <th>Approve</th>
        </thead>
        <tbody>
            <?php foreach ($requests as $data) {  ?>
            <tr <?= $data['approvedstatusid'] != REQUESTSTATUS_PENDING ?'style="pointer-events:none"':'' ?>>
                <td><a href="<?= site_url('user/editrequestdetail/').$data['requestdetailid'] ?>"><?= $data['username'] ?></a></td>
                <td><?= $data['requesttypename'] ?></td>
                <td><?= $data['unittypename'] ?></td>
                <td><?= $data['blokname'] ?></td>
                <td><?= $data['unittitle'] ?></td>
                <td><?= $data['checkindate'] ?></td>
                <td><?= $data['checkoutdate'] ?></td>
                <td><?= $data['approvalstatusname']?></td>
                <td><?= $data['approvedby']?></td>
                <td><?= $data['approveddate']?></td>
                <td ><a  class="btnapproval" data-toggle="modal" data-target="#myModal" data-requestdetailid="<?= $data['requestdetailid'] ?>" style="cursor: pointer"><i class="mdi mdi-check " style="font-size: 25px"></i></a></td>
            </tr>
            <?php  }  ?>
        </tbody>
    </table>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Approval Option</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <input type="hidden" value="" id="selectedid">
        <select name="selectedstatus" id="selectedstatus" class="form-control">
            <option value="">Silahkan Pilih Approval</option>
            <?php  foreach ($status as $data) { ?>
            <option value="<?= $data['approvalstatusid'] ?>"><?= $data['approvalstatusname'] ?></option>
            <?php } ?>
        </select>
      </div>
      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" id="btnapprove" class="btn btn-primary">Save</button>
      </div>

    </div>
  </div>
</div>

<?php $this->load->view('user_footer.php') ?>
<script>
    $('#table').dataTable({});
    $(document).ready(function () {
        $('#btnapprove').click(function (e) { 
           var id = $('#selectedid').val();
           var status = $('#selectedstatus').val();
            swal("Anda yakin?.", {
                buttons: {
                    cancel: 'Tidak',
                    value: "Ya",
                    }
            }).then((value) => {
               if(value){
                    $.ajax({
                        type: "POST",
                        url: "<?= site_url('api/approverequest') ?>",
                        data: {
                            id: id,
                            status:status
                        },
                        dataType: "JSON",
                        success: function (response) {
                            if(response.success == true){
                                swal('success','Data Berhasil Disimpan', 'success').then((val) => {
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

        $('.btnapproval').click(function (e) { 
            // console.log($(this).data('requestdetailid'));
            $('#selectedid').val($(this).data('requestdetailid'));
        });
    });
</script>