<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Factories\HasFactory;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;





class Manufacturer extends Authenticatable

{

    use HasFactory;
    use Notifiable;

    protected $fillable = [

        'name',
        'company_name',
        'email',
        'phone',
        'password',
        'otp',
        'business_name',
        'business_type',
        'country',
        'state',
        'address',
        'gst',
        'country_code',
        'otp_expires_at'


    ];

    protected $hidden = ['password', 'otp'];
}
