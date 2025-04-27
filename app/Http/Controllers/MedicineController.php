<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicineRequest;
use App\Models\Medicine;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MedicineController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $medicine = Medicine::with(['supplier','medicine_form_type']);
            return DataTables::eloquent($medicine)->addIndexColumn()->toJson();
        }
        return view('admin.medicine');
    }

    function data(Request $request) {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Medicine::without(['supplier','medicine_form_type'])->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return $this->successResponseData("Medicine Data",$data); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicineRequest $medicine_request)
    {
        $input = $medicine_request->validated();
        Medicine::create($input);
        return redirect()->back()->with('insertSuccess', 'true');
    }

    /**
     * Display the specified resource.
     */
    public function show(Medicine $medicine)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        return $this->successResponseData("Medicine Edit",$medicine);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicineRequest $medicine_request, Medicine $medicine)
    {
        $input = $medicine_request->validated();
        $medicine->update($input);
        return redirect()->back()->with('updateSuccess', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
