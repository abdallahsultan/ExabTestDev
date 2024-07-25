<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\RepositoriesExport;

class RepositoriesExportMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $repositories;
    public function __construct($repositories)
    {
        $this->repositories = $repositories;
    }

    public function build()
    {
        $fileName = 'repositories_export.xlsx';

        return $this->markdown('emails.repositories.export')
                    ->subject('Repositories Export')
                    ->attachData(
                        Excel::raw(new RepositoriesExport($this->repositories), \Maatwebsite\Excel\Excel::XLSX), 
                        $fileName, [
                            'mime' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                        ]
                    )
                    ->with('fileName', $fileName);
    }
}
