<?php 

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth_controller extends Controller{
    public function index()
    {
        return view('auth');
    }

    public function login()
    {
        $session = session();
        $userModel = new UserModel();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $user = $userModel->getUserByUsername($username);
        if ($user && $user['password'] === $password) { // Plaintext comparison for simplicity
            $session->set('isLoggedIn', true);
            $session->set('username', $user['username']);
            return redirect()->to('/content-management');
        } else {
            $session->setFlashdata('error', 'Invalid username or password');
            return redirect()->to('/auth');
        }
    }

    public function dashboard()
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth');
        }
        return view('dashboard');
    }

    public function contentManagement()
    {
        $session = session();
        if (! $session->get('isLoggedIn')) {
            return redirect()->to('/auth');
        }
        return view('pages/content_management');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/auth');
    }
}

?>