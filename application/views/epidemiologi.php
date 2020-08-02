<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
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
        <h5><i class="fas fa-binoculars mr-2"></i>PENYELIDIKAN EPIDEMIOLOGI</h5><hr>

          <a href="<?=base_url()?>epidemiologi/tambah" class=" btn btn-primary mb-3"><i class="fas fa-plus-circle mr-3"></i>TAMBAH KASUS</a>
          <table class="table table-hover table-striped table-bordered">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">ID Kasus</th>
                <th scope="col">Nama</th>
                <th scope="col">Umur</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Status</th>
                <th scope="col">Kategori</th>
                <th scope="col">Puskes/RS</th>
                <th scope="col">Terakhir Update</th>
                <th colspan="1" scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $row = 1; ?>
              <?php foreach ($epidemiologi as $key => $value) { ?>
              <tr>
                <th scope="row"> <?= $row++; ?></th>
                <td> <?= $value['id_kasus']?> </td>
                <td> <?= $value['nama'] ?> </td>
                <td> <?= $value['umur'] ?> </td>
                <td> <?= $value['jenis_kelamin'] ?> </td>
                <td> <?= $value['status_pasien'] ?> </td>
                <td> <?= $value['kategori_kasus'] ?> </td>
                <td> <?= $value['id_upk'] ?> </td>
                <td> <?= $value['update_time'] ?> </td>
                <td>
                  <?php if ($id_upk == $value['id_upk']) { ?>
                  <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle bg-success" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Ubah Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <a class="dropdown-item" href="<?= base_url()?>epidemiologi/edit?id=<?= $value['id_personal']?>">Edit Profil</a>
                      <a class="dropdown-item" href="<?= base_url()?>epidemiologi/edit?id=<?= $value['id_personal']?>">Update Pemantauan</a>
                      <a class="dropdown-item" href="#">Hapus Kasus</a>
                    </div>
                  </div>
                  <?php } ?>
                </td>
              </tr>
              <?php } ?>
       
            </tbody>
          </table>
      </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  </body>
</html>