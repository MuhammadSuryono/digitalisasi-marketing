<?php

function configEmail()
{

	$config = [
		'protocol'    => 'smtp',
		'smtp_host'   => '192.168.8.3',
		'smtp_user'   => 'admin.web@mri-research-ind.com',
		'smtp_pass'   => 'w3bminMRI',
		'smtp_port'	  => 25,
		'smtp_timeout' => 30,
		'mailtype'    => 'html',
		'charset'     => 'iso-8859-1',
		'crlf'        => "\r\n",
		'newline'     => "\r\n",
	];

	return $config;
}

function qrcode()
{
	$CI = get_instance();

	$CI->load->library('ciqrcode'); //pemanggilan library QR CODE

	$config['cacheable']    = true; //boolean, the default is true
	$config['cachedir']     = './assets/'; //string, the default is application/cache/
	$config['errorlog']     = './assets/'; //string, the default is application/logs/
	$config['imagedir']     = './assets/images/'; //direktori penyimpanan qr code
	$config['quality']      = true; //boolean, the default is true
	$config['size']         = '1024'; //interger, the default is 1024
	$config['black']        = array(224, 255, 255); // array, default is array(255,255,255)
	$config['white']        = array(70, 130, 180); // array, default is array(0,0,0)

	return $config;
}

function role_access()
{
	$CI = get_instance();
	$id = $CI->session->userdata('ses_level');
	$menu = $CI->uri->segment(1);

	if ($CI->session->userdata('ses_role') != 1) {

		$men = $CI->db->get_where('submenu', ['control_menu' => $menu]);
		if ($men->num_rows() > 0) {
			$menuId = $men->row()->id_submenu;

			$query = $CI->db->get_where('role_access_submenu', [
				'id_dept' => $id,
				'id_submenu' => $menuId,
			]);

			if ($query->num_rows() < 1) {
				redirect('auth/blocked');
			}
		} else {
			$strip = $CI->db->get_where('submenu_strip', ['control_menu' => $menu])->row();
			$menuId = $strip->id_submenu_strip;

			$query = $CI->db->get_where('role_access_submenustrip', [
				'id_dept' => $id,
				'id_submenu_strip' => $menuId,
			]);

			if ($query->num_rows() < 1) {
				redirect('auth/blocked');
			}
		}
	}
}
