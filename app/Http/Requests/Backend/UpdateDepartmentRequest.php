<?php

namespace App\Http\Requests\Backend;

use App\Http\Requests\Backend\Request;
use App\Models\Department;

class UpdateDepartmentRequest extends Request
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return Department::$rules;
    }
}
