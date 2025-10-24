<?php

namespace App\Controllers;

use App\Models\Project_model;
use CodeIgniter\RESTful\ResourceController;

class Porto_controller extends BaseController{

    public function index()
    {
        return view('portofolio/main_layout');
    }

}