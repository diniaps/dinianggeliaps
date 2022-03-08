<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;

class MenuController extends Controller{
    /**
     * instance of the main Request object.
     * 
     * @var HTTP\
     */
    
    protected $REQUEST;

    function __construct()
    {
        $this->menu  =  new MenuModel();
    }
    public function index()
    {
        $data ['data'] = $this->menu->findAll();
        return view ('MenuList', $data);
    }
    public function create()
    {
        $data =  array (
            'nama'=>$this->request->getPost('nama'),
            'harga'=>$this->request->getPost('harga'),
            'jenis'=>$this->request->getPost('jenis'),
            'stok'=>$this->request->getPost('stok'),
            // 'gambar'=>$this->request->getPost('gambar'),
        ) ;
        $this->menu->insert($data);
        return redirect('menu')->with('success', 'Data Berhasil di Simpan');
    }
    public function delete($id)
    {
        $this->menu->delete($id);
        return redirect('menu')->with('success', 'Data Berhasil di Hapus');
    }
      
    public function edit($id)
    {
        $data= array(
                'nama'=>$this->request->getPost('nama'),
                'harga'=>$this->request->getPost('harga'),
                'jenis'=>$this->request->getPost('jenis'),
                'stok'=>$this->request->getPost('stok'),
                // 'gambar'=>$this->request->getPost('gambar'),   
            );
            $this->menu->update($id,$data);
            return redirect('menu')->with('success','Data Berhasil di Edit');
    }
    public function hapus($id)
    {
        #code...
    }
    
}