<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class UploadAssetToObjectStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:upload-asset-to-object-storage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Mendapatkan path ke folder public dari root project
        $localDirectory = public_path('css/');

        // Mendapatkan semua file dalam folder public dan subfoldernya
        $files = File::allFiles($localDirectory);

        // Mengupload setiap file ke object storage
        foreach ($files as $file) {
            // Mengganti path lokal dengan path di object storage
            $s3FilePath = str_replace(public_path(), 'uploads', $file->getPathname());

            // Mengupload file ke object storage
            Storage::disk('s3')->put($s3FilePath, File::get($file), 'public');

            $this->info("File {$file->getPathname()} has been uploaded to S3 as {$s3FilePath}");
        }

        $this->info("Semua file dari public telah di-upload ke S3.");
    }

}
