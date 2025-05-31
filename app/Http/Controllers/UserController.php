<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\VerificationEmailAdmin;
use Illuminate\Auth\Events\Verified;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $user = DB::table('users')
                ->where('nama', 'LIKE', '%' . $request->search . '%')
                ->paginate(10);
        } else {
            $user = DB::table('users')->paginate(10);
        }

        return view('admin.user.useradmin', compact(['user']), ["title" => "Data User"]);
    }
    public function tambahuser()
    {
        return view('admin.user.tambahuser', ["title" => "Data User"]);
    }

    public function tambahdatauser(Request $request)
    {
        user::create([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'password' => bcrypt(($request->password)),
            'role' => $request->role,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Data Berhasil Ditambahkan', 'Success.');
        return redirect('useradmin');
    }
    public function tampilkandatauser($id)
    {
        $user = User::find($id);

        return view('admin.user.tampilkandatauser', compact('user'), ["title" => "Data User"]);
    }

    public function updatedatauser(Request $request, $id)

    {
        User::where('id', $id)->update([
            'nik' => $request->nik,
            'nama' => $request->nama,
            'email' => $request->email,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'no_hp' => $request->no_hp,
            'password' => bcrypt(($request->password)),
            'role' => $request->role,
            'remember_token' => Str::random(60),
        ]);
        Alert::success('Data Berhasil diupdate!', 'success');
        return redirect('useradmin');
    }

    public function hapus($id)
    {
        $data = User::find($id);
        $data->delete();
        // $id = $request->id;
        // DB::table('wisata')
        //     ->where('id', $id)
        //     ->delete();
        Alert::success('Data Berhasil Dihapus', 'Success.');
        return redirect('/useradmin');
    }
    public function sendverificationemail(Request $request, $user)
    {
        // Temukan user berdasarkan ID
        $user = User::find($user);
        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'user' => $user->id,
                'hash' => $user->verification_token
            ]
        );
        // Kirim email verifikasi
        Mail::to($user->email)->send(new VerificationEmail($user, $verificationUrl));

        // Redirect ke halaman yang sesuai setelah mengirim email verifikasi
        Alert::success('Email Verifikasi Berhasil Dikirim', 'Success.');
        return redirect('/useradmin');
    }

    public function sendverificationemaill(Request $request, $user)
    {
        // Temukan user berdasarkan ID
        $user = User::find($user);
        // Generate verification URL
        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'user' => $user->id,
                'hash' => $user->verification_token
            ]
        );
        // Kirim email verifikasi
        Mail::to($user->email)->send(new VerificationEmailAdmin($user, $verificationUrl));

        // Redirect ke halaman yang sesuai setelah mengirim email verifikasi
        Alert::success('Email Verifikasi Berhasil Dikirim', 'Success.');
        return redirect('/useradmin');
    }
}
