<?php

namespace App\Http\Requests\API;

use App\Models\AssetPrices;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreateAssetPricesAPIRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return AssetPrices::$rules;
    }

    // public function failedValidation(Validator $validator)
    // {
    //     throw new HttpResponseException(response()->json([
    //         'success'   => false,
    //         'message'   => 'Validation errors',
    //         'data'      => $validator->errors()
    //     ]));
    // }

    // public function messages()
    // {
    //     return [
    //         'feed_id.required'      => 'Feed Id field is required',
    //         'source_feed.required'  => 'Source Feed field is required',
    //         'price.required'        => 'Price field is required'
    //     ];
    // }
}