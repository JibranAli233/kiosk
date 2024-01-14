<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if((isset($this->action)) && (($this->action) == "store") ){
            $con    =   [
                            'name'                    => 'required|array',
                            'name.*'                  => 'required|min:2|regex:/^([^0-9]*)$/',
                            'branch_id'               => 'required|array',
                            'branch_id.*'             => 'required|numeric|min:1|exists:branches,id',
                        ];

            return $con; 

        }else{
            $con    =   [
                            'name'                    => 'required|array',
                            'name.*'                  => 'required|min:2|regex:/^([^0-9]*)$/',
                            'branch_id'               => 'required|array',
                            'branch_id.*'             => 'required|numeric|min:1|exists:branches,id',
                        ];

            return $con; 
        }
    }
}
    
