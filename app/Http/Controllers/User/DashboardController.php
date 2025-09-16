<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FileType;
use App\Models\File;
use App\Models\FileJob;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DashboardController extends Controller
{


    public function index()
    {
        // dd('hi');
        $month = date('m');
        $uid = Auth::user()->id;
        $pendingCount =  $inProgressCount = $CompletedCount = $errorCount = $uploadedCount = 0;
        $uploadedCount = FileJob::where('user_id', $uid)->count('id');
        $pendingCount = FileJob::where('user_id', $uid)->where('status', '=', '1')->count('id');
        $inProgressCount = FileJob::where('user_id', $uid)->where('status', '=', '2')->count('id');
        $CompletedCount = FileJob::where('user_id', $uid)->where('status', '=', '5')->count('id');
        // dd($pendingCount,  $inProgressCount, $CompletedCount);
        $jobs = FileJob::where('user_id', $uid)->orderBy('created_at', 'desc')->get();
        // dd($jobs);
        $jobsArr = array();
        foreach ($jobs as $jobkey => $jobvalue) {
            $filesArr = array();
            $files = File::where('study_id', $jobvalue['study_id'])
                ->where('active', '=', '1')
                ->where('is_deleted', '=', '0')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach ($files as $filekey => $filevalue) {
                $filesArr[$filekey]['study_name'] = $filevalue['study_name'];
                $filesArr[$filekey]['file_name'] = $filevalue['file_name'];
            }
            $jobsArr[$jobkey]['study_name'] = isset($files[0]['study_name']) ? $files[0]['study_name'] : '';
            $jobsArr[$jobkey]['study_id'] = $jobvalue['study_id'];
            $jobsArr[$jobkey]['status'] = $jobvalue['status'];
            $jobsArr[$jobkey]['upload_date'] = $jobvalue['created_at'];
            $jobsArr[$jobkey]['end_time'] = isset($jobvalue['end_time']) ? $jobvalue['end_time'] : "";
            $jobsArr[$jobkey]['studyDet'] = $filesArr;
        }
        // dd($jobsArr);
        return view('user.dashboard', compact('jobsArr',  'uploadedCount', 'pendingCount', 'inProgressCount', 'CompletedCount', 'errorCount'));
    }
}
