<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\PemeriksaanPerawat;
use Illuminate\Http\Request;
use App\Exports\PemeriksaanPerawatExport;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Contracts\Service\Attribute\Required;

class PemeriksaanPerawatController extends Controller
{
    public function index(Request $request)
    {
        $query = DB::table('pasien_m as p')
        ->leftJoin('pemeriksaanperawat_t as pp', 'p.id', '=', 'pp.id_pasien')
        ->select(
            'p.*',
            'pp.id as id_vitalsign',
            DB::raw("CASE WHEN pp.id IS NOT NULL THEN 'Sudah diperiksa' ELSE 'Belum diperiksa' END as status_periksa")
        );

        if ($request->has('search')) {
            $query->where('nama_pasien', 'LIKE', '%' . $request->search . '%');
        }

        $pasien = $query->paginate(10);

        return view('admin.perawatan.pemeriksaanperawat', compact('pasien'), ["title" => "Data Pemeriksaan Perawat"]);
    }

    public function tambahpemeriksaanperawat()
    {
        return view('admin.perawatan.tambahpemeriksaanperawat', ["title" => "Data pemeriksaanperawat"]);
    }

    public function aksi_tambah_pemeriksaanperawat(Request $request)
    {
        $data = $request->validate([
            'nama_pasien'            => 'required',
            'kategori_pemeriksaanperawat'        => 'required',
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

        PemeriksaanPerawat::create($data);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('/pemeriksaanperawat');
    }

    public function inputpemeriksaanperawat(Request $request)
    {
        $id = $request->id;

        $request['pasien'] = DB::table('pasien_m')
            ->where('id', $id)
            ->get();
        return view('admin.perawatan.inputvitalsign', $request, ["title" => "Data Pemerikasaan Perawat"]);
    }

    public function aksi_input_vitalsign(Request $request, $id)
    {
        $request->validate([
            'id_pasien'     => 'required|integer|exists:pasien_m,id',
            'tglperiksa'   => 'required|date',
            'beratbadan'    => 'required',
            'tinggibadan'   => 'required',
            'tekanandarah'  => 'required',
            'suhu'          => 'required',
            'nadi'          => 'required',
            'pernafasan'    => 'required',
        ]);

        PemeriksaanPerawat::create([
            'id_pasien'     => $request->id_pasien,
            'tglperiksa'    => $request->tglperiksa,
            'beratbadan'    => $request->beratbadan,
            'tinggibadan'   => $request->tinggibadan,
            'tekanandarah'  => $request->tekanandarah,
            'suhu'          => $request->suhu,
            'nadi'          => $request->nadi,
            'pernafasan'    => $request->pernafasan,
        ]);

        Alert::success('Data Berhasil Ditambah', 'Success.');
        return redirect('/pemeriksaanperawat');
    }

    public function detailpemeriksaanperawat($id)
    {
        $pasien = DB::table('pasien_m')->where('id', $id)->first();

        $vitalsign = DB::table('pemeriksaanperawat_t')
            ->where('id_pasien', $id)
            ->orderBy('tglperiksa', 'desc')
            ->get();

        return view('admin.perawatan.detailpemeriksaanperawat', compact('pasien', 'vitalsign'), ["title" => "Data Pemerikasaan Perawat"]);
    }
    public function detailpemeriksaanpasien(Request $request)
    {
        $query = DB::table('pemeriksaanperawat_t as pp')
        ->leftJoin('pasien_m as p', 'pp.id_pasien', '=', 'p.id')
        ->leftJoin('resepobat_t as rb', 'p.id', '=', 'rb.id_pasien')
        ->leftJoin('obat_m as ob', 'ob.id', '=', 'rb.id_obat')
        ->leftJoin('pemeriksaandokter_t as pd', 'p.id', '=', 'pd.id_pasien')
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
            'p.no_hp',
            'pd.tglperiksadokter',
            'pd.keluhan',
            'pd.diagnosa',
            'rb.tglresep',
            'ob.nama_obat',
            'rb.jumlah',
        )
        ->orderBy('pp.tglperiksa', 'desc');

        if ($request->has('search')) {
            $query->where('p.nama_pasien', 'like', '%' . $request->search . '%');
        }

        $periksaperawat = $query->paginate(10);

        return view('admin.perawatan.detailpemeriksaanpasien', compact('periksaperawat'), ["title" => "Data Pemerikasaan Perawat"]);
    }

    public function hapus($id)
    {
        $pemeriksaanperawat = PemeriksaanPerawat::find($id);

        $pemeriksaanperawat->delete();

        return redirect('/pemeriksaanperawat');
    }

    public function EKSPORTpdf()
    {
        $query = DB::table('pemeriksaanperawat_t as pp')
        ->leftJoin('pasien_m as p', 'pp.id_pasien', '=', 'p.id')
        ->leftJoin('resepobat_t as rb', 'p.id', '=', 'rb.id_pasien')
        ->leftJoin('obat_m as ob', 'ob.id', '=', 'rb.id_obat')
        ->leftJoin('pemeriksaandokter_t as pd', 'p.id', '=', 'pd.id_pasien')
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
            'p.no_hp',
            'pd.tglperiksadokter',
            'pd.keluhan',
            'pd.diagnosa',
            'rb.tglresep',
            'ob.nama_obat',
            'rb.jumlah',
        )
        ->orderBy('pp.tglperiksa', 'desc');
        $pemeriksaanperawat = $query->get();

        $pdf = PDF::loadView('admin.perawatan.pemeriksaanperawat-pdf', compact('pemeriksaanperawat'));

        return $pdf->stream('pemeriksaanperawat.pdf');
    }
    public function eeksportexceel()
    {
        return Excel::download(new PemeriksaanPerawatExport, 'datapemeriksaanperawat.xlsx');
    }
}
