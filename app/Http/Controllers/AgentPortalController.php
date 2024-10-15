<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Auth;

/* Model Import*/
use App\Models\customer;
use App\Models\External;
use App\Models\Shipper;
use App\Models\Consignee;
use App\Models\Load;
use App\Models\User;
class AgentPortalController extends Controller
{
    //

    public function agentPortal(){
        $user = auth()->user();
        
        if(!$user){
            $user = Auth::guard('teamlead')->user();  
        }
        $usersData = User::where('team_lead',$user->id)->get(); 
        return view('broker.agentportal')->with([
            'brokers' => $usersData,
            'user' => $user,
        ]);
    }

    public function getExternalData(Request $request){

        $userId = $request->id;
        $carrierNames = External::where('user_id',$userId)->get();
        
        
        return DataTables::of($carrierNames)
            ->addColumn('action', function($carrierNames) {
                return '<a href="'.route('carriers.edit', $carrierNames->id).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->make(true);
    }
    // public function getConsignee(Request $request){
    //     $userId = $request->id;
    //      $allConsignees = Consignee::where('user_id', $userId)->get();
    //      return DataTables::of($allConsignees)
    //         ->addColumn('action', function($allConsignees) {
    //             return '<a href="'.route('users.edit', $allConsignees->id).'" class="btn btn-sm btn-primary">Edit</a>';
    //         })
    //         ->make(true);
    // }
    public function getCustomerData(Request $request){
        $userId = $request->id;
        $customerData = customer::where('user_id',$userId)->get();
        return DataTables::of($customerData)
            ->addColumn('action', function($customerData) {
                return '<a href="'.route('customers.edit', $customerData->id).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->make(true);
    }   


    public function getShipperData(Request $request){
        $userId = $request->id;
        $shipperData = Shipper::where('user_id',$userId)->get();
        return DataTables::of($shipperData)
            ->addColumn('action', function($shipperData) {
                return '<a href="'.route('shipper.edit', $shipperData->id).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->make(true);
    }


    public function getLoadData(Request $request){
        $userId = $request->id;
        // echo $userId;
        // die;
        $load = Load::where('user_id', $userId)->orderBy('id', 'desc')->get();  
        
        return DataTables::of($load)
            ->addColumn('action', function($load) {
                return '<a href="'.route('loads.edit', $load->id).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->make(true);
    }


    public function getConsigneeData(Request $request){
        $userId = $request->id;
        $consignee = Consignee::where('user_id', $userId)->get();
        return DataTables::of($consignee)
            ->addColumn('action', function($consignee) {
                return '<a href="'.route('consignees.edit', $consignee->id).'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->make(true);
    }

}
