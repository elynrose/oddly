<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Job extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, HasFactory;

    public $table = 'jobs';

    protected $appends = [
        'attachments',
        'completed_files',
    ];

    protected $dates = [
        'deadline',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'title',
        'category_id',
        'description',
        'budget_id',
        'status_id',
        'deadline',
        'completed_link',
        'published',
        'job_code',
        'user_id',
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
        self::observe(new \App\Observers\JobActionObserver);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getAttachmentsAttribute()
    {
        return $this->getMedia('attachments');
    }

    public function budget()
    {
        return $this->belongsTo(Budget::class, 'budget_id');
    }

    public function status()
    {
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function getCompletedFilesAttribute()
    {
        return $this->getMedia('completed_files');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
