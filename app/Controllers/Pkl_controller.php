<?php
namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;

class Pkl_controller extends BaseController{
    public function index(){
        return view('pages/pkl');
    }
}