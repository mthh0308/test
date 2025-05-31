<?php

namespace App\Exports;

use App\Models\Obat;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class ObatExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $obat;

    public function __construct()
    {
        $this->obat = Obat::all();
    }

    public function view(): View
    {
        return view('admin.obat.obat-excel', [
            'obat' => $this->obat
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'Nama obat',
            'Kategori obat',
            'Deskripsi Singkat',
            'Website',
            'Kontak',
            'Alamat',
        ];
    }


}
