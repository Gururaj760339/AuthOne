<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function routeNotificationForTwilio()
    {
        return $this->phone;
    }

    function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    function financeRequests()
    {
        return $this->hasMany(FinanceRequests::class);
    }

    public function rentalBookings()
    {
        return $this->hasMany(RentalBooking::class);
    }

    public function importeRequest()
    {
        return $this->hasMany(ImportRequest::class);
    }

    public function vendor()
    {
        return $this->hasOne(Vendor::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function financePartner()
    {
        return $this->hasOne(FinancePartner::class, 'user_id');
    }
}
