<?php

namespace App\Repositories\Backend;

use App\Models\Department;
use InfyOm\Generator\Common\BaseRepository;

class DepartmentRepository extends BaseRepository
{
    /**
     * Configure the Model
     **/
    public function model()
    {
        return Department::class;
    }

    public function search($search = null)
    {
        $department = Department::orderBy('created_at');

        if ($search) {
            $department = $department->where('name', 'LIKE', '%' . $search . '%');
        }

        return $department->paginate();
    }
}
