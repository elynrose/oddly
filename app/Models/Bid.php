<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bid extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'bids';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'job_id',
        'bid_amount',
        'points_required',
        'featured',
        'highlighted',
        'free',
        'user_id',
        'selected',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public static function boot()
    {
        parent::boot();
        self::observe(new \App\Observers\BidActionObserver);
    }

    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
