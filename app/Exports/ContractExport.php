<?php

namespace App\Exports;

use App\Models\Contract;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ContractExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public $contract;

    public function __construct(Contract $contract)
    {
        $this->contract = $contract;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Subject',
            'Contract Date'
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $all_contracts = Contract::all();

        $contracts = $all_contracts->map(function ($contract) {
            return [
                $contract->user->name,
                $contract->subject,
                $contract->contract_date
            ];
        });

        return $contracts;
    }
}
