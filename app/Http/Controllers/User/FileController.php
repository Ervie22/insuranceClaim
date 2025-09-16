<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileType;
use App\Models\File;
use App\Models\FileJob;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
// use App\Jobs\ProcessUploadedFile;
use App\Jobs\ProcessUploadedFolderJob;
use App\Models\FileJobRegion;
use App\Models\FileToReport;
use App\Models\FileToRegion;
use DateTime;



use Illuminate\Support\Facades\DB;

class FileController extends Controller
{
    public function uploadFiles()
    {
        $fileTypes = FileType::get();
        $isEnabled = Auth::user()->enabled;
        // dd($isEnabled);
        return view('user.files.upload-file', compact('fileTypes', 'isEnabled'));
    }
    public function viewHistory()
    {
        $history = array();
        $uid = Auth::user()->id;
        $getHistory = FileJob::where('user_id', '=', $uid)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->toArray();
        foreach ($getHistory as $key => $val) {
            $file = File::where('study_id', $val['study_id'])->where('active', '=', '1')->where('is_deleted', '=', '0')->first();
            $history[$key]['study_id'] = $val['study_id'];
            $history[$key]['study_name'] = isset($file['study_name']) ? $file['study_name'] : '';
            $history[$key]['status'] = $val['status'];
            $history[$key]['upload_date'] = isset($file['created_at']) ? $file['created_at'] : '';
            $history[$key]['end_time'] = isset($val['end_time']) ? $val['end_time'] : 'N/A';
        }


        return view('user.files.view-history', compact('history'));
    }
    public function viewResults()
    {
        return view('user.files.view-results');
    }
    public function viewSlide($id)
    {
        $getFile = File::where('id', $id)->first();
        // dd($getFile);
        // Store result_url in session
        session(['tile_base_url' => $getFile->result_url]);
        return view('user.files.view-slide', compact('getFile'));
    }

    public function getFileStatus($studyId)
    {
        $pendingCount = File::where('study_id', $studyId)->where('status', '1')->count('id');
        $uploadedCount = File::where('study_id', $studyId)->count('id');
        $files['pendingCount'] = $pendingCount;
        $files['uploadedCount'] = $uploadedCount;
        return $files;
    }
    public function reAnalyze(Request $request)
    {
        $input = $request->all();
        $jobId = $input['jobId'];
        $updateJob = FileJob::find($jobId);
        $currentTime = date('Y-m-d H:i');
        $overAllEtaMinutes = FileJob::whereIn('status', ['0', '1', '2'])->sum('eta_in_minutes');
        $overAllEtaMinutes = $overAllEtaMinutes + 30;
        $datetime = new DateTime($currentTime);
        $datetime->modify("+{$overAllEtaMinutes} minutes");

        $expectedTimeToComplete = $datetime->format('Y-m-d H:i');
        $checkFileJobRegion = FileJobRegion::where('file_jobs_id', $jobId)->first();
        if (!isset($checkFileJobRegion)) {
            return 2;
        }
        if ($updateJob) {

            $updateJob->status = "1";
            $updateJob->find_tumor = 0;
            $updateJob->trigger_analysis  = 1;
            $updateJob->eta_in_minutes = 30;
            $updateJob->report_done = "0";
            //$updateJob->etc = $expectedTimeToComplete;
            $updateJob->save();
            return 1;
        }
    }
    public function findTumor(Request $request)
    {
        $input = $request->all();
        $jobId = $input['jobId'];
        $updateJob = FileJob::find($jobId);
        $currentTime = date('Y-m-d H:i');
        $overAllEtaMinutes = FileJob::whereIn('status', ['0', '1', '2'])->sum('eta_in_minutes');
        $overAllEtaMinutes = $overAllEtaMinutes + 30;
        $datetime = new DateTime($currentTime);
        $datetime->modify("+{$overAllEtaMinutes} minutes");

        $expectedTimeToComplete = $datetime->format('Y-m-d H:i');

        if ($updateJob) {
            $threshold = floatval($updateJob->fg_threshold);

            if ($threshold != 0.1) {
                $newThreshold = $threshold - 0.1;
            } else {
                $newThreshold = 0.7;
            }
            $updateJob->status = "1";
            $updateJob->fg_threshold = $newThreshold;
            $updateJob->eta_in_minutes = 30;
            //$updateJob->etc = $expectedTimeToComplete;
            $updateJob->save();
            return 1;
        }
    }
    public function updateJobStatus(Request $request)
    {
        $user_id = Auth::user()->id;
        $input = $request->all();
        $studyId = $input['studyName'] . '_' . $input['folderTimestamp'];
        $currentTime = date('Y-m-d H:i');
        $overAllEtaMinutes = FileJob::whereIn('status', ['0', '1', '2'])->sum('eta_in_minutes');

        $datetime = new DateTime($currentTime);
        $datetime->modify("+{$overAllEtaMinutes} minutes");

        $expectedTimeToComplete = $datetime->format('Y-m-d H:i');
        $updateJob = FileJob::where('user_id', $user_id)->where('study_id', $studyId)->first();
        // dd($studyId, $updateJob);
        $updateJob->status = "1";
        $updateJob->fg_threshold = "0.7";
        $updateJob->eta_in_minutes = 90;
        $updateJob->save();
        return 1;
    }
    // public function prepareUploadFolder(Request $request)
    // {
    //     $studyName = Str::slug($request->input('study_name')); // sanitized folder name
    //     $user_id = Auth::user()->id;

    //     $folderTimestamp = $request->input('folderTimestamp');
    //     // dd($studyName);
    //     // Define base and folder paths
    //     $baseFolder = config('custom.patho_upload_path') . $user_id . '/';
    //     // dd($baseFolder);
    //     $baseStudyFolder = $baseFolder . $studyName;
    //     $folder = $baseStudyFolder;
    //     $folder_name = $studyName; // Default folder name
    //     // dd($folder);
    //     // Ensure user directory exists first
    //     if (!Storage::disk('public')->exists($folder)) {
    //         Storage::disk('public')->makeDirectory($folder); // Create /uploads/{user_id}/
    //     }

    //     $i = 1;

    //     // Check for folder and DB name collision
    //     while (Storage::disk('public')->exists($folder)) {


    //         // Optional DB check to ensure name isn't already recorded
    //         $check = FileJob::where('user_id', $user_id)
    //             ->where('folder_name', $studyName)
    //             ->first('folder_name');
    //         // dd($user_id, $studyName, $check);
    //         if (isset($check['folder_name'])) {
    //             $newfolder = $baseStudyFolder . '-' . $i;
    //             $newfolder_name = $studyName . '-' . $i;
    //             $i++;
    //         }
    //     }
    //     // dd('check2');
    //     // Finally, create the unique folder
    //     Storage::disk('public')->makeDirectory($newfolder);
    //     // dd('check3');
    //     return response()->json([
    //         'folder_path' => $newfolder,
    //         'folder_name' => $newfolder_name
    //     ]);
    // }
    public function prepareUploadFolder(Request $request)
    {
        $studyName = Str::slug($request->input('study_name')); // sanitized folder name
        $user_id = Auth::user()->id;

        $baseFolder = config('custom.patho_upload_path') . $user_id . '/';
        $folder_name = $studyName;
        $folder = $baseFolder . $folder_name;

        $i = 1;
        while (true) {
            // Check if folder already exists
            if (!Storage::disk('public')->exists($folder)) {
                // Also check DB
                $check = FileJob::where('user_id', $user_id)
                    ->where('folder_name', $folder_name)
                    ->first();

                if (!$check) {
                    break; // ✅ Found available name
                }
            }

            // Increment and try a new name
            $folder_name = $studyName . '-' . $i;
            $folder = $baseFolder . $folder_name;
            $i++;
        }

        // Create final folder
        Storage::disk('public')->makeDirectory($folder);

        return response()->json([
            'folder_path' => $folder,
            'folder_name' => $folder_name
        ]);
    }

    public function processStainHandler(Request $request)
    {
        // dd($request->all());
        if ($request->has('study_name')) {
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed'
            ], 500);
        }
    }
    public function createTiles(Request $request)
    {
        // dd($request->all());
        if ($request->has('study_name')) {
            return response()->json([
                'status' => 'success'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed'
            ], 500);
        }
    }
    public function chunkUpload(Request $request)
    {
        // dd('hi');
        $uploadId = $request->input('upload_id');
        $index = $request->input('index');
        $totalChunks = $request->input('total_chunks');
        $fileName = $request->input('file_name');
        $folderName = $request->input('folder_name');
        $chunk = $request->file('chunk');
        $folderTimestamp = $request->input('upload_folder_id');
        $final_folder_path = $request->input('final_folder_path');
        $type = $request->input('type');

        $availableTypes = ['H&E', 'HER2', 'Ki-67', 'ER', 'PGR'];
        $fileType = array_search($type, $availableTypes) + 1;

        $user_id = Auth::user()->id;
        $studyName = $request->input('study_name');
        $study_id = $studyName . "_{$folderTimestamp}";
        $studyNameSlug = Str::slug($studyName);
        $this->saveJob($user_id, $study_id, $studyName, $folderName);
        $tempDir = storage_path("app/chunks/{$uploadId}");
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0755, true);
        }
        $chunk->move($tempDir, "chunk_{$index}");
        // dd($chunk);
        if (count(glob($tempDir . '/chunk_*')) == $totalChunks) {
            // Ensure temp_uploads dir exists
            $tempUploadsDir = storage_path("app/public/patho/temp_uploads");
            // dd($tempUploadsDir);
            if (!file_exists($tempUploadsDir)) {
                mkdir($tempUploadsDir, 0755, true);
            }

            $assembledPath = $tempUploadsDir . '/' . $fileName;
            $output = fopen($assembledPath, 'wb');

            for ($i = 0; $i < $totalChunks; $i++) {
                $chunkPath = "{$tempDir}/chunk_{$i}";
                if (!file_exists($chunkPath)) continue;

                $input = fopen($chunkPath, 'rb');
                stream_copy_to_stream($input, $output);
                fclose($input);
                unlink($chunkPath);
            }

            fclose($output);
            rmdir($tempDir);

            // Prepare paths for moving to final folder
            $relativeTempPath = "patho/temp_uploads/{$fileName}";
            $relativeFinalPath = $final_folder_path . '/' . $fileName;

            // Ensure destination folder exists
            if (!Storage::disk('public')->exists($final_folder_path)) {
                Storage::disk('public')->makeDirectory($final_folder_path);
            }

            // Move from temp_uploads to final destination
            if (Storage::disk('public')->exists($relativeTempPath)) {
                Storage::disk('public')->move($relativeTempPath, $relativeFinalPath);
            } else {
                return response()->json(['error' => 'Temp file not found for moving'], 500);
            }

            $saveFile = new File;
            $saveFile->study_name = $studyName;
            $saveFile->study_description = "N/A";
            $saveFile->study_id = $study_id;
            $saveFile->upload_date = date('Y-m-d');
            $saveFile->file_name = $fileName;
            $saveFile->file_type_id = $fileType;
            $saveFile->file_path = $relativeFinalPath;
            $saveFile->user_id = $user_id;
            $saveFile->active = "1";
            $saveFile->is_deleted = "0";
            $saveFile->save();
        }
        // dd('test');


        return response()->json(['status' => 'chunk received']);
    }


    public function saveJob($authId, $studyId, $studyName, $folderName)
    {
        // dd($authId, $studyId, $studyName, $folderName);
        $check = FileJob::where('user_id', $authId)->where('study_id', $studyId)->first();
        if (!isset($check)) {
            $saveJob = new FileJob;
            $saveJob->study_name = $studyName;
            $saveJob->folder_name = $folderName;
            $saveJob->user_id = $authId;
            $saveJob->study_id = $studyId;
            $saveJob->status = "0";
            $saveJob->eta_in_minutes = 60;
            $saveJob->fg_threshold = "0.1";
            $saveJob->save();
        }
    }
    public function viewFile($study_id, $tab_id)
    {
        // dd($study_id);
        $getHEFile = File::where('study_id', $study_id)->where('file_type_id', 1)->first();
        $getHERFile = File::where('study_id', $study_id)->where('file_type_id', 2)->first();
        $getKIFile = File::where('study_id', $study_id)->where('file_type_id', 3)->first();
        $getERFile = File::where('study_id', $study_id)->where('file_type_id', 4)->first();
        $getPGRile = File::where('study_id', $study_id)->where('file_type_id', 5)->first();
        $getFile = File::where('study_id', $study_id)->where('file_type_id', $tab_id)->first();
        // dd($getHEFile);
        // $newfilePath=
        // dd($study_id);
        $reportRecords = FileToReport::where('study_id', $study_id)->get();
        $fileToRegions = FileToRegion::where('study_id', $study_id)->get();

        $jobId = FileJob::where('study_id', $study_id)->value('id');
        // dd($jobId);
        return view('user.files.view-file', compact('tab_id', 'study_id', 'getHEFile', 'getHERFile', 'getKIFile', 'getERFile', 'getPGRile', 'getFile', 'reportRecords', 'fileToRegions', 'jobId'));
    }
    public function parseReport()
    {
        // Get the relative path from config (e.g., 'patho/patho-processed/')
        $relativeReportPath = trim(config('custom.patho_report_base_location'), '/\\');
        // dd($relativeReportPath);
        // Determine base root path based on OS
        if (PHP_OS_FAMILY === 'Windows') {
            // Local Windows environment - fixed D:\vijayProjects path
            $baseReportPath = 'D:\\vijayProjects\\' . $relativeReportPath . DIRECTORY_SEPARATOR;
        } else {
            // Server Linux environment - fixed /home/ubuntu/myfolder path
            $baseReportPath = '/home/ubuntu/myfolder/' . $relativeReportPath . '/';
        }
        // dd($baseReportPath);
        $checkReportRequired = FileJob::where('status', '=', '5')->select('study_id', 'folder_name', 'user_id')->get()->toArray();
        // $baseReportPath = storage_path('app/public/' . config('custom.patho_report_base_location'));
        // Define file type mapping
        $fileTypeMap = [
            'HE'     => 1,
            'HER2'   => 2,
            'ER'     => 3,
            'KI-67'  => 4,
            'PGR'    => 5,
        ];
        // dd($baseReportPath);
        foreach ($checkReportRequired as $key => $val) {
            $reportPath = $relativeReportPath . '\\' . $val['user_id'] . '\\' . $val['folder_name'] . '\\report.txt';
            // dd($reportPath);
            if (file_exists($reportPath)) {
                $content = file_get_contents($reportPath);
                dd($content);
                foreach ($fileTypeMap as $marker => $fileTypeId) {
                    // Regex: capture content of section
                    $pattern = '/-+ ' . preg_quote($marker, '/') . ' -+(.*?)((?=-+ [A-Z0-9\-]+ -+)|\z)/s';
                    preg_match($pattern, $content, $matches);
                    $reportText = trim($matches[1] ?? '');

                    if (!empty($reportText)) {
                        $file = File::where('study_id', $val['study_id'])
                            ->where('file_type_id', $fileTypeId)
                            ->whereNull('report')
                            ->first();

                        if ($file) {
                            $file->report = $reportText;
                            $file->save();
                        }
                    }
                }
            }
        }

        return 1;
    }
}
