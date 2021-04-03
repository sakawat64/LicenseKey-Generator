<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;

class License extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','license_key','expire_date'];
    public function setUserIdAttribute($user_id)
    {
        $this->attributes['user_id'] = Crypt::encryptString($user_id);
    }
    public function setLicenseKeyAttribute($license_key)
    {
        //Crypt::encryptString($request->token),
        $this->attributes['license_key'] = Crypt::encryptString($license_key);
    }
    public function getUserIdAttribute($user_id)
    {
        return Crypt::decryptString($user_id);
    }
    public function getLicenseKeyAttribute($license_key)
    {
        return Crypt::decryptString($license_key);
    }
}
