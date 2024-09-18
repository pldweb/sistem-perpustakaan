<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteSpecificFileObjectStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'files:delete-file {files*}';

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
        $files = $this->argument('files');

        if (empty($files)) {
            $this->info('No files specified for deletion.');
            return 0;
        }

        foreach ($files as $file) {
            // Menghapus file dari Object Storage
            if (Storage::disk('s3')->exists($file)) {
                if (Storage::disk('s3')->delete($file)) {
                    $this->info("Successfully deleted: $file");
                } else {
                    $this->error("Failed to delete: $file");
                }
            } else {
                $this->error("File does not exist: $file");
            }
        }

        return 0;
    }
}
