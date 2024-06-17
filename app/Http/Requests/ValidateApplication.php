<?php

namespace App\Http\Requests;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Foundation\Http\FormRequest;

class ValidateApplication extends FormRequest
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
        $job = Job::find($this->input('job_id'));
        if ($job == null) {
            $application = Application::findOrFail($this->id);
            $job = Job::findOrFail($application->job_id);
        }
        return [
            'height' => 'required|gte:' . $job->minimumHeight,
            'highSchoolPercentage' => 'required|lte:100|gte:' . $job->minimumHighSchoolPercentage,
            'intermediatePercentage' => 'required|lte:100|gte:' . $job->minimumIntermediatePercentage,
            'preferredJobLocation' => 'required',
            'preferredExamCenter' => 'required',
            'address' => 'required',
        ];
    }




}
