<?php

namespace App\Exports;

use App\Models\Pasien;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;



class PasienExport implements FromView, WithHeadings, ShouldAutoSize
{
    private $pasien;

    public function __construct()
    {
        $this->pasien = Pasien::all();
    }

    public function view(): View
    {
        return view('admin.pasien.pasien-excel', [
            'pasien' => $this->pasien
        ]);
    }

    public function headings(): array
    {
        return [
            'No',
            'No Rekam Medis',
            'Nama Pasien',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'No Hp',
        ];
    }


}
