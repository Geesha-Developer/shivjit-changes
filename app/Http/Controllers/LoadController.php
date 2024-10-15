<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\customer;
use App\Models\User;
use App\Models\Country;
use App\Models\States;
use App\Models\Cities;
use App\Models\External;
use App\Models\Shipper;
use App\Models\Load;
use App\Models\Consignee;
use App\Models\ProfileData;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Dompdf\Options;
use PDF;
use Carbon\Carbon;



class LoadController extends Controller
{
    
    public function load(){
        $user = Auth::guard('users')->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
            
        }
        $load = Load::where('user_id', $user->id)->orderBy('id', 'desc')->get();  
        $carrierNames = External::pluck('carrier_name');
        $brokerLoadStatus = Load::where('user_id', $user->id)->get();
        $allConsignees = Consignee::where('user_id',$user->id)->get();

        return view('broker.load', compact('load', 'carrierNames', 'brokerLoadStatus','allConsignees','user'));
    
    }

    
    public function load_insert(Request $request)
    {
        // dd($request->all());

            // Validate the request
    $request->validate([
        'load_bill_to' => 'required|string',
        'load_delivery_do_file' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048',
    ]);

        $yourModel = new Load();

        $shipper_name = [];
        $shipper_location = [];
        $shipper_appointment = [];
        $shipper_description = [];
        $shipper_commodity_type = [];
        $shipper_commodity_name = [];
        $shipper_qty = [];
        $shipper_weight = [];
        $shipper_value = [];
        $shipper_note = [];
        $shipper_po_number = [];
        $shipper_contact = [];

        $consignee_name = [];
        $consignee_location = [];
        $load_consignee_appointment = [];
        $consignee_description = [];
        $consignee_commodity_type = [];
        $consignee_commodity_name = [];
        $consignee_qty = [];
        $consignee_weight = [];
        $consignee_value = [];
        $load_consignee_notes = [];
        $consignee_po_number = [];
        $load_consigneer_contact = [];
        $consignee_delivery_note = [];
        $load_consignee_notes = [];
        $load_consignee_contact = [];

    
        // Process the request data
        foreach ($request->all() as $key => $value) {
            if (preg_match('/^load_shipper(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_name[$index]['name'] = $value;
            } elseif (preg_match('/^load_shipper_location(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_location[$index]['location'] = $value;
            } elseif (preg_match('/^load_shipper_description(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_description[$index]['description'] = $value;
            } elseif (preg_match('/^load_shipper_appointment(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_appointment[$index]['appointment'] = $value;
            } elseif (preg_match('/^load_shipper_commodity_type(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_commodity_type[$index]['commodity_type'] = $value;
            } elseif (preg_match('/^load_shipper_commodity(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_commodity_name[$index]['commodity_name'] = $value;
            } elseif (preg_match('/^load_shipper_qty(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_qty[$index]['shipper_qty'] = $value;
            } elseif (preg_match('/^load_shipper_weight(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_weight[$index]['shipper_weight'] = $value;
            } elseif (preg_match('/^load_shipper_value(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_value[$index]['shipper_value'] = $value;
            } elseif (preg_match('/^load_shipper_shipping_notes(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_note[$index]['shipping_notes'] = $value;
            } elseif (preg_match('/^load_shipper_po_numbers(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_po_number[$index]['shipping_po_numbers'] = $value;
            } elseif (preg_match('/^load_shipper_contact(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $shipper_contact[$index]['shipping_contact'] = $value;
            }
    
            // Continue with other shipper fields...
    
            elseif (preg_match('/^load_consignee(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_name[$index]['name'] = $value;
            } elseif (preg_match('/^load_consignee_location(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_location[$index]['location'] = $value;
            } elseif (preg_match('/^load_consignee_description(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_description[$index]['description'] = $value;
            } elseif (preg_match('/^load_consignee_appointment(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $load_consignee_appointment[$index]['appointment'] = $value;
            } elseif (preg_match('/^load_consignee_type(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_commodity_type[$index]['consignee_type'] = $value;
            } elseif (preg_match('/^load_consignee_commodity(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_commodity_name[$index]['consignee_commodity'] = $value;
            } elseif (preg_match('/^load_consignee_qty(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_qty[$index]['consignee_qty'] = $value;
            } elseif (preg_match('/^load_consignee_weight(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_weight[$index]['consignee_weight'] = $value;
            } elseif (preg_match('/^load_consignee_value(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_value[$index]['consignee_value'] = $value;
            } elseif (preg_match('/^load_consignee_delivery_notes(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_delivery_note[$index]['consignee_delivery_notes'] = $value;
            } elseif (preg_match('/^load_consignee_po_numbers(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $consignee_po_number[$index]['consignee_po_number'] = $value;
            } elseif (preg_match('/^load_consignee_contact(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $load_consigneer_contact[$index]['consignee_contact'] = $value;
            } elseif (preg_match('/^load_consignee_notes(\d*)$/', $key, $matches)) {
                $index = $matches[1] ?: 0;
                $load_consignee_notes[$index]['load_consignee_notes'] = $value;
            }
            // } elseif (preg_match('/^load_consignee_notes(\d*)$/', $key, $matches)) {
            //     $index = $matches[1] ?: 0;
            //     $consignee_note[$index]['consignee_notes'] = $value;
            // }
        }
    
        $yourModel->load_shipperr = json_encode($shipper_name);
        $yourModel->load_shipper_location = json_encode($shipper_location);
        $yourModel->load_shipper_discription = json_encode($shipper_description);
        $yourModel->load_shipper_commodity_type = json_encode($shipper_commodity_type);
        $yourModel->load_shipper_qty = json_encode($shipper_qty);
        $yourModel->load_shipper_weight = json_encode($shipper_weight);
        $yourModel->load_shipper_commodity = json_encode($shipper_commodity_name);
        $yourModel->load_shipper_value = json_encode($shipper_value);
        $yourModel->load_shipper_shipping_notes = json_encode($shipper_note);
        $yourModel->load_shipper_po_numbers = json_encode($shipper_po_number);
        $yourModel->load_shipper_contact = json_encode($shipper_contact);
        $yourModel->load_shipper_appointment = json_encode($shipper_appointment);
    
        $yourModel->load_consignee = json_encode($consignee_name);
        $yourModel->load_consignee_location = json_encode($consignee_location);
        $yourModel->load_consignee_appointment = json_encode($load_consignee_appointment);
        $yourModel->load_consignee_discription = json_encode($consignee_description);
        $yourModel->load_consignee_type = json_encode($consignee_commodity_type);
        $yourModel->load_consignee_commodity = json_encode($consignee_commodity_name);
        $yourModel->load_consignee_qty = json_encode($consignee_qty);
        $yourModel->load_consignee_weight = json_encode($consignee_weight);
        $yourModel->load_consignee_value = json_encode($consignee_value);
        $yourModel->load_consignee_po_numbers = json_encode($consignee_po_number);
        $yourModel->load_consignee_delivery_notes = json_encode($consignee_delivery_note);
        $yourModel->load_consigneer_contact = json_encode($load_consigneer_contact) ?? '';
        $yourModel->load_consigneer_notes = json_encode($load_consignee_notes);


        $yourModel->user_id = Auth::id();
        $yourModel->load_bill_to = $request->input('load_bill_to', null);
        $yourModel->load_dispatcher = $request->input('load_dispatcher') ?? '';
        $yourModel->load_status = $request->input('load_status') ?? '';
        $yourModel->load_workorder = $request->input('load_workorder') ?? '';
        $yourModel->load_payment_type = $request->input('load_payment_type') ?? '';
        $yourModel->load_type = $request->input('load_type') ?? '';
        $yourModel->load_shipper_rate = $request->input('load_shipper_rate') ?? '';
        $yourModel->load_pds = $request->input('load_pds') ?? '';
        $yourModel->load_fsc_rate = $request->input('load_fsc_rate') ?? '';
        $yourModel->load_telephone = $request->input('load_telephone') ?? '';
        $yourModel->shipper_load_other_charge = $request->input('shipper_load_other_charge') ?? '';

        $yourModel->shipper_load_final_rate = $request->input('shipper_load_final_rate') ?? '';
        



        $yourModel->load_carrier = $request->input('load_carrier') ?? '';
        $yourModel->load_carrier_phone = $request->input('load_carrier_phone') ?? '';
        $yourModel->load_advance_payment = $request->input('load_advance_payment') ?? '';
        $yourModel->load_type_two = $request->input('load_type_two') ?? '';
        $yourModel->load_billing_type = $request->input('load_billing_type') ?? '';
        $yourModel->load_mc_no = $request->input('load_mc_no') ?? '';
        $yourModel->load_equipment_type = $request->input('load_equipment_type') ?? '';
        $yourModel->load_carrier_fee = $request->input('load_carrier_fee') ?? '';
        $yourModel->load_currency = $request->input('load_currency') ?? '';
        $yourModel->load_pds_two = $request->input('load_pds_two') ?? '';
        $yourModel->load_billing_fsc_rate = $request->input('load_billing_fsc_rate') ?? '';
        $yourModel->load_final_carrier_fee = $request->input('load_final_carrier_fee') ?? '';
        $yourModel->load_other_charge = $request->input('load_other_charge') ?? '';
        $yourModel->comment = $request->input('comment') ?? '';
        $yourModel->invoice_number = '';
        $yourModel->invoice_date = '0000-00-00';
        $yourModel->load_carrier_due_date = '';
        $yourModel->carrier_mark_as_paid = '';
        $yourModel->receiving_amount = '';
        $yourModel->remaining_amount = '';
        $yourModel->carrierDoc = '';
        $yourModel->quick_pay = '';
        $yourModel->payment_method = '';
        $yourModel->ready_to_pay	 = '';
        $yourModel->cpr_check = 'Not Approved';
        $yourModel->customer_id = $request->input('customer_id') ?? '';
        $yourModel->customer_refrence_number = $request->input('customer_refrence_number') ?? '';

        if ($request->hasFile('load_delivery_do_file')) {
            $file = $request->file('load_delivery_do_file');
            if ($file->isValid()) {
                $filename = $request->input('load_bill_to') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/upload/delivery-order', $filename);
                $yourModel->load_delivery_do_file = 'upload/delivery-order/' . $filename; // Save the relative path
            } else {
                return back()->withErrors(['load_delivery_do_file' => 'Uploaded file is not valid.']);
            }
        }

        $shipperCharges = [];
        foreach ($request->shipperchargeType as $index => $chargeType) {
            $chargeAmount = $request->shipperchargeAmount[$index];
            $shipperCharges[] = [
                'type' => $chargeType,
                'amount' => $chargeAmount,
            ];
        }

        $carrierCharges = [];
        foreach ($request->shipper_type_charge as $index => $carrierchargeType) {
            $carrierchargeAmount = $request->shipper_other_charge[$index];
            $carrierCharges[] = [
                'type' => $carrierchargeType,
                'amount' => $carrierchargeAmount,
            ];
        }
        $yourModel->carrier_load_other_charge = json_encode($carrierCharges);

        $yourModel->shipper_load_other_charge = json_encode($shipperCharges);
        
        // echo "<pre>"; print_r($yourModel); die();  

        $yourModel->save();
        
        $insertedId = $yourModel->id;
        $yourModel->load_number = $insertedId;
        $yourModel->save();
    
        return redirect()->back()->with('success', 'Load details updated successfully.');
    }
    
    
    

    public function load_edit($id)
    {
        $post = Load::find($id);

        return view('broker.edit_load', compact('post'));
    }

    public function load_update(Request $request, $id)
    {
        $load = Load::find($id);
        $load->load_status = $request->input('load_status');
        $load->save();
        return redirect()->route('customer')->with('success', 'Load status updated successfully');
    }


    public function DataGetLoad()
    {
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $load = Load::where('user_id', $user->id)->orderBy('id', 'desc')->get();  
        $carrierNames = External::pluck('carrier_name');
        $brokerLoadStatus = Load::where('user_id', $user->id)->get();
        $allConsignees = Consignee::where('user_id', $user->id)->get();

        return view('broker.load', compact('load', 'carrierNames', 'brokerLoadStatus','allConsignees'));
    }




    public function fetchCarrierNames(Request $request) {
        $query = $request->input('query');
        $carrierNames = External::where('user_id', Auth::id())->where('carrier_name', 'like', '%' . $query . '%')->pluck('carrier_name');
        $customersName = customer::where('customer_name', 'like', '%'. $query . '%')->pluck('customer_name');
        return $carrierNames->toJson();
    }

    public function fetchCustomerDetails(Request $request) {
        $query = $request->input('query');
        // $customers = Customer::select('id', 'customer_name', 'adv_customer_credit_limit', 
        // DB::raw('(adv_customer_credit_limit - (SELECT COALESCE(SUM(shipper_load_final_rate), 0) FROM `load` WHERE customer_id = customers.id)) as remaining_credit'))
        // ->where('customer_name', 'like', '%' . $query . '%')
        // ->where('status', 'Approved')
        // ->distinct()
        // ->get();

        $customers = Customer::select('id', 'customer_name', 'adv_customer_credit_limit', 
                        DB::raw('(adv_customer_credit_limit - (SELECT COALESCE(SUM(shipper_load_final_rate), 0) FROM `load` WHERE customer_id = customers.id)) as remaining_credit'))
                        ->where('customer_name', 'like', '%' . $query . '%')
                        ->where('status', 'Approved')
                        ->distinct()
                        ->get();

        
        return response()->json($customers); // Return the JSON response
    }
    


    public function fetchShipperDetails(Request $request) {
        $query = $request->input('query');
        $shippers = Shipper::where('shipper_name', 'like', '%' . $query . '%')
                            ->where('user_id', Auth::id())
                            ->select('shipper_name', 'shipper_address', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_zip')
                            ->get();
        $datashipper = Shipper::get();                       
        return response()->json($shippers);
    }
    


    public function fetchConsigneeDetails(Request $request) {
        $query = $request->input('query');
        $consignees = Consignee::where('consignee_name', 'like', '%' . $query . '%')
                                ->where('user_id', Auth::id())
                                ->select('consignee_name', 'consignee_address', 'consignee_city', 'consignee_state', 'consignee_country', 'consignee_zip')
                                ->get();
        return response()->json($consignees);
    }
    

    public function fetchCarrierDetails(Request $request)
    {
        $mcNumber = $request->input('mcNumber');
        
        $carrierDetails = External::where('carrier_mc_ff_input', $mcNumber)
                                  ->where('mc_check', 'Approved')
                                  ->select('carrier_name', 'carrier_telephone')
                                  ->first();
        
        if ($carrierDetails) {
            return response()->json($carrierDetails);
        } else {
            return response()->json(null);
        }
    }
    
    

    
    public function fetchLoadData()
    {
        $openLoadsCount = Load::where('user_id', auth()->id())->where('load_status', 'Open')->count();
        $completedLoadsCount = Load::where('user_id', auth()->id())->where('load_status', 'Completed')->count();

        return response()->json([
            'openLoadsCount' => $openLoadsCount,
            'completedLoadsCount' => $completedLoadsCount,
        ]);
    }
  

    
    public function download($id)
    {
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        // Fetch the load based on user_id and id
        $load = Load::where('user_id', $user->id)
                    ->where('id', $id)
                    ->first();
    
        // Check if $load is found
        if (!$load) {
            abort(404);
        }
    
        // Consolidate consignee data
        $consigneeData = [
            'load_consignee' => $load->load_consignee,
            'load_consignee_location' => $load->load_consignee_location,
            'load_consignee_date' => $load->load_consignee_date,
            'load_consignee_discription' => $load->load_consignee_discription,
            'load_consignee_type' => $load->load_consignee_type,
            'load_consignee_qty' => $load->load_consignee_qty,
            'load_consignee_weight' => $load->load_consignee_weight,
            'load_consignee_commodity' => $load->load_consignee_commodity,
            'load_consignee_value' => $load->load_consignee_value,
            'load_consignee_delivery_notes' => $load->load_consignee_delivery_notes,
            'load_consignee_po_numbers' => $load->load_consignee_po_numbers,
            'load_consignee_appointment' => $load->load_consignee_appointment
        ];
    
        // Prepare shipper data
        $shipperData = [
            'load_shipperr' => $load->load_shipperr,
            'load_shipper_location' => $load->load_shipper_location,
            'load_shipper_date' => $load->load_shipper_date,
            'load_shipper_discription' => $load->load_shipper_discription,
            'load_shipper_commodity_type' => $load->load_shipper_commodity_type,
            'load_shipper_qty' => $load->load_shipper_qty,
            'load_shipper_weight' => $load->load_shipper_weight,
            'load_shipper_commodity' => $load->load_shipper_commodity,
            'load_shipper_value' => $load->load_shipper_value,
            'load_shipper_shipping_notes' => $load->load_shipper_shipping_notes,
            'load_shipper_po_numbers' => $load->load_shipper_po_numbers,
            'load_shipper_contact' => $load->load_shipper_contact,
            'load_shipper_appointment' => $load->load_shipper_appointment
        ];
        
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf->setOptions($options);
    
        // Pass title and other data to the view
        $view = view('broker.invoice_html', compact('load', 'consigneeData', 'shipperData'))->render();
        
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();

        $fileName = 'Load No - ' . $load->load_number . '.pdf';
        // Stream the PDF to the browser
        // return $pdf->stream('document.pdf', ['Attachment' => false]);
        return $pdf->stream($fileName, ['Attachment' => false]);

    }
    
   
    public function shipperRateCoin($id)
    {
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $load = Load::with('customer')
        ->where('user_id', $user->id)
        ->where('id', $id)
        ->first();
    

            if (!$load) {
            abort(404);
        }
        $consigneeData = [
            'load_consignee' => $load->load_consignee,
            'load_consignee_location' => $load->load_consignee_location,
            'load_consignee_date' => $load->load_consignee_date,
            'load_consignee_discription' => $load->load_consignee_discription,
            'load_consignee_type' => $load->load_consignee_type,
            'load_consignee_qty' => $load->load_consignee_qty,
            'load_consignee_weight' => $load->load_consignee_weight,
            'load_consignee_commodity' => $load->load_consignee_commodity,
            'load_consignee_value' => $load->load_consignee_value,
            'load_consignee_delivery_notes' => $load->load_consignee_delivery_notes,
            'load_consignee_po_numbers' => $load->load_consignee_po_numbers,
            'load_consignee_appointment' => $load->load_consignee_appointment
        ];
        $shipperData = [
            'load_shipperr' => $load->load_shipperr,
            'load_shipper_location' => $load->load_shipper_location,
            'load_shipper_date' => $load->load_shipper_date,
            'load_shipper_discription' => $load->load_shipper_discription,
            'load_shipper_commodity_type' => $load->load_shipper_commodity_type,
            'load_shipper_qty' => $load->load_shipper_qty,
            'load_shipper_weight' => $load->load_shipper_weight,
            'load_shipper_commodity' => $load->load_shipper_commodity,
            'load_shipper_value' => $load->load_shipper_value,
            'load_shipper_shipping_notes' => $load->load_shipper_shipping_notes,
            'load_shipper_po_numbers' => $load->load_shipper_po_numbers,
            'load_shipper_contact' => $load->load_shipper_contact,
            'load_shipper_appointment' => $load->load_shipper_appointment
        ];
        $pdf = new Dompdf();
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
        $pdf->setOptions($options);
        $view = view('broker.shipper_rc', compact('load', 'consigneeData','shipperData'))->render();
        $pdf->loadHtml($view);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        return $pdf->stream('document.pdf', ['Attachment' => false]);
    }

    public function cloneLoad($id) 
    {
      
        $originalLoad = Load::findOrFail($id);
        $newLoad = new Load();
        $newLoad->load_dispatcher = Auth::user()->name;
        $newLoad->user_id = Auth::id();
        $newLoad->load_carrier = $originalLoad->load_carrier ?? '';
        $newLoad->load_bill_to = $originalLoad->load_bill_to ?? '';
        $newLoad->load_status = 'Open';
        $newLoad->load_workorder = $originalLoad->load_workorder ?? '';
        $newLoad->load_payment_type = $originalLoad->load_payment_type ?? '';
        $newLoad->load_type = $originalLoad->load_type ?? '';
        $newLoad->load_pds = $originalLoad->load_pds ?? '';
        $newLoad->load_fsc_rate = $originalLoad->load_fsc_rate ?? '';
        $newLoad->load_telephone = $originalLoad->load_telephone ?? '';
        $newLoad->load_final_rate = $originalLoad->load_final_rate ?? '';
        $newLoad->load_advance_payment = $originalLoad->load_advance_payment ?? '';
        $newLoad->load_type_two = $originalLoad->load_type_two ?? '';
        $newLoad->load_billing_type = $originalLoad->load_billing_type ?? '';
        $newLoad->load_mc_no = $originalLoad->load_mc_no ?? '';
        $newLoad->load_equipment_type = $originalLoad->load_equipment_type ?? '';
        $newLoad->load_currency = $originalLoad->load_currency ?? '';
        $newLoad->load_pds_two = $originalLoad->load_pds_two ?? '';
        $newLoad->load_billing_fsc_rate = $originalLoad->load_billing_fsc_rate ?? '';
        $newLoad->load_other_charge = $originalLoad->load_other_charge ?? '';
        $newLoad->load_carrier_fee = $originalLoad->load_carrier_fee ?? '';
        $newLoad->load_final_carrier_fee = $originalLoad->load_final_carrier_fee ?? '';
        $newLoad->shipper_load_other_charge = $originalLoad->shipper_load_other_charge ?? '';
        $newLoad->load_consignee_appointment = $originalLoad->load_consignee_appointment ?? '';
        $newLoad->load_consigneer_contact = $originalLoad->load_consigneer_contact ?? '';
        $newLoad->load_consigneer_notes = $originalLoad->load_consigneer_notes ?? '';
        $newLoad->load_shipper_rate = $originalLoad->load_shipper_rate ?? '';
        $newLoad->shipper_load_final_rate = $originalLoad->shipper_load_final_rate ?? '';
        $newLoad->load_shipperr = $originalLoad->load_shipperr ?? '';
        $newLoad->load_shipper_location = $originalLoad->load_shipper_location ?? '';
        $newLoad->load_shipper_discription = $originalLoad->load_shipper_discription ?? '';
        $newLoad->load_shipper_commodity_type = $originalLoad->load_shipper_commodity_type ?? '';
        $newLoad->load_shipper_qty = $originalLoad->load_shipper_qty ?? '';
        $newLoad->load_shipper_weight = $originalLoad->load_shipper_weight ?? '';
        $newLoad->load_shipper_commodity = $originalLoad->load_shipper_commodity ?? '';
        $newLoad->load_shipper_value = $originalLoad->load_shipper_value ?? '';
        $newLoad->load_shipper_shipping_notes = $originalLoad->load_shipper_shipping_notes ?? '';
        $newLoad->load_shipper_po_numbers = $originalLoad->load_shipper_po_numbers ?? '';
        $newLoad->load_shipper_contact = $originalLoad->load_shipper_contact ?? '';
        $newLoad->load_shipper_appointment = $originalLoad->load_shipper_appointment ?? '';
        // Clone the original load properties into the new load
        $newLoad->load_consignee = $originalLoad->load_consignee ?? '';
        $newLoad->load_consignee_location = $originalLoad->load_consignee_location ?? '';
        $newLoad->load_consignee_appointment = $originalLoad->load_consignee_appointment ?? '';
        $newLoad->load_consignee_discription = $originalLoad->load_consignee_discription ?? '';
        $newLoad->load_consignee_type = $originalLoad->load_consignee_type ?? '';
        $newLoad->load_consignee_commodity = $originalLoad->load_consignee_commodity ?? '';
        $newLoad->load_consignee_qty = $originalLoad->load_consignee_qty ?? '';
        $newLoad->load_consignee_weight = $originalLoad->load_consignee_weight ?? '';
        $newLoad->load_consignee_value = $originalLoad->load_consignee_value ?? '';
        $newLoad->load_consigneer_notes = $originalLoad->load_consigneer_notes ?? '';
        $newLoad->load_consignee_po_numbers = $originalLoad->load_consignee_po_numbers ?? '';
        $newLoad->load_consignee_contact = $originalLoad->load_consignee_contact ?? '';
        $newLoad->load_consignee_delivery_notes = $originalLoad->load_consignee_delivery_notes ?? '';
        $newLoad->load_carrier_phone = $originalLoad->load_carrier_phone ?? '';
        $newLoad->receiving_amount = $originalLoad->receiving_amount ?? '';
        $newLoad->remaining_amount = $originalLoad->remaining_amount ?? '';
        $newLoad->carrierDoc = $originalLoad->carrierDoc ?? '';
        $newLoad->cpr_check = 'Not Approved';
        $newLoad->quick_pay = $originalLoad->quick_pay ?? '';
        $newLoad->payment_method = $originalLoad->payment_method ?? '';
        $newLoad->ready_to_pay = $originalLoad->ready_to_pay ?? '';
        $newLoad->customer_refrence_number = $originalLoad->ready_to_pay ?? '';

        // Save the new load object
        $newLoad->save();

        // Update the new load with the proper load number
        $insertedId = $newLoad->id;
        $newLoad->load_number = $insertedId;
        $newLoad->customer_id = $originalLoad->customer_id ?? '';

        // Process shipper charges
        $shipperCharges = [];
        if (!empty($originalLoad->shipperchargeType) && !empty($originalLoad->shipperchargeAmount)) {
            foreach ($originalLoad->shipperchargeType as $index => $chargeType) {
                $chargeAmount = $originalLoad->shipperchargeAmount[$index] ?? 0; // Default to 0 if not set
                $shipperCharges[] = [
                    'type' => $chargeType,
                    'amount' => $chargeAmount,
                ];
            }
        }

        // Process carrier charges
        $carrierCharges = [];
        if (!empty($originalLoad->shipper_type_charge) && !empty($originalLoad->shipper_other_charge)) {
            foreach ($originalLoad->shipper_type_charge as $index => $carrierchargeType) {
                $carrierchargeAmount = $originalLoad->shipper_other_charge[$index] ?? 0; // Default to 0 if not set
                $carrierCharges[] = [
                    'type' => $carrierchargeType,
                    'amount' => $carrierchargeAmount,
                ];
            }
        }

        // Update the charges
        $newLoad->carrier_load_other_charge = json_encode($carrierCharges);
        $newLoad->shipper_load_other_charge = json_encode($shipperCharges);

        // Save the updated load object
        $newLoad->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Load cloned successfully.');
    }
    
    public function BrokerLoadEdit($id)
    {
        
        $post = Load::find($id);
    
        if (!$post) {
            // Record not found, handle the error gracefully
            return redirect()->back()->withErrors(['msg' => 'Load not found.']);
        }
    
        $shipperData = json_decode($post->load_shipper, true); // Assuming 'load_shipper' is where your JSON data is stored
        $postData = $post->getAttributes();
        $allCustomers = Customer::where('user_id', auth()->id())->get();
    
        return view('broker.broker_load_edit', compact('post', 'shipperData', 'postData','allCustomers'));
    }
    
    

    public function BrokerLoadUpdate(Request $request, $id)
    {
        // dd($request->all());
        // Find the load instance
        $load = Load::find($id);
   
        // Handle shipper data
        $shipper_name = [];
        $shipper_location = [];
        $shipper_appointment = [];
        $shipper_description = [];
        $shipper_commodity_type = [];
        $shipper_commodity_name = [];
        $shipper_qty = [];
        $shipper_weight = [];
        $shipper_value = [];
        $shipper_note = [];
        $shipper_po_number = [];
        $shipper_contact = [];



        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper{$i}")) {
                $shipper = [
                    'name' => $request->input("load_shipper{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['name'])) {
                    $shipper_name[] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_location{$i}")) {
                $shipper = [
                    'location' => $request->input("load_shipper_location{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['location'])) {
                    $shipper_location[] = $shipper;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_appointment{$i}")) {
                $shipper = [
                    'appointment' => $request->input("load_shipper_appointment{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['appointment'])) {
                    $shipper_appointment [] = $shipper;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_description{$i}")) {
                $shipper = [
                    'description' => $request->input("load_shipper_description{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['description'])) {
                    $shipper_description [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_commodity_type{$i}")) {
                $shipper = [
                    'commodity_type' => $request->input("load_shipper_commodity_type{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['commodity_type'])) {
                    $shipper_commodity_type [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_commodity{$i}")) {
                $shipper = [
                    'commodity_name' => $request->input("load_shipper_commodity{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['commodity_name'])) {
                    $shipper_commodity_name [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_qty{$i}")) {
                $shipper = [
                    'shipper_qty' => $request->input("load_shipper_qty{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipper_qty'])) {
                    $shipper_qty [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_weight{$i}")) {
                $shipper = [
                    'shipper_weight' => $request->input("load_shipper_weight{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipper_weight'])) {
                    $shipper_weight [] = $shipper;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_value{$i}")) {
                $shipper = [
                    'shipper_value' => $request->input("load_shipper_value{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipper_value'])) {
                    $shipper_value [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_shipping_notes{$i}")) {
                $shipper = [
                    'shipping_notes' => $request->input("load_shipper_shipping_notes{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipping_notes'])) {
                    $shipper_note [] = $shipper;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_po_numbers{$i}")) {
                $shipper = [
                    'shipping_po_numbers' => $request->input("load_shipper_po_numbers{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipping_po_numbers'])) {
                    $shipper_po_number [] = $shipper;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 shippers based on your form
            if ($request->has("load_shipper_contact{$i}")) {
                $shipper = [
                    'shipping_contact' => $request->input("load_shipper_contact{$i}"),
                ];
    
                // Add shipper data to array if name is not null
                if (!empty($shipper['shipping_contact'])) {
                    $shipper_contact [] = $shipper;
                }
            }
        }
    
        // Handle consignee dataaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa
        $consignee_name = [];
        $consignee_location = [];
        $load_consignee_appointment = [];
        $consignee_description = [];
        $load_consignee_type = [];
        $consignee_commodity_name = [];
        $consignee_qty = [];
        $consignee_weight = [];
        $consignee_value = [];
        $consignee_note = [];
        $consignee_po_number = [];
        $consignee_contact = [];
        $consignee_delivery_note = [];
        $load_consignee_commodity = [];
        $load_consigneer_contact = [];


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_{$i}")) {
                $consignee = [
                    'name' => $request->input("load_consignee_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['name'])) {
                    $consignee_name [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_location_{$i}")) {
                $consignee = [
                    'location' => $request->input("load_consignee_location_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['location'])) {
                    $consignee_location [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_appointment_{$i}")) {
                $consignee = [
                    'appointment' => $request->input("load_consignee_appointment_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['appointment'])) {
                    $load_consignee_appointment [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_discription_{$i}")) {
                $consignee = [
                    'description' => $request->input("load_consignee_discription_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['description'])) {
                    $consignee_description [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_commodity_{$i}")) {
                $consignee = [
                    'consignee_commodity' => $request->input("load_consignee_commodity_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_commodity'])) {
                    $load_consignee_commodity [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_type_{$i}")) {
                $consignee = [
                    'consignee_type' => $request->input("load_consignee_type_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_type'])) {
                    $load_consignee_type [] = $consignee;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_qty_{$i}")) {
                $consignee = [
                    'consignee_qty' => $request->input("load_consignee_qty_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_qty'])) {
                    $consignee_qty [] = $consignee;
                }
            }
        }


        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_weight_{$i}")) {
                $consignee = [
                    'consignee_weight' => $request->input("load_consignee_weight_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_weight'])) {
                    $consignee_weight [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_value_{$i}")) {
                $consignee = [
                    'consignee_value' => $request->input("load_consignee_value_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_value'])) {
                    $consignee_value [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consigneer_notes_{$i}")) {
                $consignee = [
                    'consignee_notes' => $request->input("load_consigneer_notes_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_notes'])) {
                    $consignee_note [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_po_numbers_{$i}")) {
                $consignee = [
                    'consignee_po_number' => $request->input("load_consignee_po_numbers_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_po_number'])) {
                    $consignee_po_number [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consigneer_contact_{$i}")) {
                $consignee = [
                    'consignee_contact' => $request->input("load_consigneer_contact_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_contact'])) {
                    $load_consigneer_contact [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) { // Assuming there are up to 2 consignees based on your form
            if ($request->has("load_consignee_delivery_notes_{$i}")) {
                $consignee = [
                    'consignee_delivery_notes' => $request->input("load_consignee_delivery_notes_{$i}"),
                ];
    
                // Add consignee data to array if name is not null
                if (!empty($consignee['consignee_delivery_notes'])) {
                    $consignee_delivery_note  [] = $consignee;
                }
            }
        }

        for ($i = 1; $i <= 15; $i++) {
            // Check if the form input for consignee note exists
            if ($request->has("load_consignee_notes_{$i}")) {
                // Get the consignee note value from the request
                $note = $request->input("load_consignee_notes_{$i}");
        
                // Add consignee note to array if not empty
                if (!empty($note)) {
                    $consignee_note[] = ['load_consignee_notes' => $note];
                }
            }
        }

    
        $load->load_shipperr = json_encode($shipper_name);
        $load->load_shipper_location = json_encode($shipper_location);
        $load->load_shipper_discription = json_encode($shipper_description);
        $load->load_shipper_commodity_type = json_encode($shipper_commodity_type);
        $load->load_shipper_qty = json_encode($shipper_qty);
        $load->load_shipper_weight = json_encode($shipper_weight);
        $load->load_shipper_commodity = json_encode($shipper_commodity_name);
        $load->load_shipper_value = json_encode($shipper_value);
        $load->load_shipper_shipping_notes = json_encode($shipper_note);
        $load->load_shipper_po_numbers = json_encode($shipper_po_number);
        $load->load_shipper_contact = json_encode($shipper_contact);
        $load->load_shipper_appointment = json_encode($shipper_appointment);
    
        $load->load_consignee = json_encode($consignee_name);
        $load->load_consignee_location = json_encode($consignee_location);
        $load->load_consignee_appointment = json_encode($load_consignee_appointment);
        $load->load_consignee_discription = json_encode($consignee_description);
        $load->load_consignee_type = json_encode($load_consignee_type);
        $load->load_consignee_commodity = json_encode($load_consignee_commodity);
        $load->load_consignee_qty = json_encode($consignee_qty);
        $load->load_consignee_weight = json_encode($consignee_weight);
        $load->load_consignee_value = json_encode($consignee_value);
        $load->load_consigneer_notes = json_encode($consignee_note);
        $load->load_consignee_po_numbers = json_encode($consignee_po_number);
        $load->load_consigneer_contact = json_encode($load_consigneer_contact);
        $load->load_consignee_delivery_notes = json_encode($consignee_delivery_note);
        $load->load_consignee_appointment = json_encode($load_consignee_appointment);


        $load->load_bill_to = $request->input('load_bill_to', null);
        $load->load_dispatcher = $request->input('load_dispatcher') ?? '';
        $load->load_status = $request->input('load_status') ?? '';
        $load->load_workorder = $request->input('load_workorder') ?? '';
        $load->load_payment_type = $request->input('load_payment_type') ?? '';
        $load->load_type = $request->input('load_type') ?? '';
        $load->load_shipper_rate = $request->input('load_shipper_rate') ?? '';
        $load->load_pds = $request->input('load_pds') ?? '';
        $load->load_fsc_rate = $request->input('load_fsc_rate') ?? '';
        $load->load_telephone = $request->input('load_telephone') ?? '';
        $load->shipper_load_other_charge = $request->input('shipper_load_other_charge') ?? '';
        $load->load_carrier = $request->input('load_carrier') ?? '';
        $load->load_carrier_phone = $request->input('load_carrier_phone') ?? '';
        $load->load_advance_payment = $request->input('load_advance_payment') ?? '';
        $load->load_type_two = $request->input('load_type_two') ?? '';
        $load->load_billing_type = $request->input('load_billing_type') ?? '';
        $load->load_mc_no = $request->input('load_mc_no') ?? '';
        $load->load_equipment_type = $request->input('load_equipment_type') ?? '';
        $load->load_carrier_fee = $request->input('load_carrier_fee') ?? '';
        $load->load_currency = $request->input('load_currency') ?? '';
        $load->load_pds_two = $request->input('load_pds_two') ?? '';
        $load->load_billing_fsc_rate = $request->input('load_billing_fsc_rate') ?? '';
        $load->load_final_carrier_fee = $request->input('load_final_carrier_fee') ?? '';
        $load->load_final_rate = $request->input('shipper_load_final_rate') ?? '';
        $load->load_other_charge = $request->input('load_other_charge') ?? '';
        $load->shipper_load_final_rate = $request->input('shipper_load_final_rate') ?? '';

        $load->shipper_load_final_rate = $request->input('shipper_load_final_rate') ?? '';
        $load->customer_id = $request->input('customer_id') ?? '';
        $load->comment = $request->input('comment') ?? '';
        $load->invoice_number = '';
        $load->invoice_date = '0000-00-00';
        $load->load_carrier_due_date = '';
        $load->carrier_mark_as_paid = '';
        $load->carrierDoc = '';
        $load->quick_pay = '';
        $load->payment_method = '';
        $load->ready_to_pay = '';
        $load->customer_refrence_number = $request->input('customer_refrence_number') ?? '';
        
        // Initialize shipperCharges array
        $shipperCharges = [];
        if ($request->has('shipperchargeType') && $request->has('shipperchargeAmount')) {
            foreach ($request->shipperchargeType as $index => $chargeType) {
                $chargeAmount = $request->shipperchargeAmount[$index] ?? null;
                if ($chargeAmount !== null) {
                    $shipperCharges[] = [
                        'type' => $chargeType,
                        'amount' => $chargeAmount,
                    ];
                }
            }
        }
        
        // Initialize carrierCharges array
        $carrierCharges = [];
        if ($request->has('shipper_type_charge') && $request->has('shipper_other_charge')) {
            foreach ($request->shipper_type_charge as $index => $carrierchargeType) {
                $carrierchargeAmount = $request->shipper_other_charge[$index] ?? null;
                if ($carrierchargeAmount !== null) {
                    $carrierCharges[] = [
                        'type' => $carrierchargeType,
                        'amount' => $carrierchargeAmount,
                    ];
                }
            }
        }
        
        $load->carrier_load_other_charge = json_encode($carrierCharges);
        $load->shipper_load_other_charge = json_encode($shipperCharges);

        
        if ($request->hasFile('load_delivery_do_file')) {
            $file = $request->file('load_delivery_do_file');
            if ($file->isValid()) {
                $filename = $request->input('load_bill_to') . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('public/upload/delivery-order', $filename);
                $load->load_delivery_do_file = 'upload/delivery-order/' . $filename; // Save the relative path
                $load->save();
            } else {
                return back()->withErrors(['load_delivery_do_file' => 'Uploaded file is not valid.']);
            }
        }
        

        
       
    // echo "<pre>"; print_r($load); die();
        $load->save();
    

        return redirect('/load')->with('success', 'Load status updated successfully');

    } 
    

    public function BrokerLoadStatus(){
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $brokerLoadStatus =  Load::where('user_id', $user->id)->get();
        return view('broker.broker_load_status',compact('brokerLoadStatus'));
    }

    public function fetchFilteredData(Request $request)
    {
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $searchTerm = $request->input('query');
        $filteredData = Load::where('user_id', $user->id)
            ->where(function ($query) use ($searchTerm) {
                $query->where('load_number', 'like', '%' . $searchTerm . '%')
                    ->orWhere('load_workorder', 'like', '%' . $searchTerm . '%')
                    ->orWhere('load_bill_to', 'like', '%' . $searchTerm . '%')
                    ->orWhere('load_consignee', 'like', '%' . $searchTerm . '%')
                    ->orWhere('load_status', 'like', '%' . $searchTerm . '%');
            })
            ->get();
        return view('broker.broker_load_status', ['filteredData' => $filteredData])->render();
    }
    

    public function updateLoadStatus($id, Request $request)
    {
        $load = Load::find($id);
    
        if (!$load) {
            return response()->json(['success' => false, 'message' => 'Load not found'], 404);
        }
    
        $newStatus = $request->input('load_status');
    
        $load->load_status = $newStatus;
    
        if ($newStatus === 'Delivered') {
            $currentDateTime = Carbon::now();
            $load->load_actual_delivery_date = $currentDateTime;
        }
    
        $load->save();
    
        return response()->json(['success' => true, 'message' => 'Load status updated successfully'], 200);
    }
    
    


    public function uploadFiles(Request $request)
    {
        if ($request->hasFile('files')) {
            $files = $request->file('files');
    
            $filePaths = [];
    
            foreach ($files as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('public/upload/public', $fileName);
    
                // Append file path to the array
                $filePaths[] = Storage::url($filePath);
            }
    
            // Return success response with file paths
            return response()->json(['success' => true, 'file_paths' => $filePaths]);
        } else {
            // No files were uploaded
            return response()->json(['success' => false, 'message' => 'No files uploaded.']);
        }
    }
    
    

    public function getShipperLocation($id)
    {
        $shipper = Shipper::find($id);
        if ($shipper) {
            return response()->json([
                'location' => $shipper->shipper_address, 
                'city' => $shipper->shipper_city, 
                'state' => $shipper->shipper_state, 
                'country' => $shipper->shipper_country, 
                'zip' => $shipper->shipper_zip, 
            ]);
        }
        return response()->json(['error' => 'Shipper not found'], 404);
    }


    public function bol(){
        return view('broker.bol');
    }

    public function mcCheck(){
        return view('broker.mc');
    }

    public function cprCheck(){
        return view('broker.cpr');
    }
    
    
    
    
    public function removeFile(Request $request)
    {
        $request->validate([
            'url' => 'required|string',
            'name' => 'required|string',
        ]);
    
        $filePath = str_replace(asset('storage/'), 'public/', $request->url);
        if (Storage::exists($filePath)) {
            Storage::delete($filePath);
    
            $load = Load::find($request->loadId);
            if (!$load) {
                return response()->json(['error' => 'Invalid load ID.'], 400);
            }
    
            $files = json_decode($load->files, true);
            foreach ($files as $key => $filePaths) {
                if (is_array($filePaths)) {
                    $files[$key] = array_filter($filePaths, function ($file) use ($filePath) {
                        return $file !== $filePath;
                    });
                    if (empty($files[$key])) {
                        unset($files[$key]);
                    }
                } elseif ($filePaths === $filePath) {
                    unset($files[$key]);
                }
            }
    
            $load->files = json_encode($files);
            $load->save();
    
            return response()->json(['success' => true]);
        }
    
        return response()->json(['error' => 'File not found.'], 404);
    }
    

    public function fetchShipperDetailsEdit(Request $request) {
        $id = $request->input('id');
    
        $shipper = Shipper::select('id', 'shipper_name', 'shipper_address', 'shipper_city', 'shipper_state', 'shipper_country', 'shipper_zip')
                          ->where('id', $id)
                          ->where('user_id', Auth::id())
                          ->first();
    
        if ($shipper) {
            return response()->json($shipper);
        } else {
            return response()->json(['error' => 'Shipper not found'], 404);
        }
    }
    // public function fetchConsigneeDetailsEdit(Request $request)
    // {
    //     $id = $request->input('id');
        
    //     $consignee = Consignee::select('id', 'consignee_name', 'consignee_address', 'consignee_city', 'consignee_state', 'consignee_country', 'consignee_zip')
    //                           ->where('id', $id)
    //                           ->where('user_id', Auth::id())
    //                           ->first();
        
    //     if ($consignee) {
    //         return response()->json($consignee);
    //     } else {
    //         return response()->json(['error' => 'Consignee not found'], 404);
    //     }
    // }
    public function fetchConsigneeDetailsEdit(Request $request)
{
    $id = $request->input('id');
    
    $consignee = Consignee::select('id', 'consignee_name', 'consignee_address', 'consignee_city', 'consignee_state', 'consignee_country', 'consignee_zip')
                          ->where('id', $id)
                          ->where('user_id', Auth::id())
                          ->first();
    
    if ($consignee) {
        // Process the country name if necessary
        $countryName = explode(' ', $consignee->consignee_country, 2)[1] ?? '';
        
        // Add the country name to the response
        return response()->json([
            'id' => $consignee->id,
            'consignee_name' => $consignee->consignee_name,
            'consignee_address' => $consignee->consignee_address,
            'consignee_city' => $consignee->consignee_city,
            'consignee_state' => $consignee->consignee_state,
            'consignee_country' => $countryName, // Return the processed country name
            'consignee_zip' => $consignee->consignee_zip,
        ]);
    } else {
        return response()->json(['error' => 'Consignee not found'], 404);
    }
}

public function getFilesCarrierDoc(Request $request)
{
    // Get the authenticated user
    $user = Auth::user();

    // Find the Load by its ID and make sure it's associated with the authenticated user
    $load = Load::where('id', $request->id)
                ->where('user_id', $user->id) // Assuming there's a 'user_id' column to link loads to users
                ->first();

    if (!$load) {
        return response()->json(['error' => 'Load not found or not authorized'], 403);
    }

    // Decode the JSON array of file paths stored in carrierDoc
    $files = json_decode($load->carrierDoc, true);

    // Initialize an array to hold file URLs and names
    $fileUrls = [];

    // Loop through the files array
    foreach ($files as $file) {
        // Generate the full URL for each file and its name
        $fileUrls[] = [
            'url' => asset('storage/' . $file), // Corrected file path
            'name' => basename($file)
        ];
    }

    // Return the array of file URLs and load number as a JSON response
    return response()->json([
        'files' => $fileUrls,
        'load_number' => $load->load_number // Make sure this column exists
    ]);
}
public function fetchCarrierList(Request $request)
{
    $carrierName = $request->input('carrierName');
    $mcNumber = $request->input('mcNumber');
    $dotNumber = $request->input('dotNumber');

    // Build the query based on input
    $query = External::where('user_id', Auth::id()) // Ensure it only gets carriers for the authenticated user
                     ->where('mc_check', 'Approved')// Only approved carriers
                     ->where('user_id', Auth::id());

    // Add condition for carrier name if provided
    if (!empty($carrierName)) {
        $query->where('carrier_name', 'like', '%' . $carrierName . '%');
    }

    // Add condition for MC number if provided
    if (!empty($mcNumber)) {
        $query->where('carrier_mc_ff_input', 'like', '%' . $mcNumber . '%');
    }

    // Add condition for DOT number if provided
    if (!empty($dotNumber)) {
        $query->where('carrier_dot', 'like', '%' . $dotNumber . '%');
    }

    // Execute the query and select the necessary fields
    $carriers = $query->select('id', 'carrier_name as name', 'carrier_mc_ff_input as mcNumber', 'carrier_dot as dotNumber', 'carrier_telephone as phone')
                      ->limit(10) // Limit results for dropdown
                      ->get();

    return response()->json($carriers);
}
public function updateInvoiceStatus(Request $request, $loadId)
{
    DB::transaction(function () use ($request, $loadId) {
        // Step 1: Find the load
        $load = Load::find($loadId);

        if ($load && $load->invoice_status != 'Paid Record') {
            // Step 2: Update the invoice status
            $load->invoice_status = 'Paid Record';
            $load->save();

            // Step 3: Add the amount back to the customer's credit limit
            $customer = Customer::find($load->customer_id);
            if ($customer) {
                $customer->adv_customer_credit_limit += $load->shipper_load_final_rate;
                $customer->remaining_credit_amount = $customer->adv_customer_credit_limit;
                $customer->save();
            }
        }
    });

    return redirect()->back()->with('success', 'Invoice status updated and customer credit limit adjusted!');
}

}