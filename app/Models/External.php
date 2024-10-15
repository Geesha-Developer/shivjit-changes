<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class External extends Model
{
    use HasFactory;

    protected $table = 'external';
    
    protected $fillable = ['carrier_name', 'carrier_dot', 'carrier_mc_ff','carrier_mc_ff_input','carrier_address','carrier_address_two','carrier_country','carrier_address_three','carrier_state','carrier_city','carrier_zip','carrier_contact_name','carrier_email','carrier_telephone','carrier_extn','carrier_tollfree','carrier_fax','carrier_payment_terms','carrier_tax_id','carrier_username','carrier_password','carrier_factoring_company','carrier_notes','carrier_status','carrier_load_type','carrier_blacklisted','carrier_corporation','carrier_file_upload' => 'array']; // fillable columns

    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
