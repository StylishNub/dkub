<?php

namespace App\Controllers;

class BaseUserController extends BaseController
{
    public function __construct()
    {
        helper('url');

        if (!session()->get('isLoggedIn')) {
            redirect()->to('/error/unauthorized')->send();
            exit;
        }

        if (session()->get('level') !== 'user') {
            redirect()->to('/error/forbidden')->send();
            exit;
        }
    }
}
