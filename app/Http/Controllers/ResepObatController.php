<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\ResepObat;
use Illuminate\Http\Request;
use App\Exports\ResepObatExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class ResepObatController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pasien_m')
            ->leftJoin('pemeriksaandokter_t', 'pemeriksaandokter_t.id_pasien', '=', 'pasien_m.id')
            ->select(
                'pasien_m.*',
                'pemeriksaandokter_t.keluhan',
                'pemeriksaandokter_t.diagnosa',
                DB::raw("
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 FROM resepobat_t 
                            WHERE resepobat_t.id_pasien = pasien_m.id
                        ) 
                        THEN 'Sudah diberi Obat' 
                        ELSE 'Belum diberi Obat' 
                    END as status_pemeriksaan_apoteker
                ")
            );

        if ($request->has('search')) {
            $query->where('nama_pasien', 'LIKE', '%' . $request->search . '%');
        }

        $pasien = $query->paginate(10);

        return view('admin.apoteker.resepobat', compact('pasien'), [
            "title" => "Data Pemeriksaan Dokter"
        ]);
    }

    public function tambahresepobat()
    {
        return view('admin.apoteker.tambahresepobat', ["title" => "Data resepobat"]);
    }

    public function aksi_tambah_resepobat(Request $request)
    {
        $data = $request->validate([
            'nama_pasien'            => 'required',
            'kategori_resepobat'        => 'required',
            'deskripsi_singkat'     => 'required',
            'jam_operasional'       => 'required',
            'kontak'                => 'required',
            'alamat'                => 'required',
            'latitude'              => 'required',
            'longitude'             => 'required',
            'photo1'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo2'                => 'nullable|file|image|mimes:png,jpg,jpeg',
            'photo3'                => 'nullable|file|image|mimes:png,jpg,jpeg'
        ]);

        ResepObat::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/resepobat');
    }

    public function inputresepobat(Request $request)
    {
        $id = $request->id;

        $pasien = DB::table('pasien_m as p')
            ->leftJoin('pemeriksaanperawat_t as pp', 'p.id', '=', 'pp.id_pasien')
            ->leftJoin('pemeriksaandokter_t as pd', 'p.id', '=', 'pd.id_pasien')
            ->select(
                'p.id',
                'p.nocm',
                'p.nama_pasien',
                'p.tempat_lahir',
                'p.tgl_lahir',
                'p.jenis_kelamin',
                'p.no_hp',
                'pp.tglperiksa',
                'pp.beratbadan',
                'pp.tinggibadan',
                'pp.tekanandarah',
                'pp.suhu',
                'pp.nadi',
                'pp.pernafasan',
                'pd.keluhan',
                'pd.diagnosa',
            )
            ->where('p.id', $id)
            ->orderBy('pp.tglperiksa', 'desc')
            ->get();

        $obat = DB::table('obat_m')->get();

        return view('admin.apoteker.inputresepobat', [
            'pasien' => $pasien,
            'obat' => $obat,
            'title' => 'Data Resep Obat'
        ]);
    }

    public function aksi_input_resep(Request $request, $id)
    {
        $request->validate([
            'id_pasien'     => 'required|integer|exists:pasien_m,id',
            'tglresep'      => 'required|date',
            'jumlah'       => 'required',
            'id_obat'       => 'required|exists:obat_m,id',
        ]);

        ResepObat::create([
            'id_pasien'     => $request->id_pasien,
            'tglresep'      => $request->tglresep,
            'jumlah'       => $request->jumlah,
            'id_obat'       => $request->id_obat,
        ]);

        Alert::success('Data Berhasil Ditambah', 'Success.');
        return redirect('/resepobat');
    }

    public function detailresepobat($id)
    {
        $pasien = DB::table('pasien_m')->where('id', $id)->first();

        $vitalsign = DB::table('pemeriksaanperawat_t')
            ->where('id_pasien', $id)
            ->orderBy('tglperiksa', 'desc')
            ->first();

        $obat = DB::table('resepobat_t as ro')
            ->leftjoin('obat_m as ob', 'ro.id_obat', '=', 'ob.id')
            ->where('id_pasien', $id)
            ->orderBy('tglresep', 'desc')
            ->get();

        return view('admin.apoteker.detailresepobat', compact('pasien', 'vitalsign', 'obat'), ["title" => "Data Pemberian Obat"]);
    }

    public function editresepobat($id)
    {
        $resep = DB::table('resepobat_t as ro')
            ->join('pasien_m as p', 'ro.id_pasien', '=', 'p.id')
            ->leftJoin('pemeriksaanperawat_t as pp', 'p.id', '=', 'pp.id_pasien')
            ->leftJoin('pemeriksaandokter_t as pd', 'p.id', '=', 'pd.id_pasien')
            ->select(
                'ro.*',
                'p.nocm',
                'p.nama_pasien',
                'p.tempat_lahir',
                'p.tgl_lahir',
                'p.jenis_kelamin',
                'p.no_hp',
                'pp.tglperiksa',
                'pp.beratbadan',
                'pp.tinggibadan',
                'pp.tekanandarah',
                'pp.suhu',
                'pp.nadi',
                'pp.pernafasan',
                'pd.keluhan',
                'pd.diagnosa'
            )
            ->where('ro.id', $id)
            ->get();

        $obat = DB::table('obat_m')->get();

        return view('admin.apoteker.editresepobat', [
            'pasien' => $resep,
            'obat' => $obat,
            'title' => 'Edit Resep Obat'
        ]);
    }

    public function aksi_edit_resep(Request $request, $id)
    {
        $request->validate([
            'id_pasien' => 'required|integer|exists:pasien_m,id',
            'tglresep'  => 'required|date',
            'jumlah'    => 'required|numeric',
            'id_obat'   => 'required|exists:obat_m,id',
        ]);

        $resep = ResepObat::findOrFail($id);

        $resep->update([
            'id_pasien' => $request->id_pasien,
            'tglresep'  => $request->tglresep,
            'jumlah'    => $request->jumlah,
            'id_obat'   => $request->id_obat,
        ]);

        Alert::success('Data Resep Berhasil Diupdate', 'Success.');
        return redirect('/resepobat');
    }

    public function detailpemeriksaanpasien(Request $request)
    {
        $query = DB::table('resepobat_t as pp')
            ->join('pasien_m as p', 'pp.id_pasien', '=', 'p.id')
            ->select(
                'pp.tglperiksa as tgl_periksa',
                'pp.beratbadan',
                'pp.tinggibadan',
                'pp.tekanandarah',
                'pp.suhu',
                'pp.nadi',
                'pp.pernafasan',
                'p.nocm',
                'p.nama_pasien',
                'p.tempat_lahir',
                'p.tgl_lahir',
                'p.jenis_kelamin',
                'p.no_hp'
            )
            ->orderBy('pp.tglperiksa', 'desc');

        if ($request->has('search')) {
            $query->where('p.nama_pasien', 'like', '%' . $request->search . '%');
        }

        $periksaperawat = $query->paginate(10);

        return view('admin.apoteker.detailpemeriksaanpasien', compact('periksaperawat'), ["title" => "Data Pemerikasaan Dokter"]);
    }
    
    public function hapus($id)
    {
        $resepobat = ResepObat::find($id);

        $resepobat->delete();

        return redirect('/resepobat');
    }

    public function EKspooortpdf()
    {
        $resepobat = DB::table('resepobat_t as pp')
            ->join('pasien_m as p', 'pp.id_pasien', '=', 'p.id')
            ->join('obat_m as ob', 'pp.id_obat', '=', 'ob.id')
            ->select(
                'pp.*',
                'p.nocm',
                'p.nama_pasien',
                'p.tempat_lahir',
                'p.tgl_lahir',
                'p.no_hp',
                'ob.nama_obat',
            )
            ->get();

        $pdf = PDF::loadView('admin.apoteker.resepobat-pdf', compact('resepobat'));

        return $pdf->stream('resepobat.pdf');
    }
    public function eeksportexceel()
    {
        return Excel::download(new ResepObatExport, 'dataresepobat.xlsx');
    }
}
