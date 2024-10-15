<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use App\Models\Workflow;
use Illuminate\Support\Facades\Auth;

class GlobalObserver
{
    public function created(Model $model)
    {
        // dd('created event triggered'); // This should output when a model is created
        $this->logAction('created', $model);
    }

    public function updated(Model $model)
    {
        // dd('updated event triggered'); // This should output when a model is updated
        $this->logAction('updated', $model);
    }

    public function deleted(Model $model)
    {
        // dd('deleted event triggered'); // This should output when a model is deleted
        $this->logAction('deleted', $model);
    }

    protected function logAction(string $action, Model $model)
    {
        // $user = auth()->user();
        
        $guards = ['web', 'admin', 'superadmin', 'accountsadmin', 'teamlead']; // List of all guards
        $user = null;
        $guard_name = '';
        $user = auth::user();

        foreach ($guards as $guard) {
            $user = Auth::guard($guard)->user();
            
            if ($user) {
                $guard_name = $guard;
                break; // Exit the loop as soon as a user is found
            }
        }
        
        Workflow::create([
            'auth_id' => $user->id,
            'guard_name' => $guard_name,
            'action' => $action,
            'model_data' => json_encode($model->toArray()), // Store model data as JSON
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
        ]);
    }
}

