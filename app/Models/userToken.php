<?php
namespace App\Models;


use CodeIgniter\Model;

class userToken extends Model{
   protected $table = 'tbl_users';
   protected $primaryKey = 'token';
   protected $allowedFields = ['name'];
}
?>