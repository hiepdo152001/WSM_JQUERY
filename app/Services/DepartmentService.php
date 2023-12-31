<?php

namespace App\Services;

use App\Models\Departments;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Type\Integer;

class DepartmentService extends CrudService
{

    /**
     * 
     *
     * @var Departments
     */
    protected $department;
    public function __construct(Departments $department)
    {
        $this->department = $department;
        parent::__construct($this->department);
    }

    // public function create($request)
    // {
    //     return Departments::create([
    //         'name' => $request->name,
    //     ]);
    // }

    // public function edit($id, $request)
    // {
    //     $department = Departments::find($id);
    //     $department->name = $request->name;
    //     return $department->save();
    // }

    public function get()
    {
        return Departments::all();
    }

    // public function getById($id)
    // {
    //     return Departments::find($id);
    // }
}