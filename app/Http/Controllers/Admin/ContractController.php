<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Contract;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ContractExport;
use App\Http\Controllers\Controller;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contracts = Contract::with(['user'])->paginate(10);

        return view('admin.contracts.index', compact('contracts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::where('role', '!=', 'Admin')->select(['id', 'name'])->get();

        return view('admin.contracts.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'   =>  ['nullable', 'exists:users,id'],
            'contract_date' => ['nullable','string'],
            'subject' =>   ['nullable', 'string','max:100'],
            'full_text' => ['nullable'],
            'is_signed' =>  ['nullable', 'boolean'],

        ]);

        Contract::create([
            'user_id'   =>  $request->user_id,
            'contract_date' =>  $request->contract_date,
            'subject'   =>  $request->subject,
            'full_text' =>  $request->full_text,
            'is_signed' => $request->is_signed ? true : false,
        ]);

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Contract has been created successfully!!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contract $contract)
    {
        return view('admin.contracts.show', compact('contract'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contract $contract)
    {
        $users = User::where('role', '!=', 'Admin')->select(['id', 'name'])->get();

        return view('admin.contracts.edit', compact('users','contract'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'user_id'   =>  ['nullable', 'exists:users,id'],
            'contract_date' => ['nullable','string'],
            'subject' =>   ['nullable', 'string','max:100'],
            'full_text' => ['nullable'],
            'is_signed' =>  ['nullable', 'boolean'],

        ]);

        $contract->update([
            'user_id'   =>  $request->user_id,
            'contract_date' =>  $request->contract_date,
            'subject'   =>  $request->subject,
            'full_text' =>  $request->full_text,
            'is_signed' => $request->is_signed ? true : false,
        ]);

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Contract has been updated successfully!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contract $contract)
    {
        $contract->delete();

        return redirect()->route('admin.contracts.index')
            ->with('success', 'Contract has been deleted successfully!!');
    }

    public function export(Excel $excel, ContractExport $export)
    {
        return $excel->download($export, 'contracts.xlsx');
    }
}
