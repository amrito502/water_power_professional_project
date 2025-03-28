<?php

namespace App\Http\Controllers;

use App\Models\Shift;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::with(['shift', 'department', 'designation', 'role'])->get();
        return view('system.components.employee.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shifts = Shift::all();
        $departments = Department::all();
        $designations = Designation::all();
        $roles = Role::all();
        return view('system.components.employee.create', compact('shifts', 'departments', 'designations', 'roles'));
    }


    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|unique:employees',
        ]);

        $employee = new Employee();
        $employee->user_id = Auth::id();
        $employee->employee_id = $request->employee_id;
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->gender = $request->gender;
        $employee->date_of_birth = $request->date_of_birth;
        $employee->nationality = $request->nationality;
        $employee->marital_status = $request->marital_status;
        $employee->phone_number = $request->phone_number;
        $employee->email = $request->email;
        $employee->emergency_contact_number = $request->emergency_contact_number;
        $employee->address = $request->address;
        $employee->job_title = $request->job_title;
        $employee->date_of_joining = $request->date_of_joining;
        $employee->work_location = $request->work_location;
        $employee->basic_salary = $request->basic_salary;
        $employee->bank_name = $request->bank_name;
        $employee->account_number = $request->account_number;
        $employee->ifsc_code = $request->ifsc_code;
        $employee->tax_id = $request->tax_id;
        $employee->user_id = $request->user_id;
        $employee->shift_id = $request->shift_id;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;
        $employee->role_id = $request->role_id;
        $employee->status = $request->status;

        // Image Upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $imagePath = public_path('uploads/employees');

            if (!File::exists($imagePath)) {
                File::makeDirectory($imagePath, 0755, true);
            }

            $image->move($imagePath, $imageName);
            $employee->image = 'uploads/employees/' . $imageName;
        }

        $employee->save();

        return redirect()->route('employees.index')->with('success', 'Employee successfully created');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('system.components.employee.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $shifts = Shift::all();
        $departments = Department::all();
        $designations = Designation::all();
        $roles = Role::all();
        return view('system.components.employee.edit', compact('employee', 'shifts', 'departments', 'designations', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        if ($employee->image && File::exists(public_path($employee->image))) {
            File::delete(public_path($employee->image));
        }

        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Employee deleted successfully.');
    }






    public function exportEmployees()
    {
        
        $employees = Employee::with(['shift', 'department', 'designation', 'role'])->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Employee ID');
        $sheet->setCellValue('C1', 'First Name');
        $sheet->setCellValue('D1', 'Last Name');
        $sheet->setCellValue('E1', 'Gender');
        $sheet->setCellValue('F1', 'Date of Birth');
        $sheet->setCellValue('G1', 'Nationality');
        $sheet->setCellValue('H1', 'Marital Status');
        $sheet->setCellValue('I1', 'Phone Number');
        $sheet->setCellValue('J1', 'Email');
        $sheet->setCellValue('K1', 'Emergency Contact');
        $sheet->setCellValue('L1', 'Address');
        $sheet->setCellValue('M1', 'Job Title');
        $sheet->setCellValue('N1', 'Date of Joining');
        $sheet->setCellValue('O1', 'Work Location');
        $sheet->setCellValue('P1', 'Basic Salary');
        $sheet->setCellValue('Q1', 'Bank Name');
        $sheet->setCellValue('R1', 'Account Number');
        $sheet->setCellValue('S1', 'IFSC Code');
        $sheet->setCellValue('T1', 'Tax ID');
        $sheet->setCellValue('U1', 'User ID');
        $sheet->setCellValue('V1', 'Shift ID');
        $sheet->setCellValue('W1', 'Department ID');
        $sheet->setCellValue('X1', 'Designation ID');
        $sheet->setCellValue('Y1', 'Role ID');
        $sheet->setCellValue('Z1', 'Image');
        $sheet->setCellValue('AA1', 'Status');
        $sheet->setCellValue('AB1', 'Created At');
        $sheet->setCellValue('AC1', 'Updated At');

        $row = 2; 
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $row, $employee->id);
            $sheet->setCellValue('B' . $row, $employee->employee_id);
            $sheet->setCellValue('C' . $row, $employee->first_name);
            $sheet->setCellValue('D' . $row, $employee->last_name);
            $sheet->setCellValue('E' . $row, $employee->gender);
            $sheet->setCellValue('F' . $row, $employee->date_of_birth);
            $sheet->setCellValue('G' . $row, $employee->nationality);
            $sheet->setCellValue('H' . $row, $employee->marital_status);
            $sheet->setCellValue('I' . $row, $employee->phone_number);
            $sheet->setCellValue('J' . $row, $employee->email);
            $sheet->setCellValue('K' . $row, $employee->emergency_contact_number);
            $sheet->setCellValue('L' . $row, $employee->address);
            $sheet->setCellValue('M' . $row, $employee->job_title);
            $sheet->setCellValue('N' . $row, $employee->date_of_joining);
            $sheet->setCellValue('O' . $row, $employee->work_location);
            $sheet->setCellValue('P' . $row, $employee->basic_salary);
            $sheet->setCellValue('Q' . $row, $employee->bank_name);
            $sheet->setCellValue('R' . $row, $employee->account_number);
            $sheet->setCellValue('S' . $row, $employee->ifsc_code);
            $sheet->setCellValue('T' . $row, $employee->tax_id);
            $sheet->setCellValue('U' . $row, $employee->user_id);
            $sheet->setCellValue('V' . $row, $employee->shift->shift_name);
            $sheet->setCellValue('W' . $row, $employee->department->name);
            $sheet->setCellValue('X' . $row, $employee->designation->name);
            $sheet->setCellValue('Y' . $row, $employee->role->name);
            $sheet->setCellValue('Z' . $row, $employee->image);
            $sheet->setCellValue('AA' . $row, $employee->status == 1 ? 'Active' : 'Inactive');
            $sheet->setCellValue('AB' . $row, $employee->created_at);
            $sheet->setCellValue('AC' . $row, $employee->updated_at);
            $row++;
        }


        $writer = new Xlsx($spreadsheet);
        $fileName = 'employees.xlsx';
        $writer->save(public_path($fileName));

       
        return response()->download(public_path($fileName));
    }
}
