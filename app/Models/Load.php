<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\customer;

class Load extends Model
{
    use HasFactory;

    protected $table = 'load';
    
    protected $fillable = ['load_number', 'load_dispatcher', 'load_bill_to','load_status','load_workorder','load_payment_type','load_type','load_shipper_rate','load_pds','load_fsc_rate','load_telephone','load_other_change','load_final_rate','load_carrier','load_advance_payment','load_type_two','load_billing_type','load_mc_no','load_equipment_type','load_carrier_fee','load_currency','load_pds_two','load_billing_fsc_rate','load_other_charge','load_final_carrier_fee','load_other_charge_two','user_id','invoice_status','comment_notes','private_file','public_file','load_actual_delivery_date','load_carrier_due_date','load_carrier_due_date_on','carrier_mark_as_paid','load_carrier_phone','shipper_load_final_rate','load_consignee_contact','receiving_amount','cpr_check','customer_id','comment']; // fillable columnss


    public function customer()
    {
        return $this->hasOne(Customer::class, 'user_id', 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'load_shipper_date' => 'datetime',
    ];

    
    
}
