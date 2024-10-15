<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TeamLead;
use App\Models\User;

class TeamAssignmentController extends Controller
{
    /**
     * Show the team assignment page with a list of brokers.
     *
     * @return \Illuminate\View\View
     */
    public function showTeamAssignmentPage()
    {
        // Retrieve all brokers (users)
        $broker = User::all();

        // Pass the brokers to the view
        return view('admin.teamassignment')->with('broker', $broker);
    }

    /**
     * Get the list of team leads for a specific broker.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTeamLeadList(Request $request)
    {
        // Find the user by the provided ID
        $userData = User::find($request->id);
        
        // If the user doesn't exist, return an error response
        if (!$userData) {
            return response()->json(['error' => 'User not found'], 404);
        }

        // Retrieve all team leads
        $teamLead = TeamLead::all();

        // Generate the options for the dropdown list
        $optionData = '';
        foreach ($teamLead as $leader) {
            $selected = $userData->team_lead == $leader->id ? 'selected' : '';
            $optionData .= '<option value="'.$leader->id.'" '.$selected.'>'.$leader->name.'</option>';
        }

        // Return the options as a JSON response
        return response()->json(['optionData' => $optionData]);
    }

    /**
     * Update the team lead assignment for a specific broker.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateBrokerTeamlead(Request $request)
    {
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:users,id',
            'teamlead' => 'required|exists:teamleads,id',
        ]);

        // Find the user by the provided ID
        $userData = User::find($request->id);
        // dd($userData);

        // Update the user's team lead assignment
        $userData->team_lead = $request->teamlead;
        $userData->save();

        // Return a success message as a JSON response
        return response()->json(['message' => 'Team lead updated successfully']);
    }
}
