<?php

namespace App\src\Domain\ExcelDataUploads\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class ExcelDataFileUploadRequest extends FormRequest
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
                    ->max(250 * 1024)
            ],
        ];
    }
}