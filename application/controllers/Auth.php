<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends MY_Controller {
 public function __construct(){
 parent::__construct();
 $this->load->model('UserModel');
 }
 public function index(){
 if($this->session->userdata('authenticated')) // Jika usersudah login (Session authenticated ditemukan)
 redirect('page/home'); // Redirect ke page home
 // function render_login tersebut dari filecore/MY_Controller.php
 $this->render_login('login'); // Load view login.php
 }
 public function login(){
    $username = $this->input->post('username'); // Ambil isi dariinputan username pada form login
    $password = md5($this->input->post('password')); // Ambil isidari inputan password pada form login dan encrypt dengan md5
    $user = $this->UserModel->get($username); // Panggil fungsiget yang ada di UserModel.php
    if(empty($user)){ // Jika hasilnya kosong / user tidakditemukan
    $this->session->set_flashdata('message', 'Username tidakditemukan'); // Buat session flashdata
    redirect('auth'); // Redirect ke halaman login
    }else{
    if($password == $user->password){ // Jika password yangdiinput sama dengan password yang didatabase
    $session = array(
    'authenticated'=>true, // Buat session authenticateddengan value true
    'username'=>$user->username, // Buat session username
    'nama'=>$user->nama, // Buat session nama
    'role'=>$user->role // Buat session role
    );
    $this->session->set_userdata($session); // Buat sessionsesuai $session
    redirect('page/home'); // Redirect ke halaman home
    }else{
    $this->session->set_flashdata('message', 'Password salah'); // Buat session flashdata
    redirect('auth'); // Redirect ke halaman login
    }
    }
    }
    public function logout(){
    $this->session->sess_destroy(); // Hapus semua session
    redirect('auth'); // Redirect ke halaman login
    }
   }