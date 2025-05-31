<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Obat;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ObatExport;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $obat = DB::table('obat_m')
                ->where('nama_obat', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $obat = DB::table('obat_m')->paginate(10);
        }

        return view('admin.obat.obat', compact(['obat']), ["title" => "Data Obat"]);
    }

    public function tambahobat()
    {
        return view('admin.obat.tambahobat', ["title" => "Data Obat"]);
    }

    public function aksi_tambah_obat(Request $request)
    {
        $data = $request->validate([
            'nama_obat'  => 'required',
            'satuan'     => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok'       => 'required',
        ]);

        Obat::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/obat');
    }

    public function editobat(Request $request)
    {
        $id = $request->id;

        $request['obat'] = DB::table('obat_m')
            ->where('id', $id)
            ->get();
        return view('admin.obat.editobat', $request, ["title" => "Data Obat"]);
    }

    public function aksi_edit_obat(Request $request, $id)
    {
        $data = $request->validate([
            'nama_obat'  => 'required',
            'satuan'     => 'required',
            'harga_beli' => 'required',
            'harga_jual' => 'required',
            'stok'       => 'required',
        ]);

        $obat = Obat::find($id);

        $obat->update($data);

        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/obat');
    }

    public function hapus($id)
    {
        $obat = Obat::find($id);

        $obat->delete();

        // Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/obat');
    }

    public function ekspoortpdf()
    {
        $obat = Obat::all();

        $pdf = PDF::loadView('admin.obat.obat-pdf', compact('obat'));

        return $pdf->stream('obat.pdf');
    }
    public function eksportexcell()
    {
        return Excel::download(new ObatExport, 'dataobat.xlsx');
    }
}
