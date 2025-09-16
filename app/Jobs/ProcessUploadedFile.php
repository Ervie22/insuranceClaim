<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Required for queue dispatch
use Illuminate\Foundation\Bus\Dispatchable; // Required for dispatch()
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\File;

class ProcessUploadedFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $meta;

    public function __construct($meta)
    {
        $this->meta = $meta;
    }

    public function handle()
    {

        $tempPath = $this->meta['temp_path'];
        $finalPath = $this->meta['path2'] . '/' . $this->meta['filename'];

        // Make sure directory exists
        Storage::disk('public')->makeDirectory($this->meta['path2']);

        // Move from temp to final
        Storage::disk('public')->move($tempPath, $finalPath);

        // Save to DB
        $saveFile = new File;
        $saveFile->study_name = $this->meta['study_name'];
        $saveFile->study_description = "N/A";
        $saveFile->study_id = $this->meta['study_id'];
        $saveFile->upload_date = now()->format('Y-m-d');
        $saveFile->file_name = $this->meta['filename'];
        $saveFile->file_type_id = $this->meta['file_type'];
        $saveFile->file_path = $finalPath;
        $saveFile->user_id = $this->meta['auth_id'];
        $saveFile->active = "1";
        $saveFile->is_deleted = "0";
        $saveFile->save();
    }
}
