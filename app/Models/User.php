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
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

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
     public function role() {
        return $this->belongsTo(Role::class);
    }

    // Relation avec Region
    public function region() {
        return $this->belongsTo(Region::class);
    }

    // Relation avec Products
    public function products() {
        return $this->hasMany(Produit::class);
    }

    // Relation avec Orders
    public function orders() {
        return $this->hasMany(Order::class);
    }

    // Messages envoyés
    public function messagesEnvoyeur() {
        return $this->hasMany(Message::class, 'sender_id');
    }

    // Messages reçus
    public function messagesReceveur() {
        return $this->hasMany(Message::class, 'receiver_id');
    }
}
