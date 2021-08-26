<?php

namespace App\Http\Controllers;

use App\DataTables\TransferenceDataTable;
use App\Http\Requests\StoreTransferenceRequest;
use App\Models\Account;
use App\Models\Transference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class TransferenceController extends Controller
{
    public function index()
    {
        return view('transferences.index');
    }

    public function toOwnAccount()
    {
        $accounts = Account::own()
                            ->whereActive(true)
                            ->whereTransferable(true)
                            ->orderBy('name')
                            ->get();
        return view('transferences.to-own-account', compact('accounts'));
    }

    public function toExternalAccount()
    {
        $ownAccounts = Account::own()
                                ->whereActive(true)
                                ->whereTransferable(true)
                                ->get();
        $externalAccounts = Account::with('owner')
                                    ->external()
                                    ->whereActive(true)
                                    ->whereTransferable(true)
                                    ->get()
                                    ->sortBy('owner.name');
        return view('transferences.to-external-account', compact('ownAccounts', 'externalAccounts'));
    }

    public function store(StoreTransferenceRequest $request)
    {
        $originAccount = Account::find($request->get('origin_account_id'));
        $destinationAccount = Account::find($request->get('destination_account_id'));

        $originAccount->balance -= (int)$request->get('amount');
        $destinationAccount->balance += (int)$request->get('amount');
        $transference = null;
        
        DB::transaction(function () use($originAccount, $destinationAccount, &$transference, $request) {
            $originAccount->save();
            $destinationAccount->save();
            
            $transference = Transference::create([
                'origin_account_id' => $request->get('origin_account_id'),
                'destination_account_id' => $request->get('destination_account_id'),
                'amount' => $request->get('amount')
            ]);
        });
        
        return view('transferences.success', compact('transference'));
    }

    public function list()
    {
        return view('transferences.list');
    }
        
    public function getList(Request $request)
    {
        return Datatables::of(Transference::query())
                            ->editColumn('amount', function ($row) {
                                return '$ '.number_format($row->amount);
                            })
                            ->editColumn('created_at', function ($row) {
                                return $row->created_at->format('d/m/Y h:i a');
                            })
                            ->filter(function ($query) use ($request) {
                                if ($request->has('origin_account_id')) {
                                    $query->where('origin_account_id', 'like', "%{$request->get('origin_account_id')}%");
                                }
                    
                                if ($request->has('destination_account_id')) {
                                    $query->where('destination_account_id', 'like', "%{$request->get('destination_account_id')}%");
                                }
                            })
                            ->make(true);
    }
}
