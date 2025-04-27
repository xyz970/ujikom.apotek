<?php

namespace App\Http\Controllers;

use App\Models\MedicineFormType;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class MedicineFormTypeController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicine_type = MedicineFormType::all();
        return view('admin.medicine_type',compact('medicine_type'));
    }

    function data(Request $request) {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = MedicineFormType::where('type', 'LIKE', "%$search%")
                ->get();
        }
        return $this->successResponseData("Medicine Type Data",$data); 
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
    public function store(Request $request)
    {
        $input = $request->only(['type']);
        MedicineFormType::create($input);
        return redirect()->back()->with('insertSuccess', 'true');
    }

    /**
     * Display the specified resource.
     */
    public function show(MedicineFormType $medicineFormType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MedicineFormType $medicineFormType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicineFormType $medicineFormType)
    {
        $input = $request->only(['type']);
        $medicineFormType->update($input);
        return redirect()->back()->with('updateSuccess', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicineFormType $medicineFormType)
    {
        $medicineFormType->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
