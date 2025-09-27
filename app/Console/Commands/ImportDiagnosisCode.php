<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DiagnosisCode;
use League\Csv\Reader;
use Carbon\Carbon;
use Auth;

class ImportDiagnosisCode extends Command
{
    protected $signature = 'import:diagnosis-code {file=storage/app/new_diagnosis_code.csv}';
    protected $description = 'Import diagnosis code from CSV';

    public function handle()
    {
        $filePath = base_path($this->argument('file'));

        if (!file_exists($filePath)) {
            $this->error("File not found: $filePath");
            return;
        }

        $csv = Reader::createFromPath($filePath, 'r');
        $csv->setHeaderOffset(0); // First row as header

        foreach ($csv as $record) {
            DiagnosisCode::create([
                'ICD10Code'     => $record['ICD10Code'] ?? null,
                'description'      => $record['Description'] ?? null,
                'category'      => $record['Category'] ?? null,
                'created_by'     => 1, // Or Auth::id() if logged in
                'status'         => '1',
                'is_deleted'     => '0',
            ]);
        }

        $this->info('diagnosis code imported successfully!');
    }
}
