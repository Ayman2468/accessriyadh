<?php

namespace App\Exports;

use App\Models\ApplicationRequest;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ApplicationExport implements FromView
{
    private $applicationId;

    public function __construct($applicationId)
    {
        $this->applicationId = $applicationId;
    }

    public function view(): View
    {
        $application = ApplicationRequest::find($this->applicationId);
        return view('exports.application', [
            'application' => $application
        ]);
    }
}
