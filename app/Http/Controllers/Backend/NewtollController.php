<?php

namespace App\Http\Controllers\Backend;
use App\Models\relatedtoll;
use App\Models\newToll;
use App\Models\Axe;
use App\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class NewtollController extends Controller
{
    public function index()
    {   
        $newtoll = newToll::with('relatedtoll','axel','toLocation','fromLocation')->get();
       
        return view('backend.newtoll.index', compact('newtoll'));
    }

    public function create()
    {
        $axe=Axe::all();
        $location=Location::all();
        return view('backend.newtoll.create',compact('axe','location'));
    }

    public function store(Request $request)
    {
           // Validate the request
    $validatedData = $request->validate([
        'from' => 'required|string|max:255',
        'to' => 'required|string|max:255',
        'axel_no' => 'required|string|max:255|unique:newtolls,axel_no', // Ensure axel_no is unique
    ]);

    // Create a new toll entry
    $form = newtoll::create($validatedData);
       // $form = newtoll::create($request->only(['from', 'to', 'axel_no']));
      
        $total = 0;

        foreach ($request->tolls as $toll) {
            $tollEntry = new relatedtoll([
                'tollname' => $toll['tollname'],
                'price' => $toll['price']
            ]);
            $form->relatedtoll()->save($tollEntry);
            $total += $toll['price'];
        }

        $form->update(['total' => $total]);
        $notification = array(
            'message' => 'NewToll created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.newtoll.index')->with($notification);
    }
    public function edit($id)
    {
        $toll = newtoll::with('relatedtoll')->findOrFail($id);
        $location=Location::all();
        $axe=Axe::all();
        return view('backend.newtoll.edit', compact('toll','location','axe'));
    }

    public function update(Request $request, $id)
    {
        $form = newtoll::findOrFail($id);

           // Validate the incoming request data
    $request->validate([
        'from' => 'required|string|max:255',
        'to' => 'required|string|max:255',
        'axel_no' => 'required|string|max:255|unique:newtolls,axel_no,' . $form->id, // Check uniqueness excluding the current record
    ]);

    // Update the record
    $form->update($request->only(['from', 'to', 'axel_no']));

        // Delete existing tolls
        $form->relatedtoll()->delete();

        $total = 0;

        // Add updated tolls
        foreach ($request->relatedtoll as $toll) {
            $tollEntry = new relatedtoll([
                'tollname' => $toll['tollname'],
                'price' => $toll['price']
            ]);
            $form->relatedtoll()->save($tollEntry);
            $total += $toll['price'];
        }

        // Update total price
        $form->update(['total' => $total]);
        $notification = array(
            'message' => 'NewToll created successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.newtoll.index')->with($notification);
    }
    public function destroy($id)
    {
        $form = newtoll::findOrFail($id);

        // Deleting the related tolls
        $form->relatedtoll()->delete();

        // Deleting the form
        $form->delete();
        $notification = array(
            'message' => 'NewToll Deleted successfully.',
            'alert-type' => 'success'
        );
        return redirect()->route('backend.newtoll.index')->with($notification);
    }
    public function getTax($id)
{
    // Fetch the total tax for the selected axel ID
    $toll = NewToll::find($id);
  
    if ($toll) {
        return response()->json([
            'success' => true,
            'total' => $toll->total // Assuming 'total' is the name of the field storing the tax
        ]);
    }

    return response()->json([
        'success' => false,
        'message' => 'Tax not found'
    ]);
}
public function generatePDF()
{
    $newtoll = newtoll::with(['fromLocation', 'toLocation', 'relatedtoll'])->get(); // Adjust the relationship as necessary

    $pdf = PDF::loadView('newtoll_pdf', compact('newtoll'));
    return $pdf->download('new_toll_view.pdf');
}
}
