<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;
use JeffGreco13\FilamentBreezy\Traits\TwoFactorAuthenticatable;
use Spatie\Image\Manipulations;

class User extends Authenticatable implements FilamentUser, HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles, InteractsWithMedia;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'media',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'id' => 'integer',
    ];

    protected $appends = ['photo', 'preview'];

    public function registerMediaCollections(): void
    {
        $this
            ->addMediaCollection('default')
            ->useFallbackUrl('' . url('') . '/images/default.png')
            ->useFallbackPath(public_path('/images/default.png'));
        $this
            ->addMediaConversion('preview')
            ->fit(Manipulations::FIT_CONTAIN, 100, 200)
            ->nonQueued();
    }

    public function getPhotoAttribute()
    {
        return $this->getFirstMediaUrl('default');
    }

    public function getPreviewAttribute()
    {
        return $this->getFirstMediaUrl('default', 'preview');
    }

    public function canAccessFilament(): bool
    {
        return true;
    }

    // has one doctor relation
    /**
     * Get the doctor associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function doctor(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    public function radiolest(): HasOne
    {
        return $this->hasOne(Radiolest::class);
    }
}
