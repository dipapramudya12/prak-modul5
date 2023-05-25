<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{

    public function index()
    {
        $pageTitle = 'Employee List';
// RAW SQL QUERY
$employees = DB::select('
select *, employees.id as employee_id, positions.name as
position_name
from employees
left join positions on employees.position_id = positions.id
');
return view('employee.index', [
'pageTitle' => $pageTitle,
'employees' => $employees
]);

    }


    public function create()
    {
        $pageTitle = 'Create Employee';
        // RAW SQL Query
        $positions = DB::select('select * from positions');
        return view('employee.create', compact('pageTitle', 'positions'));

    }

    public function store(Request $request)
    {
        $messages = [
            'required' => ':Attribute harus diisi.',
            'email' => 'Isi :attribute dengan format yang benar',
            'numeric' => 'Isi :attribute dengan angka'
            ];
            $validator = Validator::make($request->all(), [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'age' => 'required|numeric',
            ], $messages);
            if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
            }
            // INSERT QUERY
            DB::table('employees')->insert([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'email' => $request->email,
            'age' => $request->age,
            'position_id' => $request->position,
            ]);

            return redirect()->route('employees.index');

}

public function show(string $id)
{
$pageTitle = 'Employee Detail';
// RAW SQL QUERY
$employee = collect(DB::select('
select *, employees.id as employee_id, positions.name as
position_name
from employees
left join positions on employees.position_id = positions.id
where employees.id = ?
', [$id]))->first();
return view('employee.show', compact('pageTitle', 'employee'));
}

public function destroy(string $id)
{
// QUERY BUILDER
DB::table('employees')
->where('id', $id)
->delete();
return redirect()->route('employees.index');
}

public function edit(string $id)
{
    $pageTitle = 'Edit Employee';
        // RAW SQL Query
        $employee = collect(DB::select('
select *, employees.id as employee_id, positions.name as
position_name
from employees
left join positions on employees.position_id = positions.id
where employees.id = ?
', [$id]))->first();
$positions = DB::select('select * from positions');
        return view('employee.edit', [
            'pageTitle' => $pageTitle,
            'employee' => $employee,
            'positions' => $positions
            ]);
}

public function update(Request $request, string $id) {
        $messages = [
        'required' => ':Attribute harus diisi.',
        'email' => 'Isi :attribute dengan format yang benar',
        'numeric' => 'Isi :attribute dengan angka'
        ];

        $validator = Validator::make($request->all(), [
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|email',
        'age' => 'required|numeric',
        ], $messages);

        if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
        }
        // UPDATE QUERY
        DB::table('employees')
        ->where('id', $id)
        ->update([
            'firstname' => $request->firstName,
            'lastname' => $request->lastName,
            'email' => $request->email,
            'age' => $request->age,
            'position_id' => $request->position,
        ]);

        return redirect()->route('employees.index');
}


}
