<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Toll;
use App\Models\newtoll;
use App\Models\Axe;
use App\Models\Location;
use App\Models\FastagRecharge;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime; 
use Carbon\Carbon;

class TollController extends Controller
{
    public function index()
    {
        $toll = Toll::with('axel', 'toLocation', 'fromLocation')->get();
      
        return view('backend.toll.index', compact('toll'));
    }

    public function create()
    {
        
        $location =Location::where('deletestatus', 1)->get();
        $newtoll = newtoll::all();

        return view('backend.toll.create', compact( 'location','newtoll'));
    }

    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'carno' => 'required|string',
           
            'intime' => 'required',
           
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
         'aadhar' => $request->aadhar ?: 'NA',

            'intime' => $request->intime,
          
            'from' => $request->from,
            'to' => $request->to,
            'axeid1'=> $request->axel_no,
            'distance_km' => $distance, // Save the calculated distance
            'tax' => $tax, // Save the calculated tax
            'total_tax' => $request->total_tax,
            'recharge'=> $request->recharge
       
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
           
            'from' => 'required|integer|exists:locations,id',
            'to' => 'required|integer|different:from|exists:locations,id',

        ]);

        // Update the Toll entry
        $toll->carno = $request->carno;
        $toll->aadhar = $request->aadhar?: 'NA';
        $toll->axeid1 = $request->axel_no; // This is fine, we're using it to fetch taxRate
    
        $toll->intime = $request->intime;
       
        $toll->from = $request->from;
        $toll->to = $request->to;
        $toll->total_tax = $request->total_tax;
        $toll->recharge= $request->recharge;

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
        $recharge = FastagRecharge::first();
        // Pass the total amount to the view
        $pdf = Pdf::loadView('pdf.tolltax', compact('toll', 'newtoll', 'totalAmount','recharge'));
    
        // Download the PDF
        return $pdf->download('tolltax_receipt.pdf');
    }
//     public function viewpdftest($id)
//     {
//     $toll = Toll::findOrFail($id); // Get the toll record by ID

//     $newtoll = NewToll::with(['fromLocation', 'toLocation', 'relatedtoll'])
//         ->where('axel_no', $toll->axeid1)
//         ->where('from', $toll->from)
//         ->where('to', $toll->to)
//         ->get();

//     $recharge = FastagRecharge::first();
//     $totalAmount = $newtoll->sum('total');

//     $processedTollData = [];
//     $currentDebitTime = new DateTime($toll->intime); // Starting debit time
//     $currentDate = $currentDebitTime->format('Y-m-d'); // Track current date
//     $additionalHours = 0; // Initialize additional hours

//     foreach ($newtoll as $form) {
//         foreach ($form->relatedtoll as $relatedToll) {
//             $hoursToAdd = (int)$relatedToll->time; // Get the number of hours to add

//             // Add hours to the current debit time
//             $currentDebitTime->modify("+{$hoursToAdd} hours");

//             // Format the current debit time for comparison
//             $formattedTime = $currentDebitTime->format('H:i:s');

//             // Check if the current time is either >= 23:45 or < 07:00
//             if ($formattedTime >= '23:45:00' || $formattedTime < '07:00:00') {
//                 // If the time exceeds 23:45 or is before 7:00
//                 // Set the current debit time to 7 AM next day plus any additional hours
//                 $additionalHours += $hoursToAdd; // Accumulate additional hours
//                 $currentDebitTime = (clone $currentDebitTime)->modify('today')->setTime(7, 0); // Set to 7 AM
//             }
//             // Add additional hours if any
//             if ($additionalHours > 0) {
//                 $currentDebitTime->modify("+{$additionalHours} hours");
//                 $additionalHours = 0; // Reset additional hours after applying them
//             }

//             // Format the debit time for display
//             $formattedDebitTime = $currentDebitTime->format('h:i A');

//             // Get the new date after time adjustment
//             $newDate = $currentDebitTime->format('Y-m-d');
//             $formattedDate = $currentDebitTime->format('j M Y');

//             // Check if the date has changed and add a new date line if it has
//             if ($newDate != $currentDate) {
//                 // Insert a date line to indicate the change
//                 $processedTollData[] = [
//                     'showDate' => true,
//                     'date' => $formattedDate,
//                 ];
//                 $currentDate = $newDate; // Update the current date to the new date
//             }

//             // Prepare toll data for the view
//             $processedTollData[] = [
//                 'tollname' => $relatedToll->tollname ?? 'N/A',
//                 'formattedDebitTime' => $formattedDebitTime,
//                 'price' => $relatedToll->price ?? 'N/A',
//                 'relatedTollId' => $relatedToll->id,
//                 'showDate' => false, // Do not show date for this item
//             ];
//         }
//     }

//     // Reverse the processed toll data to meet your requirement
//     $processedTollData = array_reverse($processedTollData);

//     return view('pdf.tolltax', compact('toll', 'newtoll', 'totalAmount', 'recharge', 'processedTollData'));
// }
public function viewpdftest($id)
{
    $toll = Toll::findOrFail($id); // Get the toll record by ID

    $newtoll = NewToll::with(['fromLocation', 'toLocation', 'relatedtoll'])
        ->where('axel_no', $toll->axeid1)
        ->where('from', $toll->from)
        ->where('to', $toll->to)
        ->get();

    $recharge = FastagRecharge::first();
    $totalAmount = $newtoll->sum('total');

    $processedTollData = [];
    $currentDebitTime = new DateTime($toll->intime); // Starting debit time
    $currentDate = $currentDebitTime->format('Y-m-d'); // Track current date
    $additionalHours = 0; // Initialize additional hours

   foreach ($newtoll as $form) {
    foreach ($form->relatedtoll as $relatedToll) {
        // Get the number of hours and minutes to add from the related toll
        $timeToAdd = explode(':', $relatedToll->time); // Assuming 'time' is stored in 'HH:MM' format
        $hoursToAdd = (int)$timeToAdd[0]; // Extract hours
        $minutesToAdd = (int)$timeToAdd[1] ?? 0; // Extract minutes, default to 0 if not set

        // Add hours and minutes to the current debit time
        $currentDebitTime->modify("+{$hoursToAdd} hours +{$minutesToAdd} minutes");

        // Format the debit time for display
        $formattedDebitTime = $currentDebitTime->format('h:i A');

        // Get the new date after time adjustment
        $newDate = $currentDebitTime->format('Y-m-d');
        $formattedDate = $currentDebitTime->format('j M Y');

        // Check if the date has changed and add a new date line if it has
        if ($newDate != $currentDate) {
            // Insert a date line to indicate the change
            $processedTollData[] = [
                'showDate' => true,
                'date' => $formattedDate,
            ];
            $currentDate = $newDate; // Update the current date to the new date
        }

        // Prepare toll data for the view
        $processedTollData[] = [
            'tollname' => $relatedToll->tollname ?? 'N/A',
            'formattedDebitTime' => $formattedDebitTime,
            'price' => $relatedToll->price ?? 'N/A',
            'relatedTollId' => $relatedToll->id,
            'showDate' => false, // Do not show date for this item
        ];
    }
}


    // Reverse the processed toll data to meet your requirement
    $processedTollData = array_reverse($processedTollData);

    return view('pdf.tolltax', compact('toll', 'newtoll', 'totalAmount', 'recharge', 'processedTollData'));
}




    public function getTollDetails(Request $request)
   {
    // Validate the incoming request
    $from = $request->query('from');
    $to = $request->query('to');

    // Check if a toll exists with the matching 'from' and 'to' values
    $newToll = NewToll::where('from', $from)
                      ->where('to', $to)
                      ->first();
                    

    if ($newToll) {
        // If a match is found, return the axel_no and total_tax
        return response()->json([
            'success' => true,
            'axel_no' => $newToll->axel_no,
        'total_tax' => $newToll->total, // Assuming 'total' is the tax field
        ]);
    } else {
        // If no match is found, return an error response
        return response()->json([
            'success' => false,
            'message' => 'No toll found for this route.'
        ]);
    }
}

}
