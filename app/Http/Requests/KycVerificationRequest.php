<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KycVerificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only agents and landlords can submit KYC
        return in_array($this->user()->role, ['agent', 'landlord']);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            // Identity Documents
            'id_type' => 'required|in:passport,drivers_license,national_id',
            'id_number' => 'required|string|max:100',
            'id_front_image' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120', // 5MB
            'id_back_image' => 'nullable|image|mimes:jpeg,png,jpg,pdf|max:5120',
            'selfie_image' => 'required|image|mimes:jpeg,png,jpg|max:5120',
            
            // Proof of Address
            'proof_of_address_type' => 'required|in:utility_bill,bank_statement,rental_agreement,government_letter',
            'proof_of_address_image' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
            
            // Business Information
            'business_name' => 'nullable|string|max:255',
            'tax_id' => 'nullable|string|max:100',
            'business_address' => 'nullable|string|max:500',
        ];

        // Additional rules for agents
        if ($this->user()->role === 'agent') {
            $rules = array_merge($rules, [
                'license_number' => 'required|string|max:100',
                'professional_license_image' => 'required|image|mimes:jpeg,png,jpg,pdf|max:5120',
                'certification_documents.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            ]);
        }

        // Additional rules for landlords
        if ($this->user()->role === 'landlord') {
            $rules = array_merge($rules, [
                'property_ownership_documents.*' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            ]);
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     */
    public function attributes(): array
    {
        return [
            'id_type' => 'identification type',
            'id_number' => 'identification number',
            'id_front_image' => 'ID front image',
            'id_back_image' => 'ID back image',
            'selfie_image' => 'selfie with ID',
            'proof_of_address_type' => 'proof of address type',
            'proof_of_address_image' => 'proof of address',
            'professional_license_image' => 'professional license',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'id_front_image.required' => 'Please upload the front image of your ID document.',
            'selfie_image.required' => 'Please upload a clear selfie holding your ID document.',
            'proof_of_address_image.required' => 'Please upload a valid proof of address document.',
            '*.max' => 'The file size must not exceed 5MB.',
        ];
    }
}
