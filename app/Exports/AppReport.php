<?php

namespace App\Exports;

use App\Exports\Sheets\MedicineSalesSheet;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithProperties;

class AppReport implements WithMultipleSheets, WithProperties, ShouldAutoSize
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new MedicineSalesSheet();

        return $sheets;
    }

    public function properties(): array
    {
        
        return [
            'creator'        => Auth::user()->name,
            'lastModifiedBy' => Auth::user()->name,
            'title'          => 'Export Rekap',
            'description'    => 'Export Rekapan',
            'keywords'       => 'export,spreadsheet',
            'manager'        => Auth::user()->name,
        ];
    }
}
