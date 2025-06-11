<?php

namespace App\Controllers;

class Error extends BaseController
{
    public function notFound()
    {
        return view('errors/custom_404');
    }

    public function unauthorized()
    {
        return view('errors/unauthorized');
    }

    public function forbidden()
    {
        return view('errors/forbidden');
    }


}
