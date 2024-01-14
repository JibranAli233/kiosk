<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        if((isset($this->action)) && (($this->action) == "store") ){
            $con    =   [
                            'name'                  => 'required|min:2|regex:/^([^0-9]*)$/',
                            'manufacturer_id'       => 'required|numeric|min:1|exists:manufacturers,id',
                            'category_id'           => 'required|numeric|min:1|exists:categories,id',
                            'manufacturer_id'       => 'required|numeric|min:1|exists:manufacturers,id',
                            'purchase_price'        => 'sometimes|numeric|min:0',
                            'sell_price'            => 'sometimes|numeric|min:0',

                        ];

            return $con; 

        }else{
            $con    =   [
                        'name'                  => 'required|min:2|regex:/^([^0-9]*)$/',
                        'manufacturer_id'       => 'required|numeric|min:1|exists:manufacturers,id',
                        'category_id'           => 'required|numeric|min:1|exists:categories,id',
                        'manufacturer_id'       => 'required|numeric|min:1|exists:manufacturers,id',
                        'purchase_price'        => 'sometimes|numeric|min:0',
                        'sell_price'            => 'sometimes|numeric|min:0',
                        ];

            return $con; 
        }
    }
}
    
