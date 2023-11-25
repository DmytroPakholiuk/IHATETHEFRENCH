<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDealRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "name" => "required",
            "account_name" => "required",
            "closing_date" => "required|regex:/[0-9]{4}-[0-9]{2}-[0-9]{2}/",
            "stage" => [
                "required",
                Rule::in([
                    "Qualification",
                    "Needs Analysis",
                    "Value Proposition",
                    "Identify Decision Makers",
                    "Proposal/Price Quote",
                    "Negotiation/Review",
                    "Closed Won",
                    "Closed Lost",
                    "Closed Lost to Competition"
                ])
            ]
        ];
    }

    public function after()
    {
        return [
        ];
    }
}
