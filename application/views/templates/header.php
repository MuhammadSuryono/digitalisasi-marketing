<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Digitalisasi</title>
    <link rel="shortcut icon" href="<?php echo base_url('images/') ?>logo.png" />
    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?php echo base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/'); ?>css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo base_url('assets/'); ?>css/timeline.css" rel="stylesheet">

    <link href="<?php echo base_url('assets/'); ?>/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.bootstrap4.min.css">
    <style type="text/css">
        .custom-file {
            overflow: hidden !important;
        }

        .custom-file-input {
            white-space: nowrap !important;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>css/font-awesome.min.css">
    <script src="<?php echo base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>

    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <link href="<?php echo base_url('scan/'); ?>css/style2.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href='https://fonts.googleapis.com/css?family=Titillium+Web:400,200,300,600,700' rel='stylesheet' type='text/css'>

    <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/'); ?>vendor/bootstrap/js/bootstrap-select.min.js"></script>
    <script src="<?php echo base_url('assets/sweet/') ?>js/sweetalert2.all.min.js"></script>

    <style type="text/css">
        #snackbar {
            min-width: 250px;
            /* Set a default minimum width */
            margin-left: -125px;
            /* Divide value of min-width by 2 */
            background-color: white;
            /* Black background color */
            position: fixed;
            /* Sit on top of the screen */
            z-index: 1;
            /* Add a z-index if needed */
            right: 1%;
            /* Center the snackbar */
            top: 10px;
            /* 30px from the bottom */
        }

        #snackbar2 {
            min-width: 250px;
            /* Set a default minimum width */
            margin-left: -125px;
            /* Divide value of min-width by 2 */
            text-align: center;
            /* Centered text */
            border-radius: 2px;
            /* Rounded borders */
            padding: 10px;
            /* Padding */
            position: fixed;
            /* Sit on top of the screen */
            z-index: 1;
            /* Add a z-index if needed */
            left: 50%;
            /* Center the snackbar */
            top: 30px;
            /* 30px from the bottom */
        }

        .help-research-brief {
            position: relative;
            display: inline-block;
        }

        .help-research-brief .tooltiptext {
            visibility: hidden;
            width: 250px;
            background-color: black;
            color: #fff;
            border-radius: 6px;
            padding: 5px 5px;
            text-align: left;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            bottom: 100%;
            left: 50%;
            margin-left: -125px;
        }

        .help-research-brief .tooltiptext.right {
            margin-left: -250px;
        }

        .help-research-brief .tooltiptext-bottom {
            visibility: hidden;
            width: 250px;
            background-color: black;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 5px 5px;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
            top: 100%;
            left: 50%;
            margin-left: -60px;
        }


        .help-research-brief:hover .tooltiptext {
            visibility: visible;
        }

        .help-research-brief:hover .tooltiptext-bottom {
            visibility: visible;
        }

        .timeline {
            list-style-type: none;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .li {
            transition: all 200ms ease-in;
        }

        .timestamp {
            margin-bottom: 20px;
            padding: 0px 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-weight: 100;
        }

        .status {
            padding: 0px 20px;
            display: flex;
            justify-content: center;
            border-top: 2px solid #3a5ed8;
            position: relative;
            transition: all 200ms ease-in;
        }

        .status h4 {
            font-weight: 400;
            margin-top: 10px;
            font-size: 20px;
            text-align: center;
            margin-right: 8px;
        }

        .status:before {
            content: "";
            width: 15px;
            height: 15px;
            background-color: white;
            border-radius: 15px;
            border: 1px solid #3a5ed8;
            position: absolute;
            top: -8px;
            left: 42%;
            transition: all 200ms ease-in;
        }

        .li.complete .status {
            border-top: 2px solid #3a5ed8;
        }

        .li.complete .status:before {
            background-color: #3a5ed8;
            border: none;
            transition: all 200ms ease-in;
        }

        .li.complete .status h4 {
            color: #3a5ed8;
        }

        @media (min-device-width: 320px) and (max-device-width: 700px) {
            .timeline {
                list-style-type: none;
                display: block;
            }

            .li {
                transition: all 200ms ease-in;
                display: flex;
                width: inherit;
            }

            .timestamp {
                width: 100px;
            }

            .status:before {
                left: -8%;
                top: 30%;
                transition: all 200ms ease-in;
            }
        }

        .clearfix {
            overflow: auto;
        }
    </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand // EDIT ADAM SANTOSO -->
            <div id="digitalisasiBrand"><a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url('dasboard') ?>">
                    Digitalisasi
                </a></div>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('dasboard') ?>">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dasboard</span></a>
            </li>


            <?php if ($this->session->userdata('ses_role') == 1) { ?>

                <!--li class="nav-item">
                <hr class="sidebar-divider my-0">
                    <a class="nav-link" href="<?= base_url('menu') ?>">
                        <i class="fas fa-fw fa-bars"></i>
                        <span>Menu Management</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collaps6" aria-expanded="true" aria-controls="collapseTwo">
                        <i class="fas fa-user-lock"></i>
                        <span>Menu Admin</span>
                    </a>
                    <div id="collaps6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Menu Admin</h6>
                            <a class="collapse-item" href="<?php echo base_url('menu') ?>">Access Setting</a>
                            <a class="collapse-item" href="<?php echo base_url('user') ?>">User Setting</a>
                        </div>
                    </div>
                </li-->
            <?php } ?>





            <!-- Divider -->
            <hr class="sidebar-divider">

            <?php
            $level = $this->session->userdata('ses_level');
            $akses = $this->session->userdata('ses_role');
            $headmenu = $this->db->get('menu')->result();

            foreach ($headmenu as $db) {
                $this->db->order_by('id_submenu', 'ASC');
                if ($akses == 0) {
                    $roles = $this->db->get_where('role_access_submenu', ['id_dept' => $level, 'id_menu' => $db->id_menu]);
                } elseif ($akses == 1) {
                    $roles = $this->db->get_where('submenu', ['id_menu' => $db->id_menu]);
                }
                //var_dump($roles->result());
                //die;
                if ($roles->num_rows() > 0) { ?>
                    <!-- Heading -->
                    <div class="sidebar-heading">
                        <?= $db->menu ?>
                    </div>
                    <?php foreach ($roles->result() as $data) { ?>
                        <?php $menu = $this->db->get_where('submenu', ['id_submenu' => $data->id_submenu])->row(); ?>
                        <?php if ($menu->sub == 0) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo base_url($menu->control_menu) ?>">
                                    <i class="<?= $menu->icon ?> fa-fw"></i>
                                    <span><?= $menu->nama_menu ?></span></a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapse<?= $menu->id_submenu ?>" aria-expanded="true" aria-controls="collapseTwo">
                                    <i class="fas <?= $menu->icon ?>"></i>
                                    <span><?= $menu->nama_menu ?></span>
                                </a>
                                <div id="collapse<?= $menu->id_submenu ?>" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                                    <div class="bg-white py-2 collapse-inner rounded">
                                        <h6 class="collapse-header"><?= $menu->nama_menu ?></h6>

                                        <?php
                                        if ($akses == 0) {
                                            $this->db->join('submenu_strip', 'submenu_strip.id_submenu_strip = role_access_submenustrip.id_submenu_strip');
                                            $this->db->order_by('role_access_submenustrip.id_submenu_strip', 'ASC');
                                            $rolesStrip = $this->db->get_where('role_access_submenustrip', ['role_access_submenustrip.id_dept' => $level, 'submenu_strip.id_submenu' => $menu->id_submenu])->result();
                                        } elseif ($akses == 1) {
                                            $this->db->order_by('id_submenu_strip', 'ASC');
                                            $rolesStrip = $this->db->get_where('submenu_strip', ['id_submenu' => $menu->id_submenu])->result();
                                        }
                                        ?>

                                        <?php foreach ($rolesStrip as $isi) { ?>
                                            <?php $menuStrip = $this->db->get_where('submenu_strip', ['id_submenu_strip' => $isi->id_submenu_strip])->row(); ?>
                                            <a class="collapse-item" href="<?php echo base_url($menuStrip->control_menu) ?>"><?= $menuStrip->nama_sub_strip ?></a>
                                        <?php } ?>

                                    </div>
                                </div>
                            </li>
                        <?php } ?>
                    <?php } ?>
                    <hr class="sidebar-divider">
                <?php } ?>
            <?php } ?>

            <!-- Heading -->


            <!--li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collaps6" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-object-group"></i>
                    <span>STKB</span>
                </a>
                <div id="collaps6" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">STKB</h6>
                        <a class="collapse-item" href="</?php echo base_url('stkbdasartrk') ?>">Dasar TRK</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbperdin') ?>">Matrix Perdin</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbproject') ?>">1 - Project</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbTrk') ?>">STKB Transaksi</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbOps') ?>">STKB Operasional</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbMasterplan') ?>">Master Plan</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbPrintTrk') ?>">Print STKB Trk</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbPrintOps') ?>">Print STKB Ops</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbSkenario') ?>">Skenario</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbProjectSken') ?>">STKB Project Skenario</a>
                        <a class="collapse-item" href="</?php echo base_url('stkbSdm') ?>">SDM Aktif Update</a>
                    </div>
                </div>
            </li-->
            <!-- Divider -->
            <!--hr class="sidebar-divider d-none d-md-block"-->

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fas fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><i>Welcome</i>, <?php echo $this->session->userdata('ses_nama') ?></span>
                                <img class="img-profile rounded-circle" src="<?php echo base_url('assets/') ?>img/profil.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="<?php echo base_url('user/changePassword') ?>">
                                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Change Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -- >