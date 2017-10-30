<?php

namespace Furbook\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class CatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'POST':
                return true;
            case 'PUT':
            case 'PATCH':
                $cat = $this->route('cat');
                return Auth::user()->canEdit($cat);
            default:
                return true;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {        
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|max:255|unique:cats,name',
                    'date_of_birth' => 'required|date_format:"Y-m-d"',
                    'breed_id' => 'required|numeric',
                ];
            case 'PUT':
            case 'PATCH':
                $cat = $this->route('cat');
                return [
                    'name' => 'max:255|unique:cats,name,' . $cat->id,
                    'date_of_birth' => 'date_format:"Y-m-d"',
                    'breed_id' => 'numeric',
                ];
            default:
                return [];
        }
    }
}
