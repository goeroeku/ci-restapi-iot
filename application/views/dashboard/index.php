<!DOCTYPE html>
<html lang="en">
<head>
<title>Smart Trash Bin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo base_url().'assets/bootstrap4/css/bootstrap.min.css'; ?>">
    <script src="<?php echo base_url().'assets/jquery/jquery-3.3.1.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/popper/popper.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/bootstrap4/js/bootstrap.min.js'; ?>"></script>

</head>
<body>
<div class="container">
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="<?php echo base_url().'assets/img/Lampu2.jpg'; ?>" width="30" height="30" class="d-inline-block align-top" alt="">
    Smart Trash Bin
  </a>
</nav>
<div class="card"> <!--Card -->
      <div class="card-header">Tong Sampah 1: Data Terkini</div>
      <div class="card-body">
      <div class="progress">
            <div id="Tong1" class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
        </div>
      </div>
</div><!--Card -->
<div class="card"> <!--Card -->
      <div class="card-header">Tong Sampah 1: History Data</div>
      <div class="card-body">
      <!-- Tabel -->
      <table id="myTable" class="table">
        <thead class="thead-dark">
                    <tr>
                        <th>ID</th><th>Alalt</th><th>Nilai</th><th>Waktu</th>
                    </tr>
        </thead>
        <tbody>
        </tbody>

    </table>
      </div>
</div><!--Card -->

</div> <!-- Container -->
<script>
        $('document').ready(function () {

            setInterval(function () {
                getAllData();

            },
              5000);//request every x seconds
             });
        function getAllData() {

              $.ajax({
                type : 'GET',
                url: 'http://3.134.80.136/iot/api/iot/baca/?alat=Tong1',
                dataType: 'json',
                cache: false,
                success: function(data) {
                    jmlData = data['data'].length;
                    console.log(jmlData);
                    buatTabel = "";
                    for (i=0;i<jmlData;i++) {
                        //Maksimal kedalaman tong sampah 24cm
                        nilai = ((25-(data['data'][i]["nilai"]))/25*100);
                        nilai = nilai.toFixed(0);
                        if (i==0) {
                            $('#Tong1').css('width', nilai+'%').attr('aria-valuenow', nilai);
                            $('#Tong1').html(nilai+'%');
                        }
                        buatTabel += "<tr>"
                                + "<td>" + data['data'][i]["id"] + "</td>"
                                + "<td>" + data['data'][i]["alat"] + "</td>"
                                + "<td>" + nilai + '%' + "</td>"
                                + "<td>" + data['data'][i]["waktu"] + "</td>"
                                + "</tr>";
                    }
                    $('#myTable tbody').html(buatTabel);
                  }
            });
        }

    </script>
</body>
</html>
