<?php 
namespace App\Models;

use CodeIgniter\Model;

class MenuModel extends Model{
    protected $table      = 'tb_menu';
    protected $primaryKey = 'id';
    protected $allowedFields= ['id', 'nama', 'harga', 'jenis', 'stok'];
    // Uncomment below if you want add primary key,
    // protected $primaryKey = 'id';
}