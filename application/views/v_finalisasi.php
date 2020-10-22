<section class="content">
  <div class="box">
    <div class="card-body" style="padding: 5px;">
      <div class="callout callout-danger">
        <h4>PERINGATAN!</h4>
        <ol>
          <li>Dengan menekan tombol <b>FINALISASI</b> menyatakan bahwa anda telah selesai melakukan <b>VALIDASI BMD</b> dan akan mengunci seluruh <b>SENSUS KIB</b>.</li>
          <li>Pastikan bahwa anda telah memeriksa semua KIB sehingga anda yakin bahwa <b>VALIDASI BMD</b> telah selesai.</li>
          <li>Adapun dikemudian hari anda ingin membuka kembali kunci <b>VALIDASI BMD</b>, Anda dapat menghubungi <b>BIDANG ASET.</b></li>
        </ol>
      </div>
      <div class="d-flex justify-content-between" align="center">
        <?php
        if ($_SESSION['activity']==1) {
          ?>
          <button class="btn btn-primary btn-lg" onclick="edit()"><b>Finalisasi</b> <i class="far fa-lock fa-lg"></i></button>
          <br>
          <span class="text-muted">Belum difinalisasi</span>
          <?php
        }else{
          ?>
          <button class="btn btn-info btn-lg" disabled><b>Selesai</b> <i class="far fa-lock-alt fa-lg"></i></button><br>
          <span class="text-muted">Sudah difinalisasi</span>
          <?php
        }
        ?>
      </div>
    </div>
  </div>
</div>
</section>
<script src="<?php echo base_url(); ?>assets/js/v_finalisasi.js" type="text/javascript"></script>


