<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toll;
use App\Models\newtoll;
use App\Models\Axe;
use App\Models\Location;
use Barryvdh\DomPDF\Facade\Pdf;

class TollController extends Controller
{
    public function viewpdftest($id)
    {
        // just
        $toll = Toll::findOrFail($id); // Get the toll record by ID
        $newtoll = newtoll::with(['fromLocation', 'toLocation', 'relatedtoll'])->where('axel_no',$toll->axeid1)->get();
     
        // Calculate total from newtoll records
        $totalAmount = $newtoll->sum('total');
        return view('pdf.tolltax',compact('toll','newtoll','totalAmount'));
    }
    public function index()
    {
        $toll = Toll::with('axel', 'toLocation', 'fromLocation')->get();
       
        return view('backend.toll.index', compact('toll'));
    }

    public function create()
    {
        
        $location = Location::all();
        $newtoll = newtoll::all();
        return view('backend.toll.create', compact( 'location','newtoll'));
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
           // 'axeid' => 'required|exists:axes,id',
            'total_tax'=> 'required'
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
        Toll::create([
            'carno' => $request->carno,
            'aadhar' => $request->aadhar,
            'intime' => $request->intime,
            'outtime' => $request->outtime,
            'from' => $request->from,
            'to' => $request->to,
            'axeid1'=> $request->axeid,
            'distance_km' => $distance, // Save the calculated distance
            'tax' => $tax, // Save the calculated tax
            'total_tax' => $request->total_tax,
       
        ]);

        return redirect()->route('backend.toll.index')->with('success', 'Toll added successfully.');
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
        $toll = Toll::findOrFail($id);
        $location = Location::all();
        $axe = Axe::all();
        $newtoll = newtoll::all();
        return view('backend.toll.edit', compact('toll', 'axe', 'location','newtoll'));
    }

    public function update(Request $request, $id)
    {
        // Fetch the existing Toll entry
        $toll = Toll::findOrFail($id);

        // Validate the incoming request
        $request->validate([
            'carno' => 'required|string|max:255',
            'aadhar' => 'required|string|max:12',
            //'axeid' => 'required|integer|exists:axes,id',
            'intime' => 'required',
            'outtime' => 'required',
            'from' => 'required|integer|exists:locations,id',
            'to' => 'required|integer|different:from|exists:locations,id',
        ]);

        // Update the Toll entry
        $toll->carno = $request->carno;
        $toll->aadhar = $request->aadhar;
        $toll->axeid1 = $request->axeid; // This is fine, we're using it to fetch taxRate
        $toll->intime = $request->intime;
        $toll->outtime = $request->outtime;
        $toll->from = $request->from;
        $toll->to = $request->to;
        $toll->total_tax = $request->total_tax;

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

        return redirect()->route('backend.toll.index')->with($notification);
    }

    public function destroy($id)
    {
        $toll = Toll::findOrFail($id);
        $toll->delete();
        $notification = [
            'message' => 'Toll deleted successfully.',
            'alert-type' => 'success'
        ];
        return redirect()->route('backend.toll.index')->with($notification);
    }

  
    public function generatePDF($id)
{
    $toll = Toll::findOrFail($id); // Get the toll record by ID
    $newtoll = newtoll::with(['fromLocation', 'toLocation', 'relatedtoll'])->where('axel_no',$toll->axeid1)->get();

    // Calculate total from newtoll records
    $totalAmount = $newtoll->sum('total'); // Adjust this based on your data structure if necessary

    // Pass the total amount to the view
    $pdf = Pdf::loadView('pdf.tolltax', compact('toll', 'newtoll', 'totalAmount'));

    // Download the PDF
    return $pdf->download('tolltax_receipt.pdf');
}

}
