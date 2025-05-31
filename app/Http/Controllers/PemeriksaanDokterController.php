<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\PemeriksaanDokter;
use Illuminate\Http\Request;
use App\Exports\PemeriksaanDokterExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class PemeriksaanDokterController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pasien_m')
            ->select(
                'pasien_m.*',
                DB::raw("
                    CASE 
                        WHEN EXISTS (
                            SELECT 1 FROM pemeriksaandokter_t 
                            WHERE pemeriksaandokter_t.id_pasien = pasien_m.id
                        ) 
                        THEN 'Sudah Diperiksa' 
                        ELSE 'Belum Diperiksa' 
                    END as status_pemeriksaan_dokter
                ")
            );

        if ($request->has('search')) {
            $query->where('nama_pasien', 'LIKE', '%' . $request->search . '%');
        }

        $pasien = $query->paginate(10);

        return view('admin.dokter.pemeriksaandokter', compact('pasien'), [
            "title" => "Data Pemeriksaan Dokter"
        ]);
    }

    public function tambahpemeriksaandokter()
    {
        return view('admin.dokter.tambahpemeriksaandokter', ["title" => "Data pemeriksaandokter"]);
    }

    public function aksi_tambah_pemeriksaandokter(Request $request)
    {
        $data = $request->validate([
            'nama_pasien'            => 'required',
            'kategori_pemeriksaandokter'        => 'required',
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

        PemeriksaanDokter::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/pemeriksaandokter');
    }

    public function inputpemeriksaandokter(Request $request)
    {
        $id = $request->id;

        // Ambil data pasien JOIN dengan data vital sign
        $pasien = DB::table('pasien_m as p')
            ->leftJoin('pemeriksaanperawat_t as pp', 'p.id', '=', 'pp.id_pasien')
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
                'pp.pernafasan'
            )
            ->where('p.id', $id)
            ->orderBy('pp.tglperiksa', 'desc')
            ->get();

        return view('admin.dokter.inputresumemedis', [
            'pasien' => $pasien,
            'title' => 'Data Pemeriksaan Dokter'
        ]);
    }

    public function aksi_input_resumemedis(Request $request, $id)
    {
        $request->validate([
            'id_pasien'     => 'required|integer|exists:pasien_m,id',
            'tglperiksadokter'   => 'required|date',
            'keluhan'    => 'required',
            'diagnosa'   => 'required',
        ]);

        PemeriksaanDokter::create([
            'id_pasien'     => $request->id_pasien,
            'tglperiksadokter'    => $request->tglperiksadokter,
            'keluhan'    => $request->keluhan,
            'diagnosa'   => $request->diagnosa,
        ]);

        Alert::success('Data Berhasil Ditambah', 'Success.');
        return redirect('/pemeriksaandokter');
    }

    public function detailpemeriksaandokter($id)
    {
        $pasien = DB::table('pasien_m')->where('id', $id)->first();

        $vitalsign = DB::table('pemeriksaanperawat_t')
            ->where('id_pasien', $id)
            ->orderBy('tglperiksa', 'desc')
            ->first();

        $resumemedis = DB::table('pemeriksaandokter_t')
            ->where('id_pasien', $id)
            ->orderBy('tglperiksadokter', 'desc')
            ->get();

        return view('admin.dokter.detailpemeriksaandokter', compact('pasien', 'vitalsign', 'resumemedis'), ["title" => "Data Pemerikasaan Dokter"]);
    }
    public function detailpemeriksaanpasien(Request $request)
    {
        $query = DB::table('pemeriksaandokter_t as pp')
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

        return view('admin.dokter.detailpemeriksaanpasien', compact('periksaperawat'), ["title" => "Data Pemerikasaan Dokter"]);
    }
    
    public function hapus($id)
    {
        $pemeriksaandokter = PemeriksaanDokter::find($id);

        // Menghapus foto dari storage jika ada
        if ($pemeriksaandokter->photo1) {
            Storage::delete('public/photo_pemeriksaandokter/' . $pemeriksaandokter->photo1);
        }

        if ($pemeriksaandokter->photo2) {
            Storage::delete('public/photo_pemeriksaandokter/' . $pemeriksaandokter->photo2);
        }

        if ($pemeriksaandokter->photo3) {
            Storage::delete('public/photo_pemeriksaandokter/' . $pemeriksaandokter->photo3);
        }

        $pemeriksaandokter->delete();

        return redirect('/pemeriksaandokter');
    }

    public function Ekspooortpdf()
    {
        $dokter = DB::table('pemeriksaandokter_t as pp')
            ->join('pasien_m as p', 'pp.id_pasien', '=', 'p.id')
            ->select(
                'pp.*',
                'p.nocm',
                'p.nama_pasien',
                'p.tempat_lahir',
                'p.tgl_lahir',
                'p.no_hp'
            )
            ->get();

        $pdf = PDF::loadView('admin.dokter.pemeriksaandokter-pdf', compact('dokter'));

        return $pdf->stream('pemeriksaandokter.pdf');
    }
}
