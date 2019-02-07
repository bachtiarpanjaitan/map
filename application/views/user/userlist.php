<?php $this->load->view('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
} ?>

<div>
    <table class="table table-hover table-responsive" id="table">
        <thead>
            <th>USERNAME</th>
            <th>FULLNAME</th>
            <th>EMAIL</th>
            <th>LEVEL</th>
            <th>ROLE</th>
            <th>TELEPON</th>
            <th>ACTIVE</th>
            <th>ACTION</th>
        </thead>
        <tbody>
            <?php foreach ($users as $data) {  ?>
            <tr>
                <td><a href="<?= site_url('user/useredit/').$data['username'] ?>"><?= $data['username'] ?></a></td>
                <td><?= $data['fullname'] ?></td>
                <td><?= $data['email'] ?></td>
                <td><?= $data['levelname'] ?></td>
                <td><?= $data['rolename'] ?></td>
                <td><?= $data['telepon'] ?></td>
                <td><?= $data['issuspend']?" NON ACTIVE":"ACTIVE" ?></td>
                <td><a href=""><i class="mdi mdi-delete" style="font-size: 25px"></i></a></td>
            </tr>
            <?php  }  ?>
        </tbody>
    </table>
</div>

<?php $this->load->view('user_footer.php') ?>