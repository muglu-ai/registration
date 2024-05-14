<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exhibitor_reg_table extends Model
{
    use HasFactory;
    protected $fillable = [
        'exhibitor_id',
        'org_name',
        'org_type',
        'org_reg_certificate',
        'booth_size',
        'booth_area',
        'booth_space',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'zip_code',
        'cp_name',
        'cp_email',
        'cp_designation',
        'cp_mobile',
        'website',
        'gst_details',
        'gst_number',
        'gst_invoice_add',
        'pan_number',
        'sales_executive',
        'reg_id',
        'user_type',
        'exhibiting_under',
        'reg_date',
        'tin_no',
        'currency',
        'amt_ext',
        'paymode',
        'pay_status',
        'payment_date',
        'pin_no',
        'selection_amount',
        'promo_code',
        'discount',
        'tax_amount',
        'processing_charge',
        'total_amount',
        'total_amt_received',
        'delegate_type',
        'pg_errorText',
        'pg_paymentId',
        'pg_trackId',
        'pg_result',
        'pg_tranid',
        'pg_auth',
        'pg_avr',
        'pg_ref',
        'pg_amt',
    ];
}
