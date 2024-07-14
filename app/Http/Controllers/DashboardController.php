<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $getRoleCounter = $this->countUsersByRole();

        return view('dashboard', $getRoleCounter);
    }

    private function countUsersByRole()
    {
        $userCount = User::where('role', 'user')->count();
        $adminCount = User::where('role', 'admin')->count();
        $superAdminCount = User::where('role', 'super_admin')->count();

        return [
            'userCount' => $userCount,
            'adminCount' => $adminCount,
            'superAdminCount' => $superAdminCount,
        ];
    }
}
