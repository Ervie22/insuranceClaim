<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CptCode;
use League\Csv\Reader;
use Carbon\Carbon;
use Auth;

class ImportCptCode extends Command
{
    protected $signature = 'import:cpt-code {file=storage/app/new_cpt_code.csv}';
    protected $description = 'Import cpt code from CSV';

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
            CptCode::create([
                'cpt'     => $record['CPT'] ?? null,
                'description'      => $record['Description'] ?? null,
                'Medicare_OH_Fee_DEMO'      => $record['Medicare_OH_Fee_DEMO'] ?? null,
                'Medicaid_OH_Fee_DEMO'        => $record['Medicaid_OH_Fee_DEMO'] ?? null,
                'Triple_Medicare_Fee_DEMO'          => $record['Triple_Medicare_Fee_DEMO'] ?? null,
                'created_by'     => 1, // Or Auth::id() if logged in
                'status'         => '1',
                'is_deleted'     => '0',
            ]);
        }

        $this->info('cpt code imported successfully!');
    }
}
