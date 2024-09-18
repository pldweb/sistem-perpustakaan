<?php

namespace App\Mail;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookReminder extends Mailable
{
    use Queueable, SerializesModels;

    public $peminjaman;

    public function __construct($peminjaman)
    {
        $this->peminjaman = $peminjaman;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🚨🚨Reminder Pengembalian Buku 🚨🚨',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $formatTanggal = Carbon::parse($this->peminjaman->tanggal_pengembalian)->format('d M Y');

        return new Content(
            view: 'emails.book_return_reminder',
            with: [
                'peminjaman_nama' => $this->peminjaman->nama,
                'tanggal_pengembalian' => $formatTanggal,
            ],
        );

    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
