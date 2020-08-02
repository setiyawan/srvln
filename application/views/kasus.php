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
        <form method="get">
        <div class="row">
          <div class="col-md-1">
            <label>Tanggal</label>
          </div>
          <div class="col-md-4">
            <input type="date" name="tanggal" class="form-control" value="<?= $tanggal ?>">
          </div>
          <div>
            <button type="submit" class="btn btn-primary mt-8"><i class="fas fa-search mr-2"> </i>Cari</button>
            <button type="submit" class="btn btn-secondary mt-8"><i class="fas fa-download mr-2"> </i>Download</button>
          </div>
          </form>
        </div>
        <hr>
        <h5><i class="fas fa-user mr-2"></i>KASUS SUSPEK</h5><hr>
        <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Kasus Suspek</th>
                <th scope="col">Kasus Probable</th>
                <th scope="col">Kasus Suspek di isolasi</th>
                <th scope="col">Kasus Suspek Discarded</th>
              </tr>
            </thead>
            <tbody>
              <?php $row = 1; foreach ($data_kasus['id_upk'] as $key) { ?>
              <tr>
                <th scope="row"> <?= $row++?> </th>
                <td> <?= $key ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus[$key]['suspek'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus[$key]['probable'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus[$key]['suspek_isolasi'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus[$key]['suspek_discarded'], 0) ?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
         
        <h5><i class="fas fa-user mr-2"></i>KASUS KONFIRMASI</h5><hr>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Kasus Konfirmasi</th>
                <th scope="col">Kasus Konfirmasi Bergejala</th>
                <th scope="col">Kasus Konfirmasi Tanpa Gejala</th>
                <th scope="col">Kasus Konfirmasi Riwayat Perjalanan</th>
                <th scope="col">Kasus Konfirmasi Kontak</th>
                <th scope="col">Kasus Konfirmasi Riwayat Perjalanan atau Kontak Erat</th>
                <th scope="col">Kasus Konfirmasi Selesai Isolasi</th>
              </tr>
            </thead>
            <tbody>
              <?php $row = 1; foreach ($data_kasus_konfirmasi['id_upk'] as $key) { ?>
              <tr>
                <th scope="row"> <?= $row++?> </th>
                <td> <?= $key ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_gejala'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_tanpa_gejala'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_riwayat_perjalanan'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_kontak_erat'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_perjalanan_atau_kontak'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_konfirmasi[$key]['konfirmasi_selesai_isolasi'], 0) ?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>     

          <h5><i class="fas fa-user mr-2"></i>KASUS PEMANTAUAN KONTAK ERAT</h5><hr>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Kasus Konfirmasi dilacak Kontak Erat</th>
                <th scope="col">Kontak Erat Baru Suspek</th>
                <th scope="col">Kontak Erat Konfirmasi</th>
                <th scope="col">Kontak Erat Mangkir Pemantauan</th>
                <th scope="col">Kontak Erat Discarded</th>
            </thead>
            <tbody>
              <?php $row = 1; foreach ($data_kontak_erat['id_upk'] as $key) { ?>
              <tr>
                <th scope="row"> <?= $row++?> </th>
                <td> <?= $key ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kontak_erat[$key]['konfirmasi_lacak_kontak'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kontak_erat[$key]['suspek'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kontak_erat[$key]['konfirmasi'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kontak_erat[$key]['mangkir'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kontak_erat[$key]['discarded'], 0) ?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>     

          <h5><i class="fas fa-user mr-2"></i>KASUS MENINGGAL</h5><hr>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Kasus Meninggal Total</th>
                <th scope="col">Kasus Meninggal RT-PCR (+)</th>
                <th scope="col">Kasus Meninggal Probable</th>
              </tr>
            </thead>
            <tbody>
              <?php $row = 1; foreach ($data_kasus_meninggal['id_upk'] as $key) { ?>
              <tr>
                <th scope="row"> <?= $row++?> </th>
                <td> <?= $key ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_meninggal[$key]['meniggal'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_meninggal[$key]['lab_positif'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_kasus_meninggal[$key]['probable'], 0) ?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>     

          <h5><i class="fas fa-map-pin mr-3 mt-3"></i>PEMERIKSAAN RT-PCR/RAPID TEST</h5><hr>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Kasus diambil spesimen/swab</th>
                <th scope="col">Jumlah Rapid Test</th>
                <th scope="col">Jumlah Rapid Test Reaktif</th>
                <th scope="col">Jumlah Reaktif Periksa RT-PCR</th>
                <th scope="col">Jumlah Reaktif RTPCR (+)</th>
              </tr>
            </thead>
            <tbody>
                <?php $row = 1; foreach ($data_pemeriksaan_lab['id_upk'] as $key) { ?>
              <tr>
                <th scope="row"> <?= $row++?> </th>
                <td> <?= $key ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_pemeriksaan_lab[$key]['spesimen'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_pemeriksaan_lab[$key]['rapid_test'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_pemeriksaan_lab[$key]['hasil_rapid_test'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_pemeriksaan_lab[$key]['pemeriksaan_lab'], 0) ?> </td>
                <td> <?= $this->Ternary->isempty_value($data_pemeriksaan_lab[$key]['hasil_lab'], 0) ?> </td>
              </tr>
              <?php } ?>
            </tbody>
          </table>

          <!-- <h5><i class="fas fa-map-pin mr-3 mt-3"></i>ISOLASI/KARANTINA HARI INI</h5><hr>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">RS RUJUKAN/RS DARURAT</th>
                <th scope="col">Jumlmlah kasus suspek+kasus probabel</th>
                <th scope="col">Jumlah Suspek + Probabel Isolasi Mandiri</th>
                <th scope="col">Jumlah Kasus Konfirmasi</th>
                <th scope="col">Jumlah Kasus Konfirmasi Isolasi Mandiri</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>PKM PANGKALAN</td>
                <td>3</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
       
              <tr>
                <th scope="row">2</th>
                <td>PKM LOJI</td>
                <td>3</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>

              <tr>
                <th scope="row">3</th>
                <td>PKM CIAMPEL</td>
                <td>3</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>

              <tr>
                <th scope="row">4</th>
                <td>PKM TELUKJAMBE</td>
                <td>3</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
              </tr>
            </tbody>
          </table>   -->   

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