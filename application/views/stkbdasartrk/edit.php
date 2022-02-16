<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Form Edit Dasar Trk</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Stkb Dasar Trk > Form Edit </h6>
        </div>

        <div class="card-body">
            <form action="" method="POST">

                <input type="hidden" name="kodebank" value="<?php echo $kode['kodebank']; ?>">

                <div class="form-group">
                  <label for="user">Bank</label>
                    <input type="text" class="form-control" id="kodebank" placeholder="<?php echo $kode['nama']; ?>" disabled>
                </div>

                <?php
                foreach ($skenario as $fl) {
                ?>
                <div class="form-group">
                  <label for="user"><?php echo $fl['nama'] ?></label>
                    <input type="number" name="<?php echo $fl['kodeskenario']; ?>" class="form-control" id="kodebank" value="<?php echo $fl['harga']; ?>">
                </div>
                <?php
                }
                ?>

                <div class="form-group">
                    <button class="btn btn-primary" type="submit">Save</button>
                    <a href="<?php echo base_url('stkbdasartrk') ?>" class=" btn btn-danger"> Back</a>
                </div>

            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
