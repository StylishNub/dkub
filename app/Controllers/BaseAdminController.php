<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class BaseAdminController extends BaseController
{
    public function __construct()
    {
        helper('url'); // biar redirect->to() jalan

        if (!session()->get('isLoggedIn')) {
            redirect()->to('/error/unauthorized')->send();
            exit;
        }

        if (session()->get('level') !== 'admin') {
            redirect()->to('/error/forbidden')->send();
            exit;
        }
    }
}
