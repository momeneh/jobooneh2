<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class NewsletterExport implements FromCollection,WithHeadings
{
    public function __construct($newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return $this->newsletter;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
           __('title.id'),
            __('title.email'),
            __('title.lang'),
            __('title.sent_at'),
            __('title.signed_at'),
        ];
    }


}
