 <!-- Begin Page Content -->
 <div class="container-fluid">
     <div class="flash-data" data-flashdata="<?php echo $this->session->flashdata('flash'); ?>"></div>

     <div class="row justify-content-center">
        <div class="col-md-7">
            <h1 class="h3 mb-4 text-gray-800 ">Budget Project</h1>
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <h6 class="m-0 font-weight-bold text-primary">Form</h6>
                 </div>

                 <div class="card-body">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <td width="150px">Kode Project</td>
                            <td><?php echo $rfq['kode_project'] ?></td>
                        </tr>
                        <tr>
                            <td>Nama Project</td>
                            <td><?php echo $rfq['nama_project'] ?></td>
                        </tr>
                    </table>

                    <form>
                        <div class="form-group row">
                            <label for="nomor_rfq" class="col-sm-3 col-form-label">Nilai Project</label>
                            <div class="col-sm-6 input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="text" value="0" id="formattedNumberField" name="project" class="form-control formattedNumberField">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nomor_rfq" class="col-sm-3 col-form-label">Budget Max</label>
                            <div class="col-sm-6 input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">Rp</span>
                                </div>
                                <input type="text" value="0" id="formattedNumberField" name="project" class="form-control formattedNumberField">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan">Project Spec</label>
                            <textarea class="form-control" name="project_plan" id="projectPlan" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info">Save</button>
                            <a href="<?php echo base_url('budgetProject') ?>" class="btn" >Back</a>
                        </div>
                    </form>
                 </div>
             </div>
         </div>
     </div>

 </div>
 <!-- /.container-fluid -->
 </div>
 <!-- End of Main Content -->
