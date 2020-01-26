<?php

namespace App;

use App\Traits\Filterable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, Filterable, HasApiTokens;

    /**
     * User Account Types
     * 1 = Super Admin
     * 2 = Manager
     * 3 = PT
     * 4 = Patient.
     */

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'password',
        'email_verified_at',
        'is_web',
        'is_cms',
        'status',
        'login_attempts',
        'account_type',
        'password_confirmation',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function findForPassport($email)
    {
        return self::where('email', $email)->first();
    }

    /**
     * Increment the login attempts of the user.
     */
    public function incrementLoginAttempts()
    {
        $this->increment('login_attempts');

        if ($this->login_attempts >= 3) {
            $this->deactivate();
        }
    }

    /**
     * Clear the user's number of login attempts.
     */
    public function clearLoginAttempts()
    {
        $this->login_attempts = 0;
        $this->save();
    }

    /**
     * Deactivate the user.
     */
    public function deactivate()
    {
        $this->status = 0;

        $this->save();
    }

    public function isSuperAdmin()
    {
        return $this->is_cms && $this->account_type == 1;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function userDetails()
    {
        return $this->hasOne(UserDetails::class, 'user_id');
    }
}
