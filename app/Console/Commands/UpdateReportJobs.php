<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\FileJob;
use App\Models\FileToReport;
use Illuminate\Support\Facades\Log;

class UpdateReportJobs extends Command
{
    protected $signature = 'filejobs:updateReport';
    protected $description = 'Insert report data from text files into FileToReport table';

    public function handle()
    {
        Log::info('UpdateReportJobs handle() started.');
        $checkReportRequired = FileJob::where('status', '=', '5')
            ->where('report_done', '=', '0')
            ->select('study_id', 'folder_name', 'user_id')
            ->get()
            ->toArray();

        if (count($checkReportRequired) === 0) {
            $this->info('No update report jobs found.');
            return;
        }

        // $baseReportPath = storage_path('app/public/' . config('custom.patho_report_base_location'));
        $baseReportPath = trim(config('custom.patho_report_base_location'), '/\\');
        Log::info('Base report path: ' . $baseReportPath);
        // Map marker names to FileToReport columns
        $columnMap = [
            'HER2'   => 'her2',
            'KI-67'  => 'ki67',
            'ER'     => 'er',
            'PGR'    => 'pgr',
            // add more if needed
        ];

        foreach ($checkReportRequired as $val) {
            if (PHP_OS_FAMILY === 'Windows') {
                // Local Windows environment - fixed D:\vijayProjects path
                $reportPath = $baseReportPath . '\\' . $val['user_id'] . '\\' . $val['folder_name'] . '\\report.txt';
            } else {
                // Server Linux environment - fixed /home/ubuntu/myfolder path
                $reportPath =  '/'. $baseReportPath . '/' . $val['user_id'] . '/' . $val['folder_name'] . '/report.txt';
            }
            Log::info('Checking report file at: [' . $reportPath .']');

            if (!file_exists($reportPath)) {
                Log::warning('Report file does not exist: ' . $reportPath);
                continue;
            }

            $content = file_get_contents($reportPath);
            Log::info('Report file content: ' . $content);

            // Create new report row
            $reportModel = new FileToReport();
            $reportModel->study_id = $val['study_id'];

            foreach ($columnMap as $marker => $column) {
                $pattern = '/-+ ' . preg_quote($marker, '/') . ' -+(.*?)((?=-+ [A-Z0-9\-]+ -+)|\z)/s';
                preg_match($pattern, $content, $matches);
                $reportText = trim($matches[1] ?? '');

                if (!empty($reportText)) {
                    $reportModel->$column = $reportText;
                }
            }

            $reportModel->save();

            // Mark FileJob as report_done
            FileJob::where('study_id', $val['study_id'])->update(['report_done' => '1']);
        }

        $this->info('Inserted ' . count($checkReportRequired) . ' new report(s) into FileToReport.');
    }
}
