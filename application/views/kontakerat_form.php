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
        <form action="<?= $form_action ?>" method="post">
        <input type="hidden" name="id_personal" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['id_personal'])?>">
        <div class="container text-left">
          <h5><i class="fas fa-user mr-2"></i>Kontak Erat</h5><hr>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>ID Kontak Erat</label>
                <input type="text" name="id_kontak_erat" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['id_kontak_erat'])?>" required>
              </div>
              <div class="form-group">
                <label>NIK</label>
                <input type="text" name="nik" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['nik'])?>" required>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['nama'])?>" required>
              </div>
              <div class="form-group">
                <label>Umur</label>
                <input type="number" name="umur" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['umur'])?>" required>
              </div>
              <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control">
                  <?php foreach ($this->UserConstant->get_gender() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['jenis_kelamin'] == $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>           
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>ID UPK</label>
                <input type="text" disabled class="form-control" value="<?= $this->Ternary->isempty_value($epidemiologi['id_upk'], $id_upk)?>">
                <input type="hidden" name="id_upk" class="form-control" value="<?= $this->Ternary->isempty_value($epidemiologi['id_upk'], $id_upk)?>">
              </div>
              <div class="form-group">
                <label>Kecamatan</label>
                <select name="kecamatan" class="form-control">
                  <?php foreach ($this->TracingConstant->kecamatan() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['kecamatan'] == $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Desa/Kelurahan</label>
                <select name="kelurahan" class="form-control">
                  <?php foreach ($this->TracingConstant->kelurahan() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['kelurahan'] == $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label>Alamat Lengkap</label>
                <textarea class="form-control" rows="4" name="alamat"><?= $this->Ternary->isset_value($epidemiologi['alamat'])?></textarea>
              </div>
              <div class="form-group">
                <label>No Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['no_telepon'])?>" required>
              </div>
            </div>
          </div>
          <br>
          <div class="">
          <h5><i class="fas fa-user mr-2"></i>Gejala dan Diagnosa</h5><hr>
          <div class="row mt-6">
            <div class="col-md-6">
              <div class="form-group">
                <label>Riwayat Perjalanan</label>
                <input type="text" name="riwayat_perjalanan" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['riwayat_perjalanan'])?>">
              </div>
              <div class="form-group">
                <label>Terdapat Gejala</label>
                  <select name="ada_gejala" class="form-control">
                  <?php foreach ($this->TracingConstant->ya_tidak() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['ada_gejala'] == $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                  </select>
              </div>
              <div class="form-group">
                <label>Tanggal Timbul Gejala</label>
                <input type="date" name="tanggal_gejala" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['tanggal_gejala'])?>">
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form">
                    <label>Gejala yang Timbul</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="suhutubuhatas38" type="checkbox" value="suhutubuhatas38" id="suhutubuhatas38" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'suhutubuhatas38', 'checked')?>>
                    <label class="form-check-label" for="suhutubuhatas38">
                      Suhu Tubuh >= 38 C
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="suhutubuhbawah38" type="checkbox" value="suhutubuhbawah38" id="suhutubuhbawah38" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'suhutubuhbawah38', 'checked')?>>
                    <label class="form-check-label" for="suhutubuhbawah38">
                      Suhu Tubuh < 38 C
                    </label>
                  </div>              
                  <div class="form-check">
                    <input class="form-check-input" name="batuk" type="checkbox" value="batuk" id="batuk" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'batuk', 'checked')?>>
                    <label class="form-check-label" for="batuk">
                      Batuk
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="pilek" type="checkbox" value="pilek" id="pilek" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'pilek', 'checked')?>>
                    <label class="form-check-label" for="pilek">
                      Pilek
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="sakittenggorokan" type="checkbox" value="sakittenggorokan" id="sakittenggorokan" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'sakittenggorokan', 'checked')?>>
                    <label class="form-check-label" for="sakittenggorokan">
                      Sakit Tenggorokan
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="sakitkepala" type="checkbox" value="sakitkepala" id="sakitkepala" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'sakitkepala', 'checked')?>>
                    <label class="form-check-label" for="sakitkepala">
                      Sakit Kepala
                    </label>
                  </div>   
                  <div class="form mt-3">
                    <label>Kondisi Penyerta</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="hamil" type="checkbox" value="hamil" id="hamil" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'hamil', 'checked')?>>
                    <label class="form-check-label" for="hamil">
                    Hamil
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="diabetes" type="checkbox" value="diabetes" id="diabetes" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'diabetes', 'checked')?>>
                    <label class="form-check-label" for="diabetes">
                    Diabetes
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="jantung" type="checkbox" value="jantung" id="jantung" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'jantung', 'checked')?>>
                    <label class="form-check-label" for="jantung">
                    Penyakit Jantung
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="hipertensi" type="checkbox" value="hipertensi" id="hipertensi" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'hipertensi', 'checked')?>>
                    <label class="form-check-label" for="hipertensi">
                    Hipertensi
                    </label>
                  </div>
                    <div class="form-check">
                    <input class="form-check-input" name="keganasan" type="checkbox" value="keganasan" id="keganasan" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'keganasan', 'checked')?>>
                    <label class="form-check-label" for="keganasan">
                    Keganasan
                    </label>
                  </div>                  
                </div>  
              
                <div class="col-md-6">
                  <div class="form mt-2">
                    <label></label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="sesaknapas" type="checkbox" value="sesaknapas" id="sesaknapas" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'sesaknapas', 'checked')?>>
                    <label class="form-check-label" for="sesaknapas">
                      Sesak Napas
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="lemah" type="checkbox" value="lemah" id="lemah" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'lemah', 'checked')?>>
                    <label class="form-check-label" for="lemah">
                      Lemah (Malaise)
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="nyeriotot" type="checkbox" value="nyeriotot" id="nyeriotot" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'nyeriotot', 'checked')?>>
                    <label class="form-check-label" for="nyeriotot">
                      Nyeri Otot
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="mual" type="checkbox" value="mual" id="mual" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'mual', 'checked')?>>
                    <label class="form-check-label" for="mual">
                      Mual atau Muntah
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="nyeriabdomen" type="checkbox" value="nyeriabdomen" id="nyeriabdomen" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'nyeriabdomen', 'checked')?>>
                    <label class="form-check-label" for="nyeriabdomen">
                      Nyeri Abdomen
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="diare" type="checkbox" value="diare" id="diare" <?= $this->Ternary->iscontain_value($epidemiologi['gejala'], 'diare', 'checked')?>>
                    <label class="form-check-label" for="diare">
                      Diare
                    </label>                
                  </div>
                  <div class="form mt-4">
                    <label></label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="imunologi" type="checkbox" value="imunologi" id="imunologi" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'imunologi', 'checked')?>>
                    <label class="form-check-label" for="imunologi">
                    Gangguan Imunologi
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="ginjal" type="checkbox" value="ginjal" id="ginjal" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'ginjal', 'checked')?>>
                    <label class="form-check-label" for="ginjal">
                    Gagal Ginjal Kronis
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="hati" type="checkbox" value="hati" id="hati" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'hati', 'checked')?>>
                    <label class="form-check-label" for="hati">
                    Gagal Hati Kronis
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" name="ppok" type="checkbox" value="ppok" id="ppok" <?= $this->Ternary->iscontain_value($epidemiologi['kondisi_penyerta'], 'ppok', 'checked')?>>
                    <label class="form-check-label" for="ppok">
                    PPOK
                    </label>
                  </div>
                </div>  
              </div>  
              <div class="form-group mt-2">
                <label>Diagnosa</label>
                <input type="text" name="diagnosa" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['diagnosa'])?>">
              </div>
              <div class="form-group">
                <label>Status Pasien</label>
                <select name="status_pasien" class="form-control">
                  <?php foreach ($this->TracingConstant->status_pasien() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['status_pasien'] ==  $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>
                </select> 
              </div>
          </div>

          <div class="col-md-6">              
            <div class="form-group">
              <label>Pemeriksaan Rapid Test</label>
                <select name="rapid_test" class="form-control">
                  <?php foreach ($this->TracingConstant->ya_tidak() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['rapid_test'] == $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
              <label>Tanggal Rapid Test</label>
              <input type="date" name="tanggal_rapid_test" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['tanggal_rapid_test'])?>">
            </div>
            <div class="form-group">
              <label>Hasil Rapid Test</label>
              <select name="hasil_rapid_test" class="form-control">
                <?php foreach ($this->TracingConstant->hasil_rapid_test() as $key => $value) { ?>
                  <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['hasil_rapid_test'] == $key, 'selected')?> > <?=$value?> </option>
                <?php } ?>
              </select> 
            </div>
            <div class="form-group">
              <label>Pemeriksaan Lab RT-PCR</label>
                <select name="pemeriksaan_lab" class="form-control">
                  <?php foreach ($this->TracingConstant->ya_tidak() as $key => $value) { ?>
                    <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['pemeriksaan_lab'] ==  $key, 'selected')?> > <?=$value?> </option>
                  <?php } ?>
                </select>
            </div>
            <div class="form-group">
              <label>Tanggal Pengambilan Sampel</label>
              <input type="date" name="tanggal_sample" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['tanggal_sample'])?>">
            </div>
            <div class="form-group">
              <label>Tanggal Hasil Laboratorium</label>
              <input type="date" name="tanggal_hasil_lab" class="form-control" value="<?= $this->Ternary->isset_value($epidemiologi['tanggal_hasil_lab'])?>">
            </div>
            <div class="form-group">
              <label>Hasil Laboratorium</label>
              <select name="hasil_lab" class="form-control">
                <?php foreach ($this->TracingConstant->hasil_lab() as $key => $value) { ?>
                  <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['hasil_lab'] ==  $key, 'selected')?> > <?=$value?> </option>
                <?php } ?>
              </select> 
            </div>
            <div class="form-group mt-4">
              <label>Hasil Pemantauan</label>
              <select name="hasil_pemantauan" class="form-control">
                <?php foreach ($this->TracingConstant->hasil_pemantauan() as $key => $value) { ?>
                  <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['hasil_pemantauan'] ==  $key, 'selected')?> > <?=$value?> </option>
                <?php } ?>
              </select> 
            </div>
            <div class="form-group">
              <label>Kategori Kasus</label>
              <select name="kategori_kasus" class="form-control">
                <?php foreach ($this->TracingConstant->kategori_kasus() as $key => $value) { ?>
                  <option value="<?=$key?>" <?= $this->Ternary->istrue_value($epidemiologi['kategori_kasus'] == $key, 'selected')?> > <?=$value?> </option>
                <?php } ?>
              </select> 
            </div>
              <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#TambahKasus">
              <i class=" fas fa-plus-circle mr-3"></i>TAMBAH KONTAK ERAT</button> -->
            <div class="footer text-right mt-5">
              <button type="reset" class="btn btn-danger mt-8">RESET</button>
              <button type="submit" class="btn btn-primary mt-8">SELESAI</button>
            </div>
          </div>
          </div>  
          </div>        
        </div>
        </form>
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