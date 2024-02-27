<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WorkDay extends Model
{
    use HasFactory, SoftDeletes;

    protected static function booted()
    {
        static::deleting(function ($workday) {
            $workday->workSheets()->delete();
            $workday->comment()->delete();
        });
    }

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'user_id',
        'date',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function workSheets() {
        return $this->hasMany(WorkSheet::class);
    }

    public function comment() {
        return $this->hasOne(Comment::class);
    }
}
