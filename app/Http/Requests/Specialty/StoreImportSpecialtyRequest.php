<?php

namespace App\Http\Requests\Specialty;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportSpecialtyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'excel_file' => 'required|mimes:xlsx,xls',
        ];
    }

    public function attributes()
    {
        return [
            'excel_file' => 'documento'
        ];
    }
}
