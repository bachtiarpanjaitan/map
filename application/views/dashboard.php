<?php include_once('user_header.php');
if(!islogin()){
    redirect('user/viewlogin');
}
?>
<style>
body{text-align: center;background: #f2f6f8;}
.img{position:absolute;z-index:20;}
#mapcontainer{
    display:inline-block;
    width:1890; 
    height:1417;
    margin: 0 auto; 
    position:relative; 
    border:5px solid black; 
    border-radius: 10px; 
    box-shadow: 0 5px 50px #333}

#canvas{
    position:relative;
    z-index:1;
}
</style>
<div class="col col-md-12 scroll">
    <div id="mapcontainer" style="opacity: 1">
        <img class="img" usemap="xmap"  alt="canvas" width="1890" height="1417">
        <canvas id="canvas" style="background:url(<?= ASSETS ?>images/map.png)" width="1890" height="1417" style='border: 1px black solid;position:absolute;top:opx;left:opx; opacity="0.2"'></canvas>
    </div>
    <map id="xmap" name="xmap"></map>
</div>
<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <nav>
            <div class="nav nav-tabs nav-pills" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Unit Info</a>
                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Order Info</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
                <!-- UNIT INFO -->
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <br>
                <div class="col-md-12">
                    <input type="hidden" name="unitid" id="unitid">
                    <div class="form-group">
                        <label for="unittitle">Unit Name</label>
                        <input type="text" name="unittitle" id="unittitle" class="form-control" readonly>
                    </div>
                    <div class="form-group">
                        <label for="description">Detail</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10" readonly></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="editunit" class="btn btn-warning">Edit</button>
                        <button type="button" id="saveunit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
            <!-- END UNIT INFO -->
            <!-- ORDER INFO -->
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <br>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="fullname">FullName</label>
                        <input type="text" name="fullname" id="fullname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="info-remarks">Detail</label>
                        <textarea name="info-remarks" id="info-remarks" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="button" id="saveorder" class="btn btn-primary">Save changes</button>
                    </div>
                    
                </div>
            </div>
            <!-- END ORDER INFO -->
        </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
<?php include_once('user_footer.php') ?>
<script>
$(document).ready(function () {

    function clear(){
        $('#title').empty();
        $('#unittitle').attr('readonly');
        $('#description').attr('readonly');
        $('#unitid').empty();
    }
    var canvas = document.getElementById('canvas');
    $.ajax({
        type: "POST",
        url: "<?= site_url('api/getunits') ?>",
        data: {

        },
        dataType: "JSON",
        success: function (response) {
            if(response.success == true){
                var content = "";
                for(var i=0; i < Object.keys(response.units).length; i++){
                drawUnit(response.units[i]);
                content += '<area class="objunit" data-desc="'+ 
                response.units[i]['unitdescription'] +
                '" data-title="'+ response.units[i]['unittitle'] +
                '" data-coords="'+ response.units[i]['unitcoords'] +
                '" style="color: green" data-toggle="modal" data-target="#modal" shape="poly" coords="'+ 
                response.units[i]['unitcoords'] +
                '" title="'+  response.units[i]['unittitle'] +
                '" data-statusname="'+ response.units[i]['statusname'] +
                '" data-statusid="'+ response.units[i]['statusid'] +
                '" data-unit="'+ response.units[i]['unitid'] +
                '" alt="obj-'+ i +'" />';
                }
                $('#xmap').append(content);
                $('.objunit').click(function (e) {
                    clear();
                    var title = $(this).data('title'); 
                    var desc = $(this).data('desc');
                    var statusname = $(this).data('statusname'); 
                    var unitid = $(this).data('unit');
                    console.log(unitid);
                    $('#title').append(title + '<h3 class="center-text"> '+ statusname +' </h3>');
                    $('#unittitle').val(title);
                    $('#description').val(desc);
                    $('#unitid').val(unitid);
                });
            }
        }
    });

    $('#editunit').click(function (e) { 
        $('#unittitle').removeAttr('readonly');
        $('#description').removeAttr('readonly');
        
    });
    
function drawUnit(data){
    console.log(data);
    if (canvas.getContext) {
        var ctx = canvas.getContext('2d');
        var arraycoords = data['unitcoords'].split(',');
        ctx.beginPath();
        ctx.globaAlpha="0";
        switch (data['statusid']) {
            case "1":
                ctx.fillStyle= '#00c853' ;
                break;
            case "2":
                ctx.fillStyle= '#ff9800' ;
                break;
            case "3":
                ctx.fillStyle= '#2196f3' ;
                break;
            case "4":
                ctx.fillStyle= '#d50000' ;
                break;
            default:
                ctx.fillStyle= '#000';
        }
        
        // draw image in canvas
        ctx.moveTo(arraycoords[0],arraycoords[1]);
        ctx.lineTo(arraycoords[2],arraycoords[3]);
        ctx.lineTo(arraycoords[4],arraycoords[5]);
        ctx.lineTo(arraycoords[6],arraycoords[7]);
        ctx.closePath();
        var obj = ctx.fill();
        console.log(ctx);
    }
};
   
});

</script>