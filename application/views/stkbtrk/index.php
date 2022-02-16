<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">STKB Transaksi</h1>
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
                          <th>  No. </th>
                          <th>	Nomor Reff	</th>
                          <th>	Project	</th>
                          <th>	Nama	</th>
                          <th>	Total Lumpsum	</th>
                          <th bgcolor="#e3f3fc">	Term 1	</th>
                          <th bgcolor="#e3f3fc">	Approval 	</th>
                          <th bgcolor="#e3f3fc">	Tanggal Bayar	</th>
                          <th bgcolor="#e3f3fc">	No Voucher	</th>
                          <th bgcolor="#e3f3fc">	Aktual Bayar	</th>
                          <th bgcolor="#bde4f9">	Term 2 </th>
                          <th bgcolor="#bde4f9">	Approval	</th>
                          <th bgcolor="#bde4f9">	Tanggal	</th>
                          <th bgcolor="#bde4f9">	No Voucher	</th>
                          <th bgcolor="#bde4f9">	Aktual Bayar	</th>
                          <th bgcolor="#7acdf9">	Term 3	</th>
                          <th bgcolor="#7acdf9">	Approval	</th>
                          <th bgcolor="#7acdf9">	Tanggal	</th>
                          <th bgcolor="#7acdf9">	Voucher	</th>
                          <th bgcolor="#7acdf9">	Aktual Bayar	</th>
                          <th>	Check	</th>
                          <th>	Daerah</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                          $no = 1;
                          foreach ($stkbops as $key) :
                         ?>
                         <tr>
                          <td>  <?php echo $no; ?> </td>
                          <td>	<?php echo $key['nomorstkb']; ?>	</td>
                          <td>	<?php echo $key['project']; ?>	</td>
                          <td>
                            <?php
                            $db2 = $this->load->database('database_kedua', TRUE);
                            $idnya = $key['kode_iddata'];
                            $carikodenya = "SELECT Nama,level FROM id_data WHERE Id='$idnya'";
                            $ckck = $db2->query($carikodenya)->row_array();
                            echo $ckck['Nama'];
                            ?>
                          </td>
                          <td>  <?php echo $ckck['level']; ?>  </td>
                          <td>	<?php echo $key['urutproject']; ?>	</td>
                          <td>	<?php echo $key['daerahasal']; ?>	</td>
                          <td>	<?php echo $key['kotadinas']; ?>	</td>
                          <td>	<?php echo $key['penugasan']; ?>	</td>
                          <td>	<?php echo $key['tglmulai']; ?>	</td>
                          <td>	<?php echo $key['tglselesai']; ?>	</td>
                          <td>	<?php echo $key['hk']; ?>	</td>
                          <td>	<?php echo $key['hl']; ?>	</td>
                          <td>	<?php echo $key['jlm_hari']; ?>	</td>
                          <td>	<?php echo $key['quota']; ?>	</td>
                          <td>	<?php echo $key['q1']; ?>	</td>
                          <td>	<?php echo $key['q2']; ?>	</td>
                          <td>	<?php echo $key['q3']; ?>	</td>
                          <td>	<?php echo $key['atmc']; ?>	</td>
                          <td>	<?php echo $key['atmm']; ?>	</td>
                          <td>	<?php echo $key['tlr_psh']; ?>	</td>
                          <td>	<?php echo $key['telp_cbg']; ?>	</td>
                          <td>	<?php echo $key['sapubersih']; ?>	</td>
                          <td>	<?php echo $key['bpjs']; ?>	</td>
                          <td>	<?php echo $key['lumpsumharian']; ?>	</td>
                          <td>	<?php echo $key['akomodasi']; ?>	</td>
                          <td>	<?php echo $key['lumpsumops']; ?>	</td>
                          <td>	<?php echo $key['totallumpsum']; ?>	</td>
                          <td bgcolor="#e3f3fc">	<?php echo $key['term1']; ?>	</td>
                          <td bgcolor="#e3f3fc">	<?php echo $key['approval1']; ?>	</td>
                          <td bgcolor="#e3f3fc">	<?php echo $key['tglbayar1']; ?>	</td>
                          <td bgcolor="#e3f3fc">	<?php echo $key['novoucher1']; ?>	</td>
                          <td bgcolor="#e3f3fc">	<?php echo $key['aktualbayar1']; ?>	</td>
                          <td bgcolor="#bde4f9">	<?php echo $key['term2']; ?>	</td>
                          <td bgcolor="#bde4f9">	<?php echo $key['approval2']; ?>	</td>
                          <td bgcolor="#bde4f9">	<?php echo $key['tglbayar2']; ?>	</td>
                          <td bgcolor="#bde4f9">	<?php echo $key['novoucher2']; ?>	</td>
                          <td bgcolor="#bde4f9">	<?php echo $key['aktualbayar2']; ?>	</td>
                          <td bgcolor="#7acdf9">	<?php echo $key['term3']; ?>	</td>
                          <td bgcolor="#7acdf9">	<?php echo $key['approval3']; ?>	</td>
                          <td bgcolor="#7acdf9">	<?php echo $key['tglbayar3']; ?>	</td>
                          <td bgcolor="#7acdf9">	<?php echo $key['novoucher3']; ?>	</td>
                          <td bgcolor="#7acdf9">	<?php echo $key['aktualbayar3']; ?>	</td>
                          <td>	<?php echo $key['perdin']; ?>	</td>
                          <td>	<?php echo $key['check']; ?>	</td>
                        </tr>
                         <?php
                         $no++;
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

<div class="modal fade" id="edit-matrixperdin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Edit Matrix Perdin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('groupCosting1/ubah') ?>">
                    <input type="hidden" name="no" id="no">

                    <div class="form-group">
                      <label>Kota Asal</label>
                        <input type="text" id="ka" name="kotaasal" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Kota Tujuan</label>
                        <input type="text" id="kt" name="kotatujuan" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Jenis</label>
                        <input type="text" id="j" name="jenis" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>

                    <div class="form-group">
                      <label>Honor</label>
                        <input type="number" id="mh" name="matrixhonor" class="form-control form-control-user" aria-describedby="emailHelp" placeholder="">
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
	$('#edit-matrixperdin').on('show.bs.modal', function (event) {
		var div = $(event.relatedTarget);
		var modal = $(this)

		modal.find('#no').attr("value", div.data('id'));
		modal.find('#ka').attr("value", div.data('ka'));
    modal.find('#kt').attr("value", div.data('kt'));
		modal.find('#j').attr("value", div.data('j'));
    modal.find('#mh').attr("value", div.data('mh'));
	});
});
</script>
