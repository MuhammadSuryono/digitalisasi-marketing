<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">STKB 1-Project</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"></h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <td>Edit</th>
                            <th>Project</th>
                            <th>Nama Klien</th>
                            <th>Tahun</th>
                        </tr>
                    </thead>
                    <tbody>

                          <?php
                            $i = 1;
                            foreach ($semuaproject as $pro) {
                            echo "<tr>";
                            echo "<td>" .$i++. "</td>";
                            ?>
                            <td><a href="<?php echo base_url(); ?>stkbproject/edit/<?php echo $pro['prokod']; ?>" class="btn btn-success btn-sm"><i class="fas fa-pen fa-sm"></i> Edit</a></td>
                            <?php
                            echo "<td>" .$pro['prokod']. " - " .$pro['pronam']. "</td>";
                            echo "<td>" .$pro['banknam']. "</td>";
                            echo "<td>" .$pro['protang']. "</td>";
                            echo "</tr>";
                            }
                          ?>
                    </tbody>
                </table>
              </div>
          </div>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
