<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    protected $status;

    public function __construct($status = null)
    {
        $this->status = $status;
    }

    public function collection()
    {
        $query = User::query()->whereNull('deleted_at');

        if ($this->status) {
            $query->where('status', $this->status);
        }

        return $query->select('id', 'name', 'email', 'phone_number', 'status')->get();
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Email', 'Phone Number', 'Status'];
    }
}
