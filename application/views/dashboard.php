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
              <div class="display-4"><?= $total_kasus ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

          <div class="card bg-danger ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS KONFIRMASI</h5>
              <div class="display-4"><?= $total_kasus_konfirmasi ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

        <div class="card bg-danger ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS SUSPEK</h5>
              <div class="display-4"><?= $total_kasus_suspek ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

        <div class="card bg-info ml-5" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KASUS PROBABLE</h5>
              <div class="display-4"><?= $total_kasus_probable ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>

       <div class="card bg-info ml-5 mt-3" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">KONTAK ERAT DILACAK</h5>
              <div class="display-4"><?= $total_kontak_erat ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
        </div>  

           <div class="card bg-info ml-5 mt-3" style="width: 18rem;">
              <div class="card-body">
                <div class="card-body-icon">
                  <i class="fas fa-map-pin mr-2"></i>
                </div>
              <h5 class="card-title">REAKTIF RAPID</h5>
              <div class="display-4"><?= $total_kasus_rapid_reaktif ?></div>
              <a href=""><p class="card-text text-white">Lihat Detail <i class="fas fa-angle-double-right ml-2"></i></p></a>
          </div>
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