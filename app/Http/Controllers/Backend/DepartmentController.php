<?php

namespace App\Http\Controllers\Backend;

use App\Http\Requests\Backend\CreateDepartmentRequest;
use App\Http\Requests\Backend\UpdateDepartmentRequest;
use App\Repositories\Backend\DepartmentRepository;
use App\Http\Controllers\Backend\AppBaseController as InfyOmBaseController;

class DepartmentController extends InfyOmBaseController
{
    /** @var  DepartmentRepository */
    private $departmentRepo;

    public function __construct(DepartmentRepository $departmentRepo)
    {
        $this->departmentRepo = $departmentRepo;
    }

    /**
     * Display a listing of the Department.
     *
     * @param Request $request
     * @return Response
     */
    public function index(\Request $request)
    {
        if (request('search')) {
            $departments = $this->departmentRepo->search(request('search'));
        } else {
            $departments = $this->departmentRepo->orderBy('order')->paginate();
        }

        return view('backend.departments.index')
            ->with('departments', $departments);
    }

    /**
     * Show the form for creating a new Department.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.departments.create');
    }

    /**
     * Store a newly created Department in storage.
     *
     * @param CreateDepartmentRequest $request
     *
     * @return Response
     */
    public function store(CreateDepartmentRequest $request)
    {
        $input = $request->all();

        $department = $this->departmentRepo->create($input);

        \Flash::success('已成功新增一筆資料');

        return redirect(route('backend.department.index'));
    }

    /**
     * Display the specified Department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $department = $this->departmentRepo->findWithoutFail($id);

        if (empty($department)) {
            \Flash::error('找不到該筆資料');

            return redirect(route('backend.department.index'));
        }

        return view('backend.departments.show')->with('department', $department);
    }

    /**
     * Show the form for editing the specified Department.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $department = $this->departmentRepo->findWithoutFail($id);

        if (empty($department)) {
            \Flash::error('找不到該筆資料');

            return redirect(route('backend.department.index'));
        }

        return view('backend.departments.edit')->with('department', $department);
    }

    /**
     * Update the specified Department in storage.
     *
     * @param  int $id
     * @param UpdateDepartmentRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateDepartmentRequest $request)
    {
        $department = $this->departmentRepo->findWithoutFail($id);

        if (empty($department)) {
            \Flash::error('找不到該筆資料');

            return redirect(route('backend.department.index'));
        }

        $department = $this->departmentRepo->update($request->all(), $id);

        \Flash::success('已成功更新一筆資料');

        return redirect(route('backend.department.edit', $department->id));
    }

    /**
     * Remove the specified Department from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepo->findWithoutFail($id);

        if (empty($department)) {
            \Flash::error('找不到該筆資料');

            return redirect(route('backend.department.index'));
        }

        $this->departmentRepo->delete($id);

        \Flash::success('已成功刪除一筆資料');

        return redirect(route('backend.department.index'));
    }
}
