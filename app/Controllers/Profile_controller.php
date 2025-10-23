<?php

namespace App\Controllers;

use App\Models\Profile_model;
use CodeIgniter\Controller;

class Profile_controller extends Controller
{
    public function testProfile()
    {
        $profileModel = new Profile_model();

        // Fetch data using your model methods
        $data = $profileModel->getProfileData();

        // Output the results as JSON for quick verification
        return $this->response->setJSON($data);
    }
}