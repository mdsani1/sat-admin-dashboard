<?php

namespace App\Models;

use Illuminate\Support\Str;
use App\Traits\Historiable;
use App\Traits\UserTrackable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class ExamSection extends Model
{
    use HasFactory, UserTrackable, Historiable, SoftDeletes;

    /**
     * Indicates that the primary key is not auto-incrementing.
     */
    // public $incrementing = false;

    /**
     * Specifies the primary key type as a string (UUID).
     */
    // protected $keyType = 'string';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_sections';

    /**
     * The attributes that should be mass-assignable.
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     */
    protected $casts = [
        'num_questions' => 'integer',
        'duration' => 'integer',
    ];

    /**
     * Boot function to generate a UUID before creating a new section.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($section) {
            $section->uuid = (string) Str::uuid(); 
        });
    }

    /**
     * Relationship: A section belongs to an exam.
     */
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    /**
     * Many-to-Many Relationship: Questions associated with this section.
     */
    public function questions()
    {
        return $this->belongsToMany(ExamQuestion::class, 'section_question_pivot', 'section_id', 'question_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}