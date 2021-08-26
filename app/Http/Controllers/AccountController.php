<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        $accounts = Account::own()
                            ->orderBy('name')
                            ->get();
        return view('accounts.index', compact('accounts'));
    }
}
