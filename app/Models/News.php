<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class News
 * @package App\Models
 */
class News extends Model
{
    public $table = 'news';

    public $fillable = [
        'title',
        'content',
        'department_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'content' => 'required',
        'department_id' => 'required'
    ];

    // Relations
    public function attachments()
    {
        return $this->hasMany('App\Models\Attachment');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

}
