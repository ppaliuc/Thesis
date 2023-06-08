<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $fillable = ['bank_plan_id','currency_id','account_number','name', 'photo', 'zip', 'residency', 'city', 'address', 'phone', 'fax', 'email','password','verification_link','affilate_code','is_provider','twofa','go','details','kyc_status','kyc_info','kyc_reject_reason','plan_end_date'];

    protected $hidden = [
        'password', 'remember_token'
    ];

    protected $dates = [
        'plan_end_date',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function subscriptions(){
        return $this->hasMany(UserSubscription::class);
    }

    public function balanceTransfers(){
        return $this->hasMany(BalanceTransfer::class);
    }

    public function fdr(){
        return $this->hasMany(UserFdr::class);
    }

    public function dps(){
        return $this->hasMany(UserDps::class);
    }

    public function loans(){
        return $this->hasMany(UserLoan::class);
    }

    public function wiretransfers(){
        return $this->hasMany(WireTransfer::class);
    }

    public function deposits(){
        return $this->hasMany(Deposit::class);
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraw::class);
    }

	public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
    public function socialProviders()
    {
        return $this->hasMany('App\Models\SocialProvider');
    }

    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id');
    }
}
