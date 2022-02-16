<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">STKB Dasar TRK</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">

                <a href="<?php echo base_url('stkbdasartrk/tambah') ?>" class="btn btn-primary mb-2">Add</a>

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Edit</th>
                            <th>Bank</th>
                            <?php
                            foreach ($stkbdasartrksken as $sken) :
                            ?>
                            <th><?php echo $sken['nama']; ?></th>
                            <?php
                            endforeach;
                             ?>
                        </tr>
                    </thead>
                    <tbody id="prosesdasar">
                      <?php
                           $no = 1;
                           foreach ($stkbdasartrkbank as $data) :
                        ?>
                        <tr>
                            <td><b><?php echo $no++ ?></b></td>
                            <td><a href="<?php echo base_url(); ?>StkbDasarTrk/edit/<?php echo $data['kode']; ?> " class="btn-success btn-sm" title="Edit"><i class="fas fa-edit"></i></a></td>
                            <td><?php echo $data['nama']; ?></td>
                              <?php
                              foreach ($stkbdasartrksken as $skentd){
                              ?>
                              <td>
                                <?php
                                $caridasarnya = "SELECT * FROM stkb_dasar_trk WHERE kodebank='$data[kode]' AND kodeskenario='$skentd[no]'";
                                $cds = $this->db->query($caridasarnya)->row_array();
                                ?>
                                <?php echo 'Rp. ' . number_format( $cds['harga'], 0 , '' , ',' ); ?>
                              </td>
                            <?php } ?>
                        </tr>
                        <?php
                       endforeach;
                       ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
