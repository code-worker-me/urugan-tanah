<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ["name", "email", "password", "role"];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = ["password", "remember_token"];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            "email_verified_at" => "datetime",
            "password" => "hashed",
        ];
    }

    public function urugan(): BelongsToMany
    {
        return $this->belongsToMany(
            Urugan::class,
            "urugan_user",
            "user_id",
            "urugan_id",
        )->withTimestamps();
    }

    public function visibleUrugan()
    {
        return $this->role === "kantor" ? Urugan::query() : $this->urugan();
    }

    public function uruganLapangan()
    {
        return $this->hasOne(Urugan::class, "admin_lapangan_id");
    }
}
