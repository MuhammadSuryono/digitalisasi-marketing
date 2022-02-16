<?php 

class Menu_model extends CI_model
{
    public function getAllMenu()
    {
        return $this->db->get('menu')->result_array();
    }

    public function getAllSubMenu($id)
    {
        $this->db->select('*');
        $this->db->from('submenu');
        $this->db->join('menu', 'submenu.id_menu = menu.id_menu');
        $this->db->where('submenu.id_menu', $id);

        return $this->db->get()->result();
    }

    public function getAllSubMenuStrip($id)
    {
        $this->db->select('*, submenu_strip.control_menu as ctrl');
        $this->db->from('submenu_strip');
        $this->db->join('submenu', 'submenu_strip.id_submenu = submenu.id_submenu');
        $this->db->where('submenu_strip.id_submenu', $id);

        return $this->db->get()->result();
    }

    public function tambahDataMenu()
    {
        $data = array(
            "menu" => $this->input->post('menu', true),
        );

        $this->db->insert('menu', $data);
    }

    public function getRole($dept, $submenu)
    {
        return $this->db->get_where('role_access_submenu', ['id_dept' => $dept, 'id_submenu'=>$submenu])->num_rows();
    }

    public function getRoleStrip($dept, $submenu)
    {
        return $this->db->get_where('role_access_submenustrip', ['id_dept' => $dept, 'id_submenu_strip'=>$submenu])->num_rows();
    }

    public function tambahRolesub()
    {
        $data = [
           "id_dept" => $this->input->post('dept', true), 
           "id_submenu" => $this->input->post('sub', true), 
           "id_menu" => $this->input->post('menu', true), 
        ];

        $this->db->insert('role_access_submenu', $data);
    }

    public function tambahRolesubstrip()
    {
        $data = [
           "id_dept" => $this->input->post('dept', true),  
           "id_submenu_strip" => $this->input->post('sub', true), 
        ];

        $this->db->insert('role_access_submenustrip', $data);
    }

    public function tambahsub()
    {
        if($this->input->post('sub', true) == true){
            $sub = 1;
        }else{
            $sub = 0;
        }

        $data = [
           "id_menu" => $this->input->post('id_menu', true), 
           "nama_menu" => $this->input->post('submenu', true), 
           "icon" => $this->input->post('icon', true), 
           "control_menu" => $this->input->post('ctrl', true), 
           "sub" => $sub, 
        ];

        $this->db->insert('submenu', $data);
    }

    public function tambahsubstrip()
    {
        $data = [
           "id_submenu" => $this->input->post('id_submenu', true), 
           "nama_sub_strip" => $this->input->post('submenu', true),  
           "control_menu" => $this->input->post('ctrl', true), 
        ];

        $this->db->insert('submenu_strip', $data);
    }

    public function editsub()
    {
        if($this->input->post('sub', true) == true){
            $sub = 1;
        }else{
            $sub = 0;
        }

        $data = [
           "id_menu" => $this->input->post('id_menu', true), 
           "nama_menu" => $this->input->post('submenu', true), 
           "icon" => $this->input->post('icon', true), 
           "control_menu" => $this->input->post('ctrl', true), 
           "sub" => $sub, 
        ];

        $this->db->where('id_submenu', $this->input->post('id'));
        $this->db->update('submenu', $data);
    }

     public function editsubstrip()
    {
        $data = [
           "id_submenu" => $this->input->post('id_submenu', true), 
           "nama_sub_strip" => $this->input->post('submenu', true),  
           "control_menu" => $this->input->post('ctrl', true), 
        ];

        $this->db->where('id_submenu_strip', $this->input->post('id'));
        $this->db->update('submenu_strip', $data);
    }

    public function deleteSub($id)
    {
         $this->db->delete('submenu', array('id_submenu' => $id));
    }

    public function deleteSubstrip($id)
    {
         $this->db->delete('submenu_strip', array('id_submenu_strip' => $id));
    }

    public function hapusRolesub()
    {
        $this->db->delete('role_access_submenu', array('id_dept' => $this->input->post('dept', true), 'id_submenu'=>$this->input->post('sub', true)));
    }

    public function hapusRolesubstrip()
    {
        $this->db->delete('role_access_submenustrip', array('id_dept' => $this->input->post('dept', true), 'id_submenu_strip'=>$this->input->post('sub', true)));
    }

    public function tambahAkses()
    {
        $data = array(
            "id_dept" => $this->input->post('dept', true),
        );

        $this->db->insert('menu_akses', $data);
    }

    public function hapusDataMenu($id)
    {
        // $this->db->where('id', $id);
        $this->db->delete('menu', array('id_menu' => $id));
    }

    public function getMenuById($id)
    {
        return $this->db->get_where('menu', array('id_menu' => $id))->row_array();
    }

    public function getSubmenuById($id)
    {
        return $this->db->get_where('submenu', array('id_submenu' => $id))->row_array();
    }

    public function ubahDataMenu()
    {
        $data = array(
            "menu" => $this->input->post('menu', true),
        );

        $this->db->where('id_menu', $this->input->post('id'));
        $this->db->update('menu', $data);
    }

    // public function cariDataMahasiswa()
    // {
    //     $keyword = $this->input->post('keyword', true);
    //     $this->db->like('nama', $keyword);
    //     $this->db->or_like('jurusan', $keyword);
    //     $this->db->or_like('nrp', $keyword);
    //     $this->db->or_like('email', $keyword);
    //     return $this->db->get('mahasiswa')->result_array();
    // }
}
