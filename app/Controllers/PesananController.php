<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\MenuModel;
use App\Models\PesananModel;
use App\Models\DetailPesananModel;
use CodeIgniter\HTTP\Request;


class PesananController extends Controller{
    /**
     * instance of the main request object.
     * 
     * @var HTTP\IncomingRequest
     */
    protected $request;
    
    function __construct ()
    {
        $this->menu = new MenuModel();
        $this->session = session();
        $this->pesanan = new PesananModel();
        $this->detail= new DetailPesananModel();
    }
    public function index()
    {
        $data ['menus']=$this->menu->select('id, nama')->findAll();
        if(session('cart') != null) {
            $data['menu'] = array_values(session('cart'));
        } else{
            $data['menu'] = null;
        }
        return view("PesananList", $data);
    }
    public function addCart()
    {
        # code...
        $id = $this->request->getPost('menu_id');
        $jumlah = $this->request->getPost('jumlah');
        $menu = $this->menu->find($id);
        if($menu)
        {
            $isi =  array(
                'menu_id' => $id,
                'nama' => $menu['nama'],
                'harga' => $menu['harga'],
                'jumlah'=> $jumlah
            );
        }
        

        if  ($this->session-> has ('cart')){
            $index= $this-> cek ($id);
            $cart = array_values(session('cart'));
            if($index == -1){
                array_push($cart, $isi);
            }else{
                $cart[$index]['jumlah'] +=$jumlah;
            }
            $this->session->set('cart', $cart);
        }else{
            $this->session->set('cart', array($isi));
        }
        return redirect('pesanan')->with('success', 'Data Berhasil di Tambahkan '. $menu['nama']);
    }
    public function cek($id)
    {
        $cart = array_values(session('cart'));
        for($i = 0; $i < count($cart); $i++){
            if($cart[$i]['menu_id'] == $id){
                return $i;
            }
        }
        return -1;
    }
    public function hapusCart($id)
    {
       #code
       $index = $this->cek($id);
       $cart=  array_values(session('cart'));
       unset($cart[$index]);
       $this->session->set('cart',$cart);
        return redirect('pesanan')->with('success', "Data Berhasil di Hapus");
    }
    public function simpan (){
        if (session('cart') != null){
            $dtharga=0;
            $datapesanan = array(
                'tanggal' =>date('Y/m/d'),
                'no_meja' =>$this->request-> getPost('no_meja'),
                'nama_pemesan' =>$this->request-> getPost('nama_pemesan'),
                'total_harga' =>'0'
                
            );
            $id =$this->pesanan->insert($datapesanan);
            $cart =array_values(session('cart'));
            foreach($cart as $val){
                $datadetail = array(
                    'pesanan_id'=>$id,
                    'menu_id'=> $val['menu_id'],
                    'jumlah'=> $val['jumlah'],
                );
                $dtharga+=$val['jumlah'] *$val ['harga'];
                $this->detail->insert($datadetail);
            }
            $dtharga= array(
                'total_harga'=>$dtharga
            );
            $this->pesanan->update($id, $dtharga);
            $this->session->remove('cart');
            return redirect('pesanan')->with('success', 'Data Berhasil di Simpan');
        }
    }
}