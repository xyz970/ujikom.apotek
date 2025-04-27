<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $supplier = Supplier::with('city');
            return DataTables::eloquent($supplier)->addIndexColumn()->toJson();
        }
        return view('admin.supplier');
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
    public function store(SupplierRequest $supplier_request)
    {
        $input = $supplier_request->validated();
        Supplier::create($input);
        return redirect()->back()->with('insertSuccess', 'true');
    }
    
    function data(Request $request) {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Supplier::where('name', 'LIKE', "%$search%")
                ->get();
        }
        return $this->successResponseData("Supplier Data",$data); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return $this->successResponseData('Edit Supplier',$supplier);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $supplier_request, Supplier $supplier)
    {
        $input = $supplier_request->validated();
        $supplier->update($input);
        return redirect()->back()->with('updateSuccess', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
