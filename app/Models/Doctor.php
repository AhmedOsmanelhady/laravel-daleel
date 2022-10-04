<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     "name",
    //     "title",
    //     "about",
    //     "mobile",
    //     "phone",
    //     "address",
    //     "city",
    //     "image",
    //     "created_at",
    //     "updated_at",
    // ];

    public $appends = [
        "image_url",
        "human_readable_created_at",
        "human_readable_updated_at",
    ];

    public function getImageUrlAttribute()
    {
        return asset("uploads/doctors/" . $this->image);
    }

    public function getHumanReadableCreatedAtAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->diffForHumans();
        } else {
            return "";
        }
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHumanReadableUpdatedAtAttribute()
    {
        if ($this->updated_at) {
            return $this->updated_at->diffForHumans();
        } else {
            return "";
        }
    }
}
