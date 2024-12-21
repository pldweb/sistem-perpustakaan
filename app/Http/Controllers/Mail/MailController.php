<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class MailController extends Controller
{
    public function sendMail()
    {
        $data = [
            'subject' => '🚨🚨NINU NINU🚨🚨',
            'title' => 'Halo ini tes kirim email',
            'body' => 'Coba balas ya',
            'love' => 'Cinta'
        ];

        $email = 'muhammadrivaldifnni01@gmail.com';
        $emailInka = 'inka.aidi29@gmail.com';

        Mail::to($emailInka)->send(new SendEmail($data));

        $pesan = "Kirim Email berhasil";
        $pesanType = "success";

        return redirect()->back()->with([
            'pesan' => $pesan,
            'pesanType' => $pesanType
        ]) ;
    }
}
