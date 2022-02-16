<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Template Project Plan</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Template Project Plan</h6>
        </div>

        <div class="card-body">
          <a href="" data-toggle="modal" data-target="#modalAddTPP" class="btn btn-primary mb-5">Add New Template</a>
          <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
              <thead>
                  <tr>
                      <th class="text-center align-middle">No</th>
                      <th class="text-center align-middle">Nama Template Project Plan</th>
                      <th class="text-center align-middle">Jumlah Kegiatan</th>
                      <th class="text-center align-middle">Action</th>
                  </tr>
              </thead>
              <tbody>
                 <?php
                 $no= 1;
                 foreach ($templates as $data) {
                 $kegiatan = $this->db->get_where('project_plan_template_detail', array('id_template_pp' => $data['id_template_project']))->result_array();
                 $jml = count($kegiatan);
                 ?>
                 <tr>
                     <td class="text-center align-middle"><?php echo $no ?></td>
                     <td class="text-left align-middle"><?php echo $data['nama_template'] ?></td>
                     <td class="text-center align-middle"><?php echo $jml ?> Kegiatan</td>
                     <td class="text-center align-middle">
                         <a href="<?php echo base_url('templateProjectPlan/view/'.$data['id_template_project']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Detail Kegiatan">Detail Kegiatan <i class="fas fa-angle-double-right"></i></a>
                         <a href="<?php echo base_url('templateProjectPlan/hapus/'.$data['id_template_project']) ?>" class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash fa-sm"></i></a>
                     </td>
                 </tr>
                 <?php
                 $no++;
                 }
                  ?>
              </tbody>
          </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
</div>

<div class="modal fade" id="modalAddTPP" tabindex="-1" role="dialog" aria-labelledby="modalAddTPP" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Add New Template Project Plan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('templateProjectPlan/tambah') ?>">
            <div class="modal-body">
              <div class="form-group">
                <input type="text" name="nama_template" class="form-control" placeholder="Masukan Nama Template Project Plan" required>
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
