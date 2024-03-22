<?php

namespace App\src\Domain\Files\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class FileStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'file' => [
                'required',
                File::types('xlsx')
                    ->max(2 * 1024 *1024)
            ]
        ];
    }
}