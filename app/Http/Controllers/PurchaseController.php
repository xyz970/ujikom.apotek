<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $sale = Purchase::with('supplier');
            return DataTables::eloquent($sale)->addIndexColumn()->toJson();
        }
        return view('admin.purchase.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.purchase.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $purchaseData = [
            'receipt_number' => "PRCHS".Carbon::now()->format('Hmsi') . Str::upper(Str::random(4)),
            'supplier_id' => $input['supplier_id'],
            'pay_amount' => $input['pay_amount'],
            'back_amount' => $input['back_amount'],
            'total'=>$input['total'],
            'date' => Carbon::now()->format('Y-m-d'),
        ];
        $purchase = Purchase::create(
            $purchaseData
        );

        foreach ($input['medicine_items'] as $key => $value) {
            $medicine = Medicine::find($value['id']);
            $newQty = $medicine->stock + $value['qty'];
            $medicine->update(['stock'=>$newQty]);
            PurchaseDetail::create(
                [
                    'purchase_id' => $purchase->id,
                    'medicine_id' => $value['id'],
                    'qty' => $value['qty'],
                    'grand_total' => $value['grand_total']

                ]
            );
        }
        return $this->successResponse("Berhasil Dimasukkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {
        PurchaseDetail::where('purchase_id',$purchase->id)->delete();
        $purchase->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
