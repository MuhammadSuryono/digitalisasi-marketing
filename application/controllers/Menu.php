<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('masuk') != true) {
            $url = base_url();
            redirect($url);
        }

        role_access();

        $this->load->model('Menu_model');
        $this->load->library('form_validation');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['menu'] = $this->Menu_model->getAllMenu();
        $this->load->view('templates/header');
        $this->load->view('menu/index', $data);
        $this->load->view('templates/footer');
    }

    public function submenu($id)
    {
        $data['submenu'] = $this->Menu_model->getAllSubMenu($id);
        $data['menu'] = $this->Menu_model->getMenuByid($id);

        $this->db->join('daftar_dept', 'daftar_dept.id_dept = menu_akses.id_dept');
        $data['akses'] = $this->db->get('menu_akses')->result();

        $this->load->view('templates/header');
        $this->load->view('menu/submenu', $data);
        $this->load->view('templates/footer');
    }

    public function submenustrip($id)
    {
        $data['submenustrip'] = $this->Menu_model->getAllSubMenuStrip($id);
        $data['submenu'] = $this->Menu_model->getSubmenuByid($id);

        $this->db->join('daftar_dept', 'daftar_dept.id_dept = menu_akses.id_dept');
        $data['akses'] = $this->db->get('menu_akses')->result();

        $this->load->view('templates/header');
        $this->load->view('menu/submenustrip', $data);
        $this->load->view('templates/footer');
    }

    public function subtambah()
    {
        $this->Menu_model->tambahsub();
        $this->session->set_flashdata('flash', 'Ditambahkan');

        redirect('menu/submenu/'.$this->input->post('id_menu'));
    }

    public function subedit()
    {
        $this->Menu_model->editsub();
        $this->session->set_flashdata('flash', 'Diubah');

        redirect('menu/submenu/'.$this->input->post('id_menu'));
    }

    public function substriptambah()
    {
        $this->Menu_model->tambahsubstrip();
        $this->session->set_flashdata('flash', 'Ditambahkan');

        redirect('menu/submenustrip/'.$this->input->post('id_submenu'));
    }

    public function substripedit()
    {
        $this->Menu_model->editsubstrip();
        $this->session->set_flashdata('flash', 'Diubah');

        redirect('menu/submenustrip/'.$this->input->post('id_submenu'));
    }

    public function addRolesub()
    {
        $data = $this->Menu_model->tambahRolesub();

        echo json_encode($data);
    }

    public function deleteRolesub()
    {
        $data = $this->Menu_model->hapusRolesub();

        echo json_encode($data);
    }

    public function addRolesubstrip()
    {
        $data = $this->Menu_model->tambahRolesubstrip();

        echo json_encode($data);
    }

    public function deleteRolesubstrip()
    {
        $data = $this->Menu_model->hapusRolesubstrip();

        echo json_encode($data);
    }

    public function akses()
    {
        $this->db->join('daftar_dept', 'daftar_dept.id_dept = menu_akses.id_dept');
        $data['akses'] = $this->db->get('menu_akses')->result();

        $this->load->view('templates/header');
        $this->load->view('menu/akses', $data);
        $this->load->view('templates/footer');

    }

    public function aksestambah()
    {
        $this->Menu_model->tambahAkses();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('menu/akses');
    }

    public function tambah()
    {
        $this->Menu_model->tambahDataMenu();
        $this->session->set_flashdata('flash', 'Ditambahkan');
        redirect('menu');
    }

    public function hapus($id)
    {
        $this->Menu_model->hapusDataMenu($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu');
    }

    public function deletesub($id)
    {   
        $idm = $_GET['menu'];
        $this->Menu_model->deleteSub($id);
		$this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu/submenu/'.$idm);
    }


    public function deletesubstrip($id)
    {   
        $idm = $_GET['menu'];
        $this->Menu_model->deleteSubstrip($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('menu/submenustrip/'.$idm);
    }

    public function ubah($id)
    {
        $this->Menu_model->ubahDataMenu($id);
        $this->session->set_flashdata('flash', 'Diubah');
        redirect('menu');
    }
}
