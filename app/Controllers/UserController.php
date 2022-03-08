<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UserModel;

class UserController extends Controller{
    protected $REQUEST;
    
    function __construct()
    {
        $this->users  =  new UserModel();
    }
    public function index()
    {
        $data ['data'] = $this->users->findAll();
        return view ('UserList', $data);
    }
    public function create()
    {
        $data =  array (
            'nama'=>$this->request->getPost('nama'),
            'username'=>$this->request->getPost('username'),
            'password'=>password_hash($this->request->getPost('password'),PASSWORD_DEFAULT),
            'role'=>$this->request->getPost('role'),
    
        ) ;
        $this->users->insert($data);
        return redirect('user')->with('success', 'Data berhasil disimpan');
    }
    public function delete($id)
    {
        $this->users->delete($id);
        return redirect('user')->with('success', 'Data berhasil dihapus');
    }
        //public function tampil()
        // {
            // $user = new UserModel();
            // $data ['pesan]= 'data user';
            // $data['user']=  ('UserList', $data)
        // }
        // public function simpan()
        // {
            // $user = new UserModel();
            // $data ['pesan'] = 'data user';
            // $data['user'] = 
                //$user->insert($POST);
                //return view('dashboard', $user);
                //return view redirect()->to(base_url()./user);
        //}
    public function edit($id)
    {
        $pass =$this->request->getPost('password');
        // dd($pass);
        if(empty($pass)){
            $data= array(
            'nama'=> $this->request->getPost('nama'),
            'username'=> $this->request->getPost('username'),
            'role'=> $this->request->getPost('role'),
            ) ;
        } else{
            $data= array(
                'nama'=>$this->request->getPost('nama'),
                'username'=>$this->request->getPost('username'),
                'password'=>password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'=>$this->request->getPost('role'),    
            );
           
        }
        $this->users->update($id,$data);
        return redirect('user')->with('success','data berhasil diedit');
    }
    public function tlogin()
    {
        return view('login');
    }
    public function login()
    {
        $session = session();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $data = $this->users->where('username', $username)->first();
        if ($data) {
            $pass=  $data['password'];
            $cek_pass = password_verify($password, $pass);
            if ($cek_pass){
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data ['username'],
                    'role' =>$data['role']
                ];
                $session->set($ses_data);
                return redirect()->to('/dashboard');
            } else {
                $session->setFlashdata('msg', 'password keliru ditemukan');
                return redirect('login');
        }
    } else{
        $session->setFlashdata('msg', 'username keliru ditemukan');
        return redirect('login');
    }
}
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect('login');
    }
    public function show($id)
    {
        #code...
    }
}