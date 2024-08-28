<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteFileObjectStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete {folder}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folder = $this->argument('folder');

        // Pastikan folder diakhiri dengan '/'
        $folder = rtrim($folder, '/') . '/';

        // Dapatkan daftar file di folder
        $files = Storage::disk('s3')->files($folder);

        if (empty($files)) {
            $this->info('No files found in the specified folder.');
            return 0;
        }

        foreach ($files as $file) {
            if (Storage::disk('s3')->delete($file)) {
                $this->info("Successfully deleted: $file");
            } else {
                $this->error("Failed to delete: $file");
            }
        }

        return 0;
    }
}
