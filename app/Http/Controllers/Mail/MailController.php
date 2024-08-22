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
            'subject' => 'Ini subject emailnya',
            'title' => 'Ini judul email',
            'body' => 'testing kirim email'
        ];

        $email = 'muhammadrivaldifnni01@gmail.com';
        $emailInka = 'inka.aidi29@gmail.com';

        Mail::to($email)->send(new SendEmail($data));

        return 'Email berhasil dikirim';
    }
}
