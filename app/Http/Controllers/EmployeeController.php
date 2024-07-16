<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = new User();
        return view('add-employee', compact('employee'));
    }

    public function createEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:super_admin,admin,user',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect('/add-employee')->with('success', 'Employee created successfully!');
    }

    public function showEmployee()
    {
        $users = User::all();
        return view('list-employee', compact('users'));
    }

    public function deleteEmployee($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->delete();
            return response()->json(['success' => true, 'message' => 'Employee deleted successfully!']);
        } else {
            return response()->json(['error' => false, 'message' => 'Employee not found!'], 404);
        }
    }
}
