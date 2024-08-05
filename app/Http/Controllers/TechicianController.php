<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Technicians;

class TechicianController extends Controller
{
    public function index() {
        $technicians = Technicians::all();
        return view('list-tech', compact('technicians'));
    }

    public function create() {
        return view('add-tech');
    }

    public function store(Request $request) {
        $request -> validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255|unique:technicians',
            'phone' => 'required|string|max:15'
        ]);

        $technician = new Technicians();
        $technician->id = uuid_create();
        $technician->name = $request->input('name');
        $technician->phone = $request->input('phone');
        $technician->email = $request->input('email');
        $technician->save();

        return redirect('/add-tech')->with('success', 'Technician added successfully!');
    }

    public function destroy($id) {
        $technician = Technicians::find($id);

        if ($technician) {
            $technician->delete();
            return response()->json([
                'success' => true,
                'message' => 'Technician deleted successfully!'
            ]);
        } else {
            return response()->json([
                'error' => false,
                'message' => 'Technician not found!',
                404
            ]);
        }
    } 
}
