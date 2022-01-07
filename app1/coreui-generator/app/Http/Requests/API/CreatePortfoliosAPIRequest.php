<?php

namespace App\Http\Requests\API;

use App\Models\Portfolios;
use InfyOm\Generator\Request\APIRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CreatePortfoliosAPIRequest extends APIRequest
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
        return Portfolios::$rules;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.required'         => 'Name field is required',
            'type.required'         => 'Type field is required',
            'feed_id.required'      => 'Feed Id field is required',
            'source_feed.required'  => 'Source field is required',
            'last_price.required'   => 'Last price field is required',
            'created.required'      => 'Created field is required',
        ];
    }
}