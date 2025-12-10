<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEcourseRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'id_category' => 'required|integer|exists:category,id_category',
            'course_by' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'image_url' => 'nullable|string|max:255',
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
            'title.required' => 'Judul e-course wajib diisi.',
            'title.max' => 'Judul e-course maksimal 255 karakter.',
            'description.required' => 'Deskripsi lengkap wajib diisi.',
            'short_description.required' => 'Deskripsi singkat wajib diisi.',
            'short_description.max' => 'Deskripsi singkat maksimal 500 karakter.',
            'category.required' => 'Kategori wajib dipilih.',
            'price.required' => 'Harga wajib diisi.',
            'price.numeric' => 'Harga harus berupa angka.',
            'price.min' => 'Harga tidak boleh negatif.',
            'discount_price.numeric' => 'Harga diskon harus berupa angka.',
            'discount_price.min' => 'Harga diskon tidak boleh negatif.',
            'discount_price.lt' => 'Harga diskon harus lebih kecil dari harga normal.',
            'duration.required' => 'Durasi wajib diisi.',
            'total_lessons.required' => 'Total pelajaran wajib diisi.',
            'total_lessons.integer' => 'Total pelajaran harus berupa angka bulat.',
            'total_lessons.min' => 'Total pelajaran minimal 1.',
            'level.required' => 'Level wajib dipilih.',
            'level.in' => 'Level harus salah satu dari: Beginner, Intermediate, Advanced.',
            'image.image' => 'File gambar harus berupa gambar.',
            'image.mimes' => 'Format gambar harus: jpeg, png, jpg, gif.',
            'image.max' => 'Ukuran gambar maksimal 2MB.',
            'thumbnail.image' => 'File thumbnail harus berupa gambar.',
            'thumbnail.mimes' => 'Format thumbnail harus: jpeg, png, jpg, gif.',
            'thumbnail.max' => 'Ukuran thumbnail maksimal 1MB.',
            'demo_video.url' => 'URL video demo tidak valid.',
        ];
    }
}
