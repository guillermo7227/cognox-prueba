<?php

namespace App\Http\Requests;

use App\Models\Account;
use Illuminate\Foundation\Http\FormRequest;

class StoreTransferenceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $originAccount = Account::find($this->get('origin_account_id'));
        return $originAccount->user_id == auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'origin_account_id' => [
                'required', 
                'exists:accounts,id', 
                function ($attribute, $value, $fail) {
                    $account = Account::find($value);
                    if ($account->balance < $this->get('amount')) {
                        $fail('La cuenta origen :attribute no tiene saldo suficiente para realizar esta transacción');
                    }
                },
                function ($attribute, $value, $fail) {
                    $account = Account::find($value);
                    if (!$account->active) {
                        $fail('La cuenta origen seleccionada no está habilitada');
                    }
                },
                function ($attribute, $value, $fail) {
                    $account = Account::find($value);
                    if (!$account->transferable) {
                        $fail('La cuenta origen seleccionada no está matriculada para transferencias');
                    }
                },
            ],
            'destination_account_id' => [
                'required',
                'exists:accounts,id',
                'different:origin_account_id', 
                function ($attribute, $value, $fail) {
                    $account = Account::find($value);
                    if (!$account->active) {
                        $fail('La cuenta destino seleccionada no está habilitada');
                    }
                },
                function ($attribute, $value, $fail) {
                    $account = Account::find($value);
                    if (!$account->transferable) {
                        $fail('La cuenta destino seleccionada no está matriculada para transferencias');
                    }
                },
            ],
            'amount' => 'required|numeric|min:1|max:999999999999',
        ];
    }
}
