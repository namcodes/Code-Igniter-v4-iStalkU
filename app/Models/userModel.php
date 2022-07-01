<?php
namespace App\Models;


use CodeIgniter\Model;

class userModel extends Model{
   protected $table = 'tbl_users';
   protected $primaryKey = 'id';
   protected $allowedFields = ['token', 'name', 'date'];
}
?>