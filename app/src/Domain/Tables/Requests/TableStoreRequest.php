<?php

namespace App\src\Domain\Tables\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TableStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'file' => 'required|uuid',
//            'description'
        ];
    }
}
