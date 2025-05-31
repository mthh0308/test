<?php

namespace App\Http\Controllers;

use App\Exports\PasienExport;
use App\Models\Wisata;
use PDF;
use App\Models\Pasien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;


class PasienController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pasien_m')
            ->select(
                'pasien_m.*',
                DB::raw("CASE WHEN EXISTS (SELECT 1 FROM pemeriksaanperawat_t WHERE pemeriksaanperawat_t.id_pasien = pasien_m.id) THEN 'Sudah diperiksa Perawat' ELSE 'Belum diperiksa' END AS status_perawat"),
                DB::raw("CASE WHEN EXISTS (SELECT 1 FROM pemeriksaandokter_t WHERE pemeriksaandokter_t.id_pasien = pasien_m.id) THEN 'Sudah diperiksa Dokter' ELSE 'Belum diperiksa' END AS status_dokter")
            );

        if ($request->has('search')) {
            $query->where('nama_pasien', 'LIKE', '%' . $request->search . '%');
        }

        $pasien = $query->paginate(10);

        return view('admin.pasien.pasien', compact('pasien'))->with(["title" => "Data Pasien"]);
    }

    public function map()
    {
        // Mengambil data pasien dari database
        $pasien = Pasien::all();

        return view('pasien.map', compact('pasien'));
    }
    public function tambahpasien()
    {
        return view('admin.pasien.tambahpasien', ["title" => "Data Wisata"]);
    }

    public function aksi_tambah_pasien(Request $request)
    {
        $validatedData = $request->validate([
            'nama_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        // Buat nocm otomatis (format: YYMMDD + 5 digit urut)
        $today = Carbon::now()->format('ymd'); // contoh: 250531

        $lastNocm = DB::table('pasien_m')
            ->whereRaw("LEFT(nocm, 6) = ?", [$today])
            ->orderBy('nocm', 'desc')
            ->value('nocm');

        if ($lastNocm) {
            $lastNumber = intval(substr($lastNocm, 6)); // Ambil angka urutan
            $newNumber = str_pad($lastNumber + 1, 5, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '00001';
        }

        $generatedNocm = $today . $newNumber;

        $data = $validatedData;
        $data['nocm'] = $generatedNocm;

        Pasien::create($data);

        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/pasien');
    }

    public function editpasien(Request $request)
    {
        $id = $request->id;

        $request['pasien'] = DB::table('pasien_m')
            ->where('id', $id)
            ->get();
        return view('admin.pasien.editpasien', $request, ["title" => "Data Pemeriksaan Pasien"]);
    }

    public function aksi_edit_pasien(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nocm' => 'required',
            'nama_pasien' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'no_hp' => 'required',
        ]);

        $data = $validatedData;

        $pasien = Pasien::findOrFail($id);

        $pasien->update($data);

        Alert::success('Data Berhasil Diubah', 'Success.');
        return redirect('/pasien');
    }
    public function hapus($id)
    {
        $pasien = Pasien::find($id);

        $pasien->delete();

        // Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/pasien');
    }

    public function eksportpdf()
    {
        $pasien = Pasien::all();

        $pdf = PDF::loadView('admin.pasien.pasien-pdf', compact('pasien'));

        return $pdf->stream('pasien.pdf');
    }

    public function eksportexcel()
    {
        return Excel::download(new PasienExport, 'datapasien.xlsx');
    }
}
