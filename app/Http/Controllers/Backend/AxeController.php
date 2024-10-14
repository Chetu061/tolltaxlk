<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Axe;

class AxeController extends Controller
{
    // Display a listing of the axes
    public function index()
    {
        $axes = Axe::all(); // Fetch all axes
        return view('backend.axe.index', compact('axes')); // Pass axes to the view
    }

    // Show the form for creating a new axe
    public function create()
    {
        return view('backend.axe.create'); // Render the create view
    }

    // Store a newly created axe in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'axelno' => 'required|string|unique:axes',
            'tax_rate' => 'nullable|numeric|min:0', // Ensure tax_rate is a positive number
        ]);
    
        $axe = new Axe();
        $axe->axelno = $request->axelno; // Assign axelno from request
        $axe->tax_rate = $request->tax_rate; // Assign tax_rate from request
    
        $axe->save(); // Save the axe to the database
    
        $notification = [
            'message' => 'Axel created successfully.',
            'alert-type' => 'success'
        ];
    
        return redirect()->route('backend.axe.index')->with($notification); // Redirect with success message
    }
    
    // Show the form for editing the specified axe
    public function edit($id)
    {
        $axe = Axe::findOrFail($id); // Find the axe by ID or fail
        return view('backend.axe.edit', compact('axe')); // Pass axe to the edit view
    }

    // Update the specified axe in storage
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'axelno' => 'required|string|unique:axes,axelno,' . $id, // Ensure unique axelno but ignore the current record
            'tax_rate' => 'required|numeric|min:0', // Ensure tax_rate is numeric and required
        ]);

        $axe = Axe::findOrFail($id); // Find the axe by ID or fail
        $axe->axelno = $request->axelno; // Update axelno
        $axe->tax_rate = $request->tax_rate; // Update tax_rate
        $axe->save(); // Save the changes

        // Notification
        $notification = [
            'message' => 'Axle updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.axe.index')->with($notification); // Redirect with success message
    }

    // Remove the specified axe from storage
    public function destroy($id)
    {  
        $axe = Axe::findOrFail($id); // Find the axe by ID or fail
        $axe->delete(); // Delete the axe

        $notification = [
            'message' => 'Axle deleted successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.axe.index')->with($notification); // Redirect with success message
    }
}
