<?php

namespace App\Models;

use Eloquent as Model;

/**
 * Class Department
 * @package App\Models
 */
class Department extends Model
{

    public $table = 'departments';

    public $fillable = [
        'name'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'order' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required'
    ];

    // Relations
    public function news()
    {
        return $this->hasMany('App\Models\News');
    }

    // Methods
    public static function getList($selector = false)
    {
        $departments = self::all()->lists('name', 'id')->all();

        if ($selector) {
            array_unshift($departments, '請選擇');
        }

        return $departments;
    }
}
