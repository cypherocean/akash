<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PortfolioRequest extends FormRequest{
    public function authorize(){
        return true;
    }

    public function rules(){
        if($this->method() == 'PATCH'){
            return [
                'name' => 'required|max:255',
                'description' => 'required'
            ];
        }else{
            return [
                'name' => 'required|max:255',
                'description' => 'required'
            ];
        }
    }

    public function messages(){
        return [
            'name.required' => 'Please enter name',
            'name.max' => 'Please enter name maximum 255 characters',
            'description.required' => 'Please enter description',
        ];
    }
}
