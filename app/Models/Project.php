<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name',
        'data',
        'user_id',
    ];

    protected $casts = [
        'data' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function setCreatedAt($value)
    {
        $timezone = config('app.timezone', 'Asia/Kolkata');
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $value, new \DateTimeZone($timezone));
        $dateTime->setTimezone(new \DateTimeZone('Asia/Kolkata'));
        $this->attributes['created_at'] = $dateTime->format('Y-m-d H:i:s');
    }

    public function setUpdatedAt($value)
    {
        $timezone = config('app.timezone', 'Asia/Kolkata');
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $value, new \DateTimeZone($timezone));
        $dateTime->setTimezone(new \DateTimeZone('Asia/Kolkata'));
        $this->attributes['updated_at'] = $dateTime->format('Y-m-d H:i:s');
    }
}