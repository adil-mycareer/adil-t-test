<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        try {
            return view('admin.home');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }

    public function userApproval(Request $request)
    {
        try {
            dd('userApproval');
        } catch (\Throwable $th) {
            info($th->getMessage());
        }
    }
}
