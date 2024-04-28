<?php

namespace App\Http\Requests;

use App\Enums\Priority;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskPostRequest extends FormRequest
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
        // dd(Priority::Medium);
        return [
            'name' => 'required|max:50',
            // 'priority' => ['required', Rule::enum(Priority::class)],
            'priority' => 'required',
            'proyect_id' => 'required',
            'description' => 'required'
        ];
    }
}
