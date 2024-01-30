<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InvitationImport implements ToCollection, WithHeadingRow
{
    use Importable;

    private $emails;

    public function __construct()
    {
        $this->emails = collect();
    }

    public function collection(Collection $collection): void
    {
        foreach ($collection as $row) {
            $this->emails->push(
                [
                    'name'    => $row['name'],
                    'email'   => $row['email'],
                    'country' => $row['country'] ?? null,
                    'phone'   => $row['phone'] ?? null,
                ]
            );
        }
    }

    public function getEmails(): Collection
    {
        return $this->emails;
    }
}
