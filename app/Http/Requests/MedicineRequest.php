<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */

    public function rules(): array
    {
        return [
            'name' => 'required',
            'medicine_form_type_id' => 'nullable',
            'buy_price' => 'required',
            'sell_price' => 'required',
            'exp_date' => 'required|date',
            'stock' => 'required',
            'supplier_id' => 'nullable'
        ];
    }
}
