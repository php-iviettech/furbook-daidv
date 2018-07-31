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
     * Price format: xx.xxx.xxx
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'POST':
                return [
                    'name' => 'required|max:255|unique:cats,name',
                    'date_of_birth' => 'required|date_format:"Y-m-d"',
                    'price' => 'required|currency_size:1,8|regex:/^(\d{1,3})?+(?:\,[0-9]{3})?+(?:\,[0-9]{3})?$/',
                    'breed_id' => 'required|numeric',
                ];
            case 'PUT':
            case 'PATCH':
                $cat = $this->route('cat');
                return [
                    'name' => 'required|max:255|unique:cats,name,' . $cat->id,
                    'date_of_birth' => 'date_format:"Y-m-d"',
                    'price' => 'currency_size:1,8|regex:/^(\d{1,3})?+(?:\,[0-9]{3})?+(?:\,[0-9]{3})?$/',
                    'breed_id' => 'numeric',
                ];
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
            'required' => 'Trường :attribute là bắt buộc.',
            'unique' => 'Trường :attribute đã bị trùng.',
            'numeric' => 'Trường :attribute phải là kiểu số.',
            'date_format' => 'Trường :attribute định dạng chưa đúng kiểu "Y-m-d"',
            'regex' => 'Trường :attribute định dạng không đúng.',
            'currency_size' => 'Trường :attribute độ dài phải lớn hơn :min và nhỏ hơn :max.',
        ];
    }
}
