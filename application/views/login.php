



<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>EP Pelindo 1 - Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="https://pi-one.pelindo1.co.id/EP/Content/simplegrid.css">
    <link rel="stylesheet" type="text/css" href="<?= ASSETS  ?>/css/pelindo-login.css">
    <link rel="shortcut icon" href="https://pi-one.pelindo1.co.id/EP/Content/icon/logo-mini.png" type="image/x-icon">
    <link rel="icon" href="https://pi-one.pelindo1.co.id/EP/Content/icon/logo-mini.png" type="image/x-icon">
</head>

<body class="login-page">
    <div class="grid">
        <div class="col-4-12">
            <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/pelindo1-logo.png" height="70" alt="">
            <div class="vision-mission-box right">
                <h2 class="section-heading">Visi</h2>
                <p>Menjadi Nomor Satu di Bisnis Kepelabuhan di Indonesia</p>
                <h2 class="section-heading">Misi</h2>
                <p>
                    Menyediakan Jasa Kepelabuhan yang Terintegrasi, Berkualitas & Bernilai Tambah untuk Memacu Pertumbuhan Ekonomi Wilayah
                </p>
            </div>
        </div>
        <div class="col-4-12">
            <div class="welcome-img center">
                <img src="<?= ASSETS  ?>images/logo.png" width="142" alt="">
            </div>
            <div class="login-box">


            <form action="<?= site_url("user/login") ?>" method="post">                   
                <div class="login-fields-box">
                        
                        <!-- <p>
                            <span class="input-label">Company:</span><br>
                            <select name="CompanyCode" id="CompanyCode" style="width: 100%; font-size: 14px; padding: 5px;"></select>
                        </p> -->
                        <p>
                            <span class="input-label">Username:</span><br>
                            <input type="text" class="input-field" name='Username' id='UserName'>
                        </p>
                        <p>
                            <span class="input-label">Password:</span><br>
                            <input type="password" class="input-field" name="Password" id="Password">
                        </p>

                    </div>
                    <div class="login-button-box">
                        <button type="button" onclick="window.location.href = window.location.protocol + '//' + window.location.host + '/'" class="btn pill red" style="float:right">Back to Home</button>
                        <button id="btnSignIn" type="submit" class="btn pill red">Login</button>
                    </div>
</form>
            </div>
        </div>
        <div class="col-4-12 right">
            <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/pelindo1-hebat.png" height="65" alt="">
            <div class="cipta-logo left">
                <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/cipta-logo.png" height="40" alt="">
            </div>
            <div class="cipta-values-box left">
                <h3 class="section-heading">Perilaku Kunci CIPTa </h3>
                <div style="padding-top:10px">
                    <div class="cipta-value-icon">
                        <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/customer-focus.png" height="28" alt="">
                    </div>
                    <p class="cipta-value-title">Customer Focus</p>
                    <ul class="cipta-value-items">
                        <li class="cipta-value-item">Proaktif dan Cepat Tanggap</li>
                        <li class="cipta-value-item">Mengutamakan Pelayanan Prima dan Kepuasan Pelanggan</li>
                    </ul>
                </div>
                <div>
                    <div class="cipta-value-icon">
                        <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/integrity.png" height="28" alt="">
                    </div>
                    <p class="cipta-value-title">Integrity</p>
                    <ul class="cipta-value-items">
                        <li class="cipta-value-item">Jujur dan Taat</li>
                        <li class="cipta-value-item">Berani dan Bertanggung Jawab</li>
                    </ul>
                </div>
                <div>
                    <div class="cipta-value-icon">
                        <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/professionalism.png" height="28" alt="">
                    </div>
                    <p class="cipta-value-title">Professionalism</p>
                    <ul class="cipta-value-items">
                        <li class="cipta-value-item">Kompeten dan Disiplin</li>
                        <li class="cipta-value-item">Berkualitas</li>
                    </ul>
                </div>
                <div>
                    <div class="cipta-value-icon">
                        <img src="https://pi-one.pelindo1.co.id/EP/Content/icon/teamwork.png" height="28" alt="">
                    </div>
                    <p class="cipta-value-title">TeamWork</p>
                    <ul class="cipta-value-items">
                        <li class="cipta-value-item">Berkolaborasi dan Bersinergi</li>
                        <li class="cipta-value-item">Tulus dan Saling Menghargai</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://pi-one.pelindo1.co.id/EP/Scripts/jquery-2.1.3.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/xml2json.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/json2xml.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/select2.full.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/jquery.steps.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/jquery.form.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/moment.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/jquery.cookie.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/jquery.storageapi.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/knockout-3.3.0.debug.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/koGrid-2.1.1.debug.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/w2ui-1.4.2.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/modernizr-2.5.3.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/bootstrap.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/bootstrap-filestyle.js"></script>

    <script src="https://pi-one.pelindo1.co.id/EP/Scripts/helpers/w2ui-helper.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/helpers/config-helpers.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/helpers/converter-helper.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/helpers/infotype-helper.js"></script>
<script src="https://pi-one.pelindo1.co.id/EP/Scripts/helpers/integration-helper.js"></script>

    <!-- <script src="https://pi-one.pelindo1.co.id/EP/Views/Account/login.js"></script> -->


</body>
</html>
