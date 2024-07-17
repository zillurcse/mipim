<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactUsRequest extends FormRequest
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
        return [
            'first_name' => 'required|string|max:255|min:3',
            'last_name' => 'required|string|max:255|min:3',
            'email' => 'required|email|max:255|min:3',
            'message' => 'required|string|min:3',
            'is_reply' => 'nullable|boolean',
            'phone_code' => 'nullable|string|max:15|min:6',
            'country_code' => 'nullable|string|max:8|min:1',
            'message_reply' => 'nullable|string',
            'status' => 'nullable|in:sent,draft,reply'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'first_name' => $this->sanitize($this->first_name),
            'last_name' => $this->sanitize($this->last_name),
            'email' => $this->sanitize($this->email),
            'message' => $this->sanitize($this->message),
            'message_reply' => $this->sanitize($this->message_reply),
        ]);
    }

    private function sanitize($input)
    {
        // Replace certain HTML entities to prevent XSS attacks
        $input = str_replace(['&', '<', '>'], ['&amp;', '&lt;', '&gt;'], $input);
        return strip_tags($input); // Strip remaining HTML tags
    }
}
