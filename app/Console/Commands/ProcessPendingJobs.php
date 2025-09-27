<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FileJob; // Your model
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ProcessPendingJobs extends Command
{
    protected $signature = 'filejobs:process';
    protected $description = 'Process pending file jobs and mark them Inprocess';

    public function handle()
    {
        //-- TODO  for vijay
        //-- 1. Change pickup query to use updated_at instead of created_at
        //-- 2. Check if record exists in file_jobs_region table for this job id
        //-- 3. If exists, then fetch the value in the region column and pass it to the payload
        //-- 4. If not exists, then pass 'None' to the region column in the payload




        $pendingJobs = FileJob::where('status', '1')->orderBy('created_at', 'asc')->get();



        if ($pendingJobs->isNotEmpty()) {
            $job = $pendingJobs->first();

            $m_region = 'None';
            // $fileJobRegion = \App\Models\FileJobRegion::where('file_jobs_id', $job->id)->first();

            // //-- get the region value if exists
            // if ($fileJobRegion && !empty($fileJobRegion->region)) {
            //     $m_region = $fileJobRegion->region;
            // }

            //-- Check if the job is already registered
            $m_job_registered = 'False';
            if ($job->already_registered == 1) {
                $m_job_registered = 'True';
            }

            $job->status = '2';
            $job->start_time = date('Y-m-d H:i:s');
            $job->updated_at = Carbon::now();
            $job->save();
            $payload = [
                'job_id'          => $job->id,
                'study_name'          => $job->folder_name,
                'folder_name'         => $job->study_name,
                'study_id'            => $job->study_id,
                'user_id'             => $job->user_id,
                'return_size'         => '1/4',
                'input_magnification' => 20,
                'mark_region'         => 'True',
                'mark_cells'          => 'False',
                'region_mask'         => 'None',
                'fg_thresh_init'      => $job->fg_threshold,
                'already_registered'  => $m_job_registered,
                'alpha'               => '0.5',
                'dab_percentile'      => '99',
                'blur_std'            => '1',
                'region'              => $m_region
            ];

            try {
                $url = config('services.stain_handler.url');
                Log::info('Running via scheduler for processing at ' . now());
                Log::info('ENV STAIN_HANDLER_URL: [' . $url . ']');
                $response = Http::timeout(5400)->connectTimeout(5400)->post($url, $payload);
                if ($response->successful()) {
                    Log::info('Running filejobs:process at ' . now());
                    $job->status = '3';
                    //$job->already_registered = 1;
                    $job->updated_at = Carbon::now();
                    $job->save();
                } else {
                    Log::warning('Failed to process job ID: ' . $job->study_name . ' - Response: ' . $response->body());
                    $this->info('Failed response: ' . $response->body());
                    $job->status = '6';
                    $job->updated_at = Carbon::now();
                    $job->save();
                }
            } catch (\Exception $e) {
                Log::error('Error while sending job ID ' . $job->study_name . ': ' . $e->getMessage());
                $job->status = '6';
                $job->end_time = date('Y-m-d H:i:s');
                $job->updated_at = Carbon::now();
                $job->save();
            }
        } else {
            Log::info('No pending jobs to process at ' . now());
            $this->info('No pending jobs found.');
        }


        $this->info('Processed ' . $pendingJobs->count() . ' pending job(s).');
    }
}
