<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateJob extends FormRequest
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
            'title' => 'required|max:255',
            'post' => 'required|max:255',
            'registrationStartDate' => 'required|date|after_or_equal:today',
            'registrationEndDate' => 'required|date|after_or_equal:registrationStartDate',
            'minimumAge' => 'required',
            'maximumAge' => 'required',
            'jobLocation' => 'required',
            'examCenter' => 'required',
            'minimumHighSchoolPercentage' => 'required',
            'minimumIntermediatePercentage' => 'required',
            'examDate' => 'required|after:registrationEndDate',
            'jobDescription' => 'required'
        ];
    }
}
