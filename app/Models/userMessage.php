<?php
namespace App\Models;


use CodeIgniter\Model;

class userMessage extends Model{
   protected $table = 'tbl_messages';
   protected $primaryKey = 'id';
   protected $allowedFields = ['token', 'message', 'created'];
}
?>