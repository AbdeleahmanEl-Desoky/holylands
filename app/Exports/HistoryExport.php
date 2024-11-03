<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class HistoryExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($data)
    {
        // Ensure data is always a Collection, even if null or empty
        $this->data = collect($data);
    }

    public function collection()
    {
        // Check if data exists and is a collection, otherwise return empty collection
        return $this->data->map(function ($history) {
            return [
                'Level' => $history->level->name ?? 'N/A',
                'Number of Hours' => $history->number_hours,
                'User Count' => $history->users->count(),
                'Date' => $history->created_at->format('Y-m-d H:i:s'),
            ];
        });
    }

    public function headings(): array
    {
        return ['Level', 'Number of Hours', 'User Count', 'Date'];
    }
}
