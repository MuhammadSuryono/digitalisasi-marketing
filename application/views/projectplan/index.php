   <!-- Begin Page Content -->
   <div class="container-fluid">
       <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>
       <!-- Page Heading -->
       <h1 class="h3 mb-4 text-gray-800">Project</h1>
       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Data Project Plan</h6>
           </div>
           <div class="card-body">
               <!-- <a href="#" class="btn btn-primary mb-4" data-toggle="modal" data-target="#exampleModal">Add</a> -->
               <div class="table-responsive">
                   <table class="table table-bordered dt-responsive" id="dataTable" width="100%" cellspacing="0">
                       <thead>
                           <tr class="text-center">
                               <th>No</th>
                               <th>Nomor Request</th>
                               <th>Kode Request</th>
                               <th>Subject Request</th>
                               <th>Template Project</th>
                               <th>Nama Perusahaan</th>
                               <th>Methodology</th>
                               <th>Topic Research</th>
                               <th>Action</th>
                           </tr>
                       </thead>
                       <tbody>
                           <?php
                            $no = 1;
                            foreach ($project as $data) {
                            ?>
                               <tr>
                                   <td class="text-center align-middle"><?php echo $no ?></td>
                                   <td class="text-center align-middle"><?php echo $data['nomor_rfq'] ?></td>
                                   <td class="text-center align-middle"><?php echo $data['kode_project'] ?></td>
                                   <td class="text-center align-middle"><?php echo $data['nama_project'] ?></td>
                                   <td class="text-center align-middle"><?php $nama_template = $data['nama_template'] != null ? $data['nama_template'] : '-';
                                                                        echo $nama_template ?></td>
                                   <td class="text-center align-middle"><?php echo $data['nama_perusahaan'] ?></td>
                                   <td class="text-center align-middle"><?php $cekMetode = @unserialize($data['id_methodology']);
                                                                        if ($cekMetode !== false) {
                                                                            $metodes = array();
                                                                            foreach ($cekMetode as $id_metode) {
                                                                                $metode = $this->Methodology_model->getMethodologyById($id_metode);
                                                                                $metodes[] = $metode['keterangan'];
                                                                            }
                                                                            echo implode(', ', $metodes);
                                                                        } else {
                                                                            $metode = $this->Methodology_model->getMethodologyById($data['id_methodology']);
                                                                            if ($metode != null) {
                                                                                echo $metode['keterangan'];
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                        }
                                                                        ?></td>
                                   <td class="text-center align-middle"><?php $cekTopic = @unserialize($data['id_topic']);
                                                                        if ($cekTopic !== false) {
                                                                            $topics = array();
                                                                            foreach ($cekTopic as $id_topic) {
                                                                                $topic = $this->Topic_model->getTopicById($id_topic);
                                                                                $topics[] = isset($topic['keterangan']);
                                                                            }
                                                                            echo implode(', ', $topics);
                                                                        } else {
                                                                            $topic = $this->Topic_model->getTopicById($data['id_topic']);
                                                                            if ($topic != null) {
                                                                                echo $topic['keterangan'];
                                                                            } else {
                                                                                echo '-';
                                                                            }
                                                                        }
                                                                        ?></td>
                                   <td class="text-center align-middle">
                                       <a href="<?php echo base_url('projectPlan/view/' . $data['id_project_plan']) ?>" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Project Plan"><i class="fas fa-puzzle-piece"></i></a>
                                       <a href="<?php echo base_url('projectSpec/view/' . $data['nomor_rfq']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Project Spec"><i class="fas fa-angle-double-right"></i></a>
                                       <a href="<?php echo base_url('projectDocument/document/' . $data['nomor_rfq']) ?>" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="top" title="Project Document"><i class="fas fa-file-alt"></i></a>
                                       <a href="<?php echo base_url('projectPlan/hapus') ?>/<?php echo $data['id_project_plan'] ?>" class="btn btn-danger btn-sm tombol-hapus" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fas fa-trash fa-sm"></i></a>
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

   </div>
   <!-- /.container-fluid -->
   </div>
   <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel">Form Tambah</h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form action="<?php echo base_url('projectPlan/tambah') ?>" method="POST">
                       <div class="form-group">
                           <label>Project</label>
                           <select name="nomor_rfq" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih project...">
                               <?php foreach ($rfq as $db) : ?>
                                   <?php $data = $this->Rfq_model->getRfqById($db);  ?>
                                   <option value="<?php echo $data['nomor_rfq'] ?>"><?php echo $data['nama'] ?> - <?php echo $data['nomor_rfq'] ?></option>
                               <?php endforeach; ?>
                           </select>
                       </div>
                       <div class="form-group">
                           <label>Template Project Plan</label>
                           <select name="id_template_project" class="selectpicker show-tick form-control" data-live-search="true" title="Pilih template...">
                               <?php foreach ($projectplan as $data) : ?>
                                   <option value="<?php echo $data['id_template_project'] ?>"><?php echo $data['nama_template'] ?></option>
                               <?php endforeach; ?>
                           </select>
                           </select>
                       </div>

               </div>
               <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                   <button type="submit" class="btn btn-primary">Save</button>
               </div>
               </form>
           </div>
       </div>
   </div> -->