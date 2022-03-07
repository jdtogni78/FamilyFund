<?php

namespace App\Http\Requests;

use App\Http\Requests\API\CashValidator;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\AssetPrice;

class UpdateAssetPriceRequest extends FormRequest
{
    use CashValidator;

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
        $rules = AssetPrice::$rules;

        return $rules;
    }
}
