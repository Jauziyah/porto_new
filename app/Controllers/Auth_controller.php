<?php 

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth_controller extends Controller{
    public function index()
    {
        return view('auth');
    }
}

?>