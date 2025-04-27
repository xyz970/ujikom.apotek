<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Medicine;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Traits\ApiResponse;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SaleController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return view('customer.sale');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.sale.insert');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $saleData = [
            'receipt_number' => "SALE".Carbon::now()->format('Hmsi') . Str::upper(Str::random(4)),
            'costumer_id' => $input['customer_id'],
            'pay_amount' => $input['pay_amount'],
            'back_amount' => $input['back_amount'],
            'total'=>$input['total'],
            'date' => Carbon::now()->format('Y-m-d'),
        ];
        // dd($saleData);
        $sale = Sale::create(
            $saleData
        );

        foreach ($input['medicine_items'] as $key => $value) {
            $medicine = Medicine::find($value['id']);
            $newQty = $medicine->stock - $value['qty'];
            $medicine->update(['stock'=>$newQty]);
            SaleDetail::create(
                [
                    'sale_id' => $sale->id,
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
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sale $sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        SaleDetail::where('sale_id',$sale->id)->delete();
        $sale->delete();
        return redirect()->back()->with('deleteSuccess', 'true');
    }
}
