<?php
namespace App\Exports\Sheets;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class MedicineSalesSheet implements FromQuery, WithTitle, WithHeadings, WithHeadingRow{

    public function headings(): array
    {
        return [
            ["Laporan Penjualan Obat"],
            [
                'Struk ID',
                'Nama Obat',
                'Qty',
                'Total',
            ]
        ];
    }

    public function query()
    {
        $data = DB::table('sale_details')
        ->join('sales','sale_details.sale_id','=','sales.id')
        ->join('medicines','sale_details.medicine_id','=','medicines.id')
        ->orderBy('sales.receipt_number')
        ->select(['sales.receipt_number','medicines.name','sale_details.qty','sale_details.grand_total']);
        // $data =  DB::table('jurnal')
        // ->whereNull('deleted_at')
        // // ->query()
        // ->where('jurnal.usaha_id','=',$this->usaha_id)
        // ->whereBetween('tanggal',[$this->tanggal_awal, $this->tanggal_akhir])
        // ->join('daftar_akun_bawaan','jurnal.akun_id','=','daftar_akun_bawaan.id')
        // ->orderBy('daftar_akun_bawaan.nama_akun')
        // ->select(['jurnal.tanggal','daftar_akun_bawaan.nama_akun','jurnal.nomor_bukti','jurnal.keterangan_transaksi','jurnal.debit','jurnal.kredit','jurnal.jumlah','jurnal.buku_pembantu']);
        // // ->get();
        return $data;
    }

    public function title(): string
    {
        return 'Penjualan Obat';
    }

    public function headingRow(): int
    {
        return 2;
    }
}