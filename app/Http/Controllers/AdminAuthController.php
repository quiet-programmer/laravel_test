<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    public function __construct()
    {
        // middleware to check if user is already logged in
        $this->middleware(['admin_login']);
    }

    public function authenticate()
    {
        return view('admin.index');
    }
}
