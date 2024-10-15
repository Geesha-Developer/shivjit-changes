<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipper;
use App\Models\Country;
use App\Models\States;
use App\Models\Consignee;
use Illuminate\Support\Facades\Auth;


class ShipperController extends Controller
{
    public function shipper_insert(Request $request){
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        // echo '<pre>'; print_r($request->all()); die();
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
        Shipper::create([
            'user_id' => $user->id,
            'shipper_name' => $request->input('shipper_name') ?? '',
            'shipper_address' => $request->input('shipper_address') ?? '',
            'shipper_country' => $request->input('customer_country') ?? '',
            'shipper_state' => $request->input('customer_state') ?? '',
            'shipper_city' => $request->input('customer_city') ?? '',
            'shipper_zip' => $request->input('customer_zip') ?? '',
            'shipper_contact_name' => $request->input('shipper_contact_name') ?? '',
            'shipper_contact_email' => $request->input('shipper_contact_email') ?? '',
            'shipper_telephone' => $request->input('shipper_telephone') ?? '',
            'shipper_extn' => $request->input('shipper_extn') ?? '',
            'shipper_toll_free' => $request->input('shipper_toll_free') ?? '',
            'shipper_fax' => $request->input('shipper_fax') ?? '',
            'shipper_hours' => $request->input('shipper_hours') ?? '',
            'shipper_appointments' => $request->input('shipper_appointments') ?? '',
            'shipper_major_intersections' => $request->input('shipper_major_intersections') ?? '',
            'shipper_status' => $request->input('shipper_status') ?? '',
            'shipper_shipping_notes' => $request->input('shipper_shipping_notes') ?? '',
            'shipper_internal_notes' => $request->input('shipper_internal_notes') ?? '',
        ]);
    }

        if($request->same_as_consignee) {
            $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
            Consignee::create([
                'user_id' => $user->id,
                'consignee_name' => $request->input('shipper_name') ?? '',
                'consignee_address' => $request->input('shipper_address') ?? '',
                'consignee_country' => $request->input('customer_country') ?? '',
                'consignee_state' => $request->input('customer_state') ?? '',
                'consignee_city' => $request->input('customer_city') ?? '',
                'consignee_zip' => $request->input('customer_zip') ?? '',
                'consignee_contact_name' => $request->input('shipper_contact_name') ?? '',
                'consignee_contact_email' => $request->input('shipper_contact_email') ?? '',
                'consignee_telephone' => $request->input('shipper_telephone') ?? '',
                'consignee_ext' => $request->input('shipper_extn') ?? '',
                'consignee_toll_free' => $request->input('shipper_toll_free') ?? '',
                'consignee_fax' => $request->input('shipper_fax') ?? '',
                'consignee_hours' => $request->input('shipper_hours') ?? '',
                'consignee_appointments' => $request->input('shipper_appointments') ?? '',
                'consignee_major_intersections' => $request->input('shipper_major_intersections') ?? '',
                'consignee_status' => $request->input('shipper_status') ?? '',
                'consignee_shipping_notes' => $request->input('shipper_shipping_notes') ?? '',
                'consignee_internal_notes' => $request->input('shipper_internal_notes') ?? '',
            ]);
        }
        return redirect()->back()->with('success', 'Data has been saved!');
    }

    public function shipper(){
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $countries = Country::orderByRaw('CASE WHEN id = 233 THEN 0 WHEN id = 39 THEN 1 ELSE 2 END')->orderBy('name')->get();
        $states = States::all();
        $fetch = Shipper::where('user_id', $user->id)->get();
        return view('broker.shipper', compact('countries', 'states', 'fetch','user'));
    }

    public function shipper_list(){
        
        $fetch = Shipper::all();
        return view('broker.shipper_list',['fetch' => $fetch]);
    }

    public function delete_shipper($id)
    {
    $external = Shipper::find($id);
    if ($external) {
        $external->delete();
        return redirect()->back()->with('success', 'Row deleted successfully');
    } else {
        return redirect()->back()->with('error', 'Row not found');
    }
    }

    public function shipperEdit($id)
    {
        $shipper = Shipper::findOrFail($id);
        $countries = Country::orderByRaw('CASE WHEN id = 233 THEN 0 WHEN id = 39 THEN 1 ELSE 2 END')->orderBy('name')->get();
        $states = States::all(); // Assuming your state model is named State, change accordingly if different
        return view('broker.shipper_edit', compact('shipper', 'countries', 'states'));
    }

    public function shipperUpdate(Request $request, $id)
    {
        $request->validate([
            'shipper_name' => 'required|string|max:255',
            'shipper_address' => 'nullable|string|max:255',
            'customer_country' => 'required|string|max:255',
            'customer_state' => 'required|string|max:255',
            'customer_city' => 'nullable|string|max:255',
            'customer_zip' => 'nullable|string|max:255',
            'shipper_contact_name' => 'nullable|string|max:255',
            'shipper_contact_email' => 'nullable|email|max:255',
            'shipper_telephone' => 'required|string|max:255',
            'shipper_extn' => 'nullable|string|max:255',
            'shipper_fax' => 'nullable|string|max:255',
            'shipper_appointments' => 'nullable|string|max:255',
            'shipper_status' => 'required|string|max:255',
            'shipper_shipping_notes' => 'nullable|string',
            'shipper_internal_notes' => 'nullable|string',
        ]);

        $shipper = Shipper::findOrFail($id);
        $shipper->update([
            'user_id' => auth()->user()->id,
            'shipper_name' => $request->input('shipper_name'),
            'shipper_address' => $request->input('shipper_address'),
            'shipper_country' => $request->input('customer_country'),
            'shipper_state' => $request->input('customer_state'),
            'shipper_city' => $request->input('customer_city'),
            'shipper_zip' => $request->input('customer_zip'),
            'shipper_contact_name' => $request->input('shipper_contact_name'),
            'shipper_contact_email' => $request->input('shipper_contact_email'),
            'shipper_telephone' => $request->input('shipper_telephone'),
            'shipper_extn' => $request->input('shipper_extn'),
            'shipper_fax' => $request->input('shipper_fax'),
            'shipper_appointments' => $request->input('shipper_appointments'),
            'shipper_status' => $request->input('shipper_status'),
            'shipper_shipping_notes' => $request->input('shipper_shipping_notes'),
            'shipper_internal_notes' => $request->input('shipper_internal_notes'),
        ]);

        return redirect()->route('shipper')->with('success', 'Shipper data has been updated!');
    }


    public function destroyshipper($id)
    {
        $shipper = Shipper::find($id);
        
        if ($shipper) {
            $shipper->delete();
            return redirect()->back()->with('success', 'Shipper deleted successfully.');
        }

        return redirect()->back()->with('error', 'Shipper not found.');
    }
}
