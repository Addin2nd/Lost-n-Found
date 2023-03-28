<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <?php $i = 1; ?>
            <?php foreach ($postlost as $p) : ?>
                <?php if ($p['kategori'] == 'Found') { ?>
                    <div class="card mb-3">
                        <img src="<?= base_url('assets/img/barang/') . $p['image']; ?>" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?= $p['kategori']; ?></h5>
                            <p class="card-text"><?= $p['deskripsi']; ?></p>
                            <p class="card-text"><small class="text-muted"><?= $p['kontak']; ?></small></p>
                        </div>
                    </div>
                <?php } else {
                } ?>
                <?php $i++; ?>
            <?php endforeach ?>


        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->