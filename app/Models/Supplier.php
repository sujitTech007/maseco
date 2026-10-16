<?php



namespace App\Models;



use App\Http\Middleware\Authenticate;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasMany;



class Supplier extends Authenticatable

{

    use HasFactory;

    protected $fillable = [

        'name',
        'company_name',
        'email',
        'phone',
        'business_name',
        'business_type',
        'country',
        'state',
        'address',
        'gst',
        'password',
        'country_code',

    ];

    protected $hidden = ['password'];

    public function materials(): HasMany
    {
        return $this->hasMany(Material::class);
    }
}
