<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-lg-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="<?php echo base_url('images/') ?>logo.png" class="img-fluid rounded-circle" alt="Responsive image" style="margin-top:-40px; width:50%">
                                    <?php if ($this->session->flashdata('flash')) : ?>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <strong><?php echo $this->session->flashdata('flash'); ?>.</strong>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <h1 class="h4 text-gray-900 mb-4"><i class="fas"></i>Login <b>Digitalisasi</b></h1>
                                </div>
                                <form method="POST" action=<?php echo base_url('auth/auth') ?> class="user">
                                    <div class="form-group">
                                        <input type="text" name="user" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="User">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <hr>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <input type="hidden" name="continue" value="<?= $this->input->get('continue') ?>">
                                </form>
                                <!-- <hr>
                                 <div class="text-center">
                                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="<?php echo base_url('auth/register'); ?>">Create an Account!</a>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>