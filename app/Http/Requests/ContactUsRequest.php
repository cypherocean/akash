<?php

    namespace App\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class ContactUsRequest extends FormRequest{
        public function authorize(){
            return true;
        }

        public function rules(){
            return [
                'name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
            ];
        }

        public function messages(){
            return [
                'name.required' => 'Please enter name',
                'email.required' => 'Please enter email address',
                'email.email' => 'Please enter valid email address',
                'subject.required' => 'Please enter subject',
                'message.required' => 'Please enter message'
            ];
        }
    }