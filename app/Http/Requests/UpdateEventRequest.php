<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->email === 'multimedia.latihhobi@gmail.com';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:500',
            'link' => 'nullable|url',
            'description' => 'nullable|string',
            'start_date' => 'required|date_format:Y-m-d\TH:i',
            'end_date' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:start_date',
            'registration_start' => 'nullable|date_format:Y-m-d\TH:i',
            'registration_end' => 'nullable|date_format:Y-m-d\TH:i|after_or_equal:registration_start',
            'location' => 'nullable|string|max:255',
            'max_participants' => 'nullable|integer|min:1',
            'price' => 'nullable|numeric|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'title.required' => 'Judul event wajib diisi.',
            'title.max' => 'Judul event maksimal 255 karakter.',
            'short_description.max' => 'Deskripsi singkat maksimal 500 karakter.',
            'link.url' => 'Link harus berupa URL yang valid.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_date.date_format' => 'Format tanggal mulai tidak valid.',
            'end_date.date_format' => 'Format tanggal selesai tidak valid.',
            'end_date.after_or_equal' => 'Tanggal selesai harus setelah atau sama dengan tanggal mulai.',
            'registration_start.date_format' => 'Format tanggal mulai pendaftaran tidak valid.',
            'registration_end.date_format' => 'Format tanggal selesai pendaftaran tidak valid.',
            'registration_end.after_or_equal' => 'Tanggal selesai pendaftaran harus setelah atau sama dengan tanggal mulai pendaftaran.',
            'location.max' => 'Lokasi maksimal 255 karakter.',
            'max_participants.integer' => 'Maksimal peserta harus berupa angka bulat.',
            'max_participants.min' => 'Maksimal peserta minimal 1.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
        ];
    }
}