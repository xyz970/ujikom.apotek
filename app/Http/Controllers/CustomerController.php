<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CustomerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $supplier = Customer::with('city');
            return DataTables::eloquent($supplier)->addIndexColumn()->toJson();
        }
        return view('admin.customer');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    function data(Request $request) {
        $data = [];

        if ($request->has('q')) {
            $search = $request->q;
            $data = Customer::where('name', 'LIKE', "%$search%")
                ->get();
        }
        return $this->successResponseData("Customer Data",$data); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $customer_request)
    {
        $input = $customer_request->validated();
        Customer::create($input);
        return redirect()->back()->with('insertSuccess', 'true');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }

    
}
