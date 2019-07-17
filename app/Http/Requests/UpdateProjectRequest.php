<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use App\Project;

class UpdateProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::allows('update', $this->project());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'sometimes|required',
            'description' => 'sometimes|required|max:100',
            'notes' => 'nullable'
        ];
    }

    public function save(){
        // $project = $this->project();
        // $project->update($this->validated());
        // return $project;

        return tap($this->project())->update($this->validated());;
    }

    public function project(){
        // return $this->route('project');
        return Project::findOrFail($this->route('project'));
    }
}
