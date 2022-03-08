<?php 
namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model{
    protected $table      = 'tb_user';
    protected $primaryKey = 'id';
    protected $allowedFields= ['id', 'nama', 'username', 'password', 'role'];
    // Uncomment below if you want add primary key,
    // protected $primaryKey = 'id';
}