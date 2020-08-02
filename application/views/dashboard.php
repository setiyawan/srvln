<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="admin.css">
    <script src="https://kit.fontawesome.com/58b6e7182a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="fontawesome/css/all.min.css">

    <title>Sistem Surveilans COVID-19 Kabupaten Karawang</title>
  </head>
  <body>
    

    <nav class="navbar navbar-expand-lg navbar-light bg-warning fixed-top">
      <a class="navbar-brand" href="#">SELAMAT DATANG |<b>SURVEILANS COVID-19 KABUPATEN KARAWANG </b></a>
    </nav>

    <div class="row no-gutters mt-5">
     
      <?php $this->view('left_navbar'); ?>
      
      <div class="col-md-10 p-5 pt-2">
        <h3><i class="fas fa-tachometer-alt mr-2"></i> DASHBOARD</h3><hr>

        <div class="row text-white">
          <div class="card bg-danger ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">TOTAL KASUS</h5>
              <div class="display-4">6631</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

          <div class="card bg-danger ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS KONFIRMASI</h5>
              <div class="display-4">572</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

        <div class="card bg-danger ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS SUSPEK</h5>
              <div class="display-4">5.380</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

       <div class="card bg-info ml-5 mt-3" style="width: 18rem;">
              <div class="card-body">
                
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS PROBABLE</h5>
              <div class="display-4">1.303</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

       <div class="card bg-info ml-5 mt-3" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KONTAK ERAT DILACAK</h5>
              <div class="display-4">1.200</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>  

           <div class="card bg-info ml-5 mt-3" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">REAKTIF RAPID</h5>
              <div class="display-4">271</div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div> 

      </div>
      <h3><i class="fas fa-tachometer-alt mr-2 mt-5"></i>DIAGRAM DAN GRAFIK</h3><hr>
      <div class="row">
        <div class="col-md-6 bg-white">
          <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
          <script type="text/javascript">
            google.charts.load("current", {packages:['corechart']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
              var data = google.visualization.arrayToDataTable([
                ["Element", "Density", { role: "style" } ],
                ["Copper", 8.94, "#b87333"],
                ["Silver", 10.49, "silver"],
                ["Gold", 19.30, "gold"],
                ["Platinum", 21.45, "color: #e5e4e2"]
              ]);

              var view = new google.visualization.DataView(data);
              view.setColumns([0, 1,
                               { calc: "stringify",
                                 sourceColumn: 1,
                                 type: "string",
                                 role: "annotation" },
                               2]);

              var options = {
                title: "Density of Precious Metals, in g/cm^3",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
              };
              var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
              chart.draw(view, options);
          }
          </script>
          <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
        </div>
        <div class="col-md-6 bg-white">
          
        </div>
      </div>


    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <script type="text/javascript" src="admin.js"></script>
  </body>
</html>