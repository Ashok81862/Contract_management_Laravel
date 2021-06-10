<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;


class UserExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function headings(): array
    {
        return [
            'Name',
            'Email'
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $all_users = User::all();

        $users = $all_users->map(function ($user) {
            return [
                $user->name,
                $user->email
            ];
        });

        return $users;
    }
}
