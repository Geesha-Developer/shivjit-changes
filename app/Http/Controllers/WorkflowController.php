<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccountsAdmin;
use App\Models\WorkFlow;
use App\Models\Admin;
use App\Models\TeamLead;

class WorkflowController extends Controller
{
    //
        /**
     * Display the form to select a user.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Fetch all users to display in the dropdown
        $users = User::all();
        // $teamlead = TeamLead::all();
        $admin = Admin::all();
        
        $teamlead = TeamLead::all();
        $accountsAdmin = AccountsAdmin::all();

        return view('workflows.index')->with(['users' => $users,'teamlead' => $teamlead,'admin'=> $admin,'accountsAdmin' => $accountsAdmin]);
    }

    /**
     * Display the workflow logs for the selected user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        // $request->validate([
        //     'user_id' => 'required|exists:users,id', // Validate that user_id exists in the users table
        // ]);

        $userId = $request->input('user_id');
        // dd($userId);

        // Fetch the workflows for the selected user
        $workflows = Workflow::where('auth_id', $userId)->get();

        // Fetch all users to display in the dropdown again
        $users = User::all();
        // $teamlead = TeamLead::all();
        $admin = Admin::all();
        
        $teamlead = TeamLead::all();
        $accountsAdmin = AccountsAdmin::all();
        // dd($workflows);
        return view('workflows.index', compact( 'workflows', 'userId'))->with(['users' => $users,'teamlead' => $teamlead,'admin'=> $admin,'accountsAdmin' => $accountsAdmin]);
    }
}
