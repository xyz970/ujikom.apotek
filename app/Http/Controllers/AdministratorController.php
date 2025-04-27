<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorRequest;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdministratorController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $adminstrator_data = User::query();
            return DataTables::eloquent($adminstrator_data)->addIndexColumn()->toJson();
        }
        return view('admin.administrator');
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
    public function store(AdministratorRequest $request)
    {
        $input = $request->validated();
        $input += array('password' => '12345');
        User::create($input);
        return redirect()->back()->with('insertSuccess', 'true');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        return $this->successResponseData("Data User", $user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdministratorRequest $administrator_request, string $id)
    {
        $input = $administrator_request->validated();
        $user = User::find($id);
        $user->update($input);
        return redirect()->back()->with('updateSuccess', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
