<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Required for queue dispatch
use Illuminate\Foundation\Bus\Dispatchable; // Required for dispatch()
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use App\Models\File;
use App\Models\FileJob;

class ProcessUploadedFolderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public array $data) {}

    public function handle()
    {
        $uploadId = $this->data['uploadId'];
        $fileName = $this->data['fileName'];
        $folderPath = $this->data['final_folder_path'];
        $studyId = $this->data['study_id'];
        $studyName = $this->data['study_name'];
        $userId = $this->data['user_id'];
        $type = $this->data['type'];

        $availableTypes = ['H&E', 'HER2', 'Ki-67', 'ER', 'PGR'];
        $fileType = array_search($type, $availableTypes) + 1;

        $tempDir = storage_path("app/chunks/{$uploadId}");
        $tempUploadsDir = storage_path("app/public/patho/temp_uploads");

        if (!file_exists($tempUploadsDir)) {
            mkdir($tempUploadsDir, 0755, true);
        }

        $assembledPath = $tempUploadsDir . '/' . $fileName;
        $output = fopen($assembledPath, 'wb');

        for ($i = 0; $i < 10000; $i++) {
            $chunkPath = "{$tempDir}/chunk_{$i}";
            if (!file_exists($chunkPath)) break;

            $input = fopen($chunkPath, 'rb');
            stream_copy_to_stream($input, $output);
            fclose($input);
            unlink($chunkPath);
        }

        fclose($output);
        @rmdir($tempDir);

        // Move to final destination
        $relativeTempPath = "patho/temp_uploads/{$fileName}";
        $relativeFinalPath = $folderPath . '/' . $fileName;

        if (!Storage::disk('public')->exists($folderPath)) {
            Storage::disk('public')->makeDirectory($folderPath);
        }

        if (Storage::disk('public')->exists($relativeTempPath)) {
            Storage::disk('public')->move($relativeTempPath, $relativeFinalPath);
        }

        // Save file to DB
        $saveFile = new File;
        $saveFile->study_name = $studyName;
        $saveFile->study_description = "N/A";
        $saveFile->study_id = $studyId;
        $saveFile->upload_date = now();
        $saveFile->file_name = $fileName;
        $saveFile->file_type_id = $fileType;
        $saveFile->file_path = $relativeFinalPath;
        $saveFile->user_id = $userId;
        $saveFile->status = "2";
        $saveFile->active = "1";
        $saveFile->is_deleted = "0";
        $saveFile->save();
    }
}
