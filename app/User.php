<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\PasswordResetNotification;
use App\Notifications\VerifyEmailNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_image', 'name', 'email', 'cpf', 'cep',
        'complement_number', 'profile_completed_at', 
        'password', 'role_id', 'dont_email_notification'
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
        'profile_completed_at' => 'datetime',
    ];

    public $timestamps = true;
    protected $softDelete = true;

    /***
     * Send Reset Password 
     * Notification
     * 
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    /**
     * Send Verify Email
     * Notification
     * 
     */
    public function sendEmailVerificationNotification()
    {
        $defaultPassword = "12345678";
        $this->notify(new VerifyEmailNotification($this->email, $defaultPassword));
    }
}
