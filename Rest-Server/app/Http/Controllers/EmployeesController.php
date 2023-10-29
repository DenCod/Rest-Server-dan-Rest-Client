<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Employees;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $position = Position::all();
        $division = Division::all();
        $employees = Employees::join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('divisions', 'positions.division_id', '=', 'divisions.id')
            ->get(['employees.id', 'employees.name', 'employees.birth_date', 'employees.phone_number', 'employees.join_date', 'divisions.division_name', 'positions.position_name']);

        return response()->json([
            'status' => true,
            'message' => 'Data ditemukan',
            'data' => $employees,
            'position' => $position,
            'division' => $division
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataEmployee = new Employees;
        $rules = [
            'position_id' => 'required',
            'name' => 'required|max:255|',
            'birth_date' => 'required',
            'phone_number' => 'required',
            'gender' => 'required',
            'join_date' => 'required',
            'is_active' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal menambahkan data',
                'data' => $validator->errors()
            ]);
        }

        $dataEmployee->position_id = $request->position_id;
        $dataEmployee->name = $request->name;
        $dataEmployee->birth_date = $request->birth_date;
        $dataEmployee->phone_number = $request->phone_number;
        $dataEmployee->gender = $request->gender;
        $dataEmployee->join_date = $request->join_date;
        $dataEmployee->is_active = $request->is_active;

        $post = $dataEmployee->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambah',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $position = Position::all();
        $division = Division::all();
        $employees = Employees::join('positions', 'employees.position_id', '=', 'positions.id')
            ->join('divisions', 'positions.division_id', '=', 'divisions.id')
            ->where('employees.id', $id)
            ->get();
        if ($employees) {
            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $employees,
                'position' => $position,
                'division' => $division
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'position_id'     => 'required',
            'name'   => 'required',
            'birth_date'   => 'required',
            'phone_number'   => 'required|numeric',
            'gender'   => 'required',
            'join_date'   => 'required',
            'is_active'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal mengubah data',
                'data' => $validator->errors()
            ]);
        }

        //find employee by ID
        $employees = Employees::find($id);

        //update post without image
        $employees->update([
            'position_id'     => $request->position_id,
            'name'   => $request->name,
            'birth_date'   => $request->birth_date,
            'phone_number'   => $request->phone_number,
            'gender'   => $request->gender,
            'join_date'   => $request->join_date,
            'is_active'   => $request->is_active,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil di ubah',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employees = Employees::find($id);
        if (empty($employees)) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan!',
            ], 404);
        }

        $data = $employees->delete();
        return response()->json([
            'status' => true,
            'message' => "Employee deleted"
        ]);
    }
}
