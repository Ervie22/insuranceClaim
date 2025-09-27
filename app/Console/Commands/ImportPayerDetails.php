<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PayerDetail;
use League\Csv\Reader;
use Carbon\Carbon;
use Auth;

class ImportPayerDetails extends Command
{
    protected $signature = 'import:payer-details {file=storage/app/new_payer_details.csv}';
    protected $description = 'Import payer details from CSV';

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
            PayerDetail::create([
                'payer_name'     => $record['Payer Name'] ?? null,
                'plan_type'      => $record['Plan Type'] ?? null,
                'plan_name'      => $record['Plan Name'] ?? null,
                'address'        => $record['Address'] ?? null,
                'phone'          => $record['Phone'] ?? null,
                'edi_payer_id'   => $record['EDI Payer ID'] ?? null,
                'effective_date' => (!empty($record['Effective Date']) && $this->isValidDate($record['Effective Date']))
                    ? Carbon::createFromFormat('d-m-Y', $record['Effective Date'])->format('Y-m-d')
                    : null,

                'renewal_date' => (!empty($record['Renewal Date']) && $this->isValidDate($record['Renewal Date']))
                    ? Carbon::createFromFormat('d-m-Y', $record['Renewal Date'])->format('Y-m-d')
                    : null,
                'created_by'     => 1, // Or Auth::id() if logged in
                'status'         => '1',
                'is_deleted'     => '0',
            ]);
        }

        $this->info('Payer details imported successfully!');
    }
    private function isValidDate($date, $format = 'd-m-Y')
    {
        $d = Carbon::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
