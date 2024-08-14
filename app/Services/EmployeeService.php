<?php
namespace App\Services;

use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\EmployeeRequest;
use App\Repositories\EmployeeRepositoryInterface;

class EmployeeService 
{
    use ImageTrait;
    public function __construct(
        protected EmployeeRepositoryInterface $employeeRepository
    ) {
    }

    public function getData($filter)
    {
        return $this->employeeRepository->getData($filter);
    }

    public function showTasks($id)
    {
        return $this->employeeRepository->show($id);
    }

    public function createEmployee(EmployeeRequest $request)
    {
        $data = $request->except('image', 'first_name', 'last_name', '_token', 'password', 'password_confirmation');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $data['image'] = $this->upload_image($file);
        }

        $data['password'] = Hash::make($request->password);
        $data['name'] = $request->first_name . ' ' . $request->last_name;
        $data['type'] = 'employee';
        $data['manager_id'] = auth()->user()->id;

        return $this->employeeRepository->create($data);
    }


    public function updateEmployee(EmployeeRequest $request, User $employee)
    {
        $data = $request->except('image', 'first_name', 'last_name', '_token', 'password', 'password_confirmation');
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $this->delete_image($employee->image);
            $data['image'] = $this->upload_image($file);
        }
        
        if ($request->password != null) {
            $data['password'] = Hash::make($request->password);
        }
        
        $data['name'] = $request->first_name . ' ' . $request->last_name;
        
        return $this->employeeRepository->update($employee, $data);
    }

    public function deleteEmployee(User $employee)
    {
        return $this->employeeRepository->delete($employee);
    }

}