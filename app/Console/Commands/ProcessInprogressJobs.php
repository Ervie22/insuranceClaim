<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FileJob; // Your model
use App\Models\File; // Your model
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Mail\StudyProcessedMail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ProcessInprogressJobs extends Command
{
    protected $signature = 'filejobs:tiling';
    protected $description = 'Process processed file jobs and mark them Tiling';

    public function handle()
    {
        //-- Check if any records in db for this table "file_job" where status is 2 (which is inprogress)
        //-- If yes, then do not do anything - lets wait for the image processing to complete
        //-- If no, then proceed with the tiling process
        //-- We may want to do a select count(*) from file_job where status = 2 here 

        $inProgressCount = FileJob::where('status', '2')->count();

        if ($inProgressCount > 0) {
            Log::info('Image processing is still in progress. Skipping tiling process.');
            return;
        }

        $pendingJobs = FileJob::where('status', '3')->orderBy('created_at', 'asc')->get();

        if ($pendingJobs->isEmpty()) {
            $this->info('No pending tiling jobs found.');
            return;
        }

        $job = $pendingJobs->first();
        $job->status = '4';
        $job->updated_at = Carbon::now();
        $job->save();

        $payload = [
            'study_name'          => $job->study_name,
            'folder_name'         => $job->folder_name,
            'study_id'            => $job->study_id,
            'user_id'    => $job->user_id,
        ];
        $url = config('services.tile_handler.url');
        Log::info('Running via scheduler for progress tiling at ' . now());
        Log::info('ENV PATH_CREATE_TILES: ' . $url);

        try {
            $response = Http::timeout(3600)->connectTimeout(3600)->post($url, $payload);
            if ($response->successful()) {
                Log::info('Running filejobs:tiling at ' . now());
                $job->status = '5'; // Completed
                $job->end_time = date('Y-m-d H:i:s');
                $job->updated_at = Carbon::now();
                $job->save();
                $userId = $job['user_id'];
                $folderName = $job['folder_name'];
                $getFIles = File::where('study_id', $job['study_id'])->get();
                foreach ($getFIles as  $key => $val) {
                    $fileName = $val['file_name'];
                    $nameWithoutExtension = pathinfo($fileName, PATHINFO_FILENAME); // returns "image"
                    //$str = "http://localhost/" . $userId . "/" . $folderName . "/" . $nameWithoutExtension . "/{z}/{x}/{y}.png";

                    $str = "http://3.128.20.153/" . $userId . "/" . $folderName . "/" . $nameWithoutExtension . "/{z}/{x}/{y}.png";
                    $updateFile = File::where('id', $val['id'])->first();
                    $updateFile->result_url = $str;
                    $updateFile->save();
                }
                //$getUser = FileJob::find($userId);
                //$toEmail = $getUser['email']; // replace with dynamic email
                //$firstName = $getUser['first_name']; // replace with actual user name
                //$studyName = $job['study_name']; // replace with actual study name

                //Mail::to($toEmail)->send(new StudyProcessedMail($firstName, $studyName));
            } else {
                Log::error('Exception occurred while processing tiling job', [
                    'job_id' => $job->id ?? null,
                    'study_id' => $job->study_id ?? null,
                    'user_id' => $job->user_id ?? null,
                    'folder_name' => $job->folder_name ?? null,
                    'exception_message' => 'Did not receive a successful response from the tile handler.',
                    'exception_trace' => 'No exception trace available as this is a response error.',
                ]);
                $job->status = '6';
                $job->end_time = date('Y-m-d H:i:s');
                $job->updated_at = Carbon::now();
                $job->save();
            }
        } catch (\Exception $e) {
            Log::error('Exception occurred while processing tiling job', [
                'job_id' => $job->id ?? null,
                'study_id' => $job->study_id ?? null,
                'user_id' => $job->user_id ?? null,
                'folder_name' => $job->folder_name ?? null,
                'exception_message' => $e->getMessage(),
                'exception_trace' => $e->getTraceAsString(),
            ]);
            $job->status = '6';
            $job->end_time = date('Y-m-d H:i:s');
            $job->updated_at = Carbon::now();
            $job->save();
        }

        /*
        foreach ($pendingJobs as $job) {
            // Construct payload
            $job->status = '4';
            $job->updated_at = Carbon::now();
            $job->save();
            $payload = [
                'study_name'          => $job->study_id,  // Make sure your FileJob model has this column
                'user_id'             => $job->user_id,
            ];
            $url = config('services.tile_handler.url');
            Log::info('Running via scheduler for progress tiling at ' . now());
            Log::info('ENV PATH_CREATE_TILES: ' . $url);
            try {
                // $url = env('PATH_CREATE_TILES', 'http://localhost:8000/create-tiles'); // Only from .env

                // $response = Http::post($url, $payload);
                $response = Http::timeout(600)->connectTimeout(600)->post($url, $payload);
                if ($response->successful()) {
                    Log::info('Running filejobs:tiling at ' . now());
                    $job->status = '5'; // Completed
                    $job->updated_at = Carbon::now();
                    $job->save();
                } else {
                    $job->status = '6';
                    $job->updated_at = Carbon::now();
                    $job->save();
                    // Log::error('Error while sending job ID ' . $job->id . ': ' . $e->getMessage());
                }
            }
        }
        */


        $this->info('Processed ' . $pendingJobs->count() . ' Tiling job(s).');
    }
}
