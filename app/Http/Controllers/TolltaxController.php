<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tolltax;
use App\Models\Axe;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;

class TolltaxController extends Controller
{
    public function index()
    {
        $toll = Tolltax::with('axel', 'toLocation', 'fromLocation')->get();
        return view('backend.tolltax.index', compact('toll'));
    }

    public function create()
    {
        $axe = Axe::all();
        $location = Location::all();
        return view('backend.tolltax.create', compact('axe', 'location'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'carno' => 'required|string',
            'aadhar' => 'required|string',
            'intime' => 'required',
            'outtime' => 'required',
            'from' => 'required|exists:locations,id',
            'to' => 'required|exists:locations,id',
            'axeid' => 'required|exists:axes,id',
        ]);
      
        // Fetch the locations
        $fromLocation = Location::findOrFail($request->from);
        $toLocation = Location::findOrFail($request->to);

        // Calculate distance
        $distance = $this->calculateDistance($fromLocation, $toLocation);

        // Determine the tax rate based on the axle number
        $taxRate = $this->getTaxRate($request->axeid);
       
        $tax = $distance * $taxRate; // Calculate the tax

        // Create the toll record
        Tolltax::create([
           
           
            'from' => $request->from,
            'to' => $request->to,
            'axeid' => $request->axeid,
           
            'tax' => $tax, // Save the calculated tax
        ]);

        return redirect()->route('backend.tolltax.index')->with('success', 'Toll added successfully.');
    }

    protected function calculateDistance(Location $fromLocation, Location $toLocation)
    {
        // Assuming you have latitude and longitude columns in your locations table
        $earthRadius = 6371; // Radius of the Earth in km

        $latFrom = deg2rad($fromLocation->latitude);
        $lonFrom = deg2rad($fromLocation->longitude);
        $latTo = deg2rad($toLocation->latitude);
        $lonTo = deg2rad($toLocation->longitude);

        $latDiff = $latTo - $latFrom;
        $lonDiff = $lonTo - $lonFrom;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
             cos($latFrom) * cos($latTo) *
             sin($lonDiff / 2) * sin($lonDiff / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c; // Distance in km
    }

    protected function getTaxRate($axeId)
    {   
        $axe = Axe::find($axeId);
        
        return $axe ? $axe->tax_rate : 0; // Return 0 if no rate is found
    }

    public function edit($id)
    {
        $toll = Tolltax::findOrFail($id);
        $location = Location::all();
        $axe = Axe::all();
        return view('backend.tolltax.edit', compact('toll', 'axe', 'location'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing Toll entry
        $toll = Tolltax::findOrFail($id);

        // Validate the incoming request
        $request->validate([
           
            'axeid' => 'required|integer|exists:axes,id',
            
            'from' => 'required|integer|exists:locations,id',
            'to' => 'required|integer|different:from|exists:locations,id',
        ]);

        // Update the Toll entry
        $toll->carno = $request->carno;
        $toll->aadhar = $request->aadhar;
        $toll->axeid = $request->axeid; // This is fine, we're using it to fetch taxRate
        $toll->intime = $request->intime;
        $toll->outtime = $request->outtime;
        $toll->from = $request->from;
        $toll->to = $request->to;

        // Calculate distance and toll tax before saving
        $locationFrom = Location::findOrFail($request->from);
        $locationTo = Location::findOrFail($request->to);
        
        $distance = $this->calculateDistance($locationFrom, $locationTo);
        $toll->distance_km = $distance; // Save distance in the toll record

        // Retrieve the tax rate using the axeid
        $taxRate = $this->getTaxRate($request->axeid); // Use the axeid from request
        $toll->tax = $distance * $taxRate; // Calculate and set tax

        // Save the updated toll record
        $toll->save();

        // Prepare success notification
        $notification = [
            'message' => 'Toll updated successfully.',
            'alert-type' => 'success'
        ];

        return redirect()->route('backend.tolltax.index')->with($notification);
    }

    public function destroy($id)
    {
        $toll = Tolltax::findOrFail($id);
        $toll->delete();
        $notification = [
            'message' => 'Toll deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('backend.tolltax.index')->with($notification);
    }

    public function generatePDF($id)
    {
        $toll = Tolltax::findOrFail($id); // Get the toll record by ID
        $pdf = Pdf::loadView('pdf.tolltax1', compact('toll'));

        // Download the PDF
        return $pdf->download('tolltax_receipt.pdf');
    }
}
