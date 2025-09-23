<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FileController extends ApiBaseController
{
    /**
     * Upload a file
     */
    public function upload(Request $request)
    {
        try {
            $user = $request->user();
            
            $validator = Validator::make($request->all(), [
                'file' => 'required|file',
                'fileable_type' => 'required|string',
                'fileable_id' => 'required|integer',
                'is_public' => 'boolean',
            ]);

            if ($validator->fails()) {
                return $this->error('Validation failed', $validator->errors(), 422);
            }
            
            $file = $request->file('file');
            
            // Validate file type based on configuration
            $allowedTypes = config('app.allowed_file_types', [
                'image/jpeg',
                'image/png',
                'image/gif',
                'image/webp',
                'video/mp4',
                'video/quicktime',
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            ]);
            
            if (!in_array($file->getMimeType(), $allowedTypes)) {
                return $this->error('File type not allowed');
            }
            
            // Validate file size (max 100MB by default)
            $maxSize = config('app.max_file_size', 100 * 1024 * 1024);
            if ($file->getSize() > $maxSize) {
                return $this->error('File size exceeds the maximum allowed size');
            }
            
            // Store file
            $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            
            // Create file record
            $fileRecord = File::create([
                'user_id' => $user->id,
                'fileable_type' => $request->fileable_type,
                'fileable_id' => $request->fileable_id,
                'name' => $filename,
                'original_name' => $file->getClientOriginalName(),
                'path' => $path,
                'size' => $file->getSize(),
                'mime_type' => $file->getMimeType(),
                'disk' => 'public',
                'is_public' => $request->is_public ?? false,
            ]);
            
            return $this->success($fileRecord, 'File uploaded successfully', 201);
        } catch (\Exception $e) {
            return $this->error('Failed to upload file', $e->getMessage(), 500);
        }
    }

    /**
     * Download a file
     */
    public function download(Request $request, $id)
    {
        try {
            $file = File::findOrFail($id);
            
            // Check if user has permission to download this file
            // For now, we'll allow if the file is public or if the user owns it
            if (!$file->is_public && $file->user_id !== $request->user()->id) {
                // In a real implementation, you might check if the user has access
                // to the content this file belongs to (e.g., enrolled in the course)
                return $this->error('Unauthorized to download this file', null, 403);
            }
            
            // Return file response
            return response()->file(Storage::disk($file->disk)->path($file->path));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('File not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to download file', $e->getMessage(), 500);
        }
    }

    /**
     * Get files for a specific model
     */
    public function forModel(Request $request, $fileableType, $fileableId)
    {
        try {
            $files = File::where('fileable_type', $fileableType)
                ->where('fileable_id', $fileableId)
                ->get();
                
            return $this->success($files, 'Files retrieved successfully');
        } catch (\Exception $e) {
            return $this->error('Failed to retrieve files', $e->getMessage(), 500);
        }
    }

    /**
     * Delete a file
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = $request->user();
            
            $file = File::findOrFail($id);
            
            // Check if user owns the file
            if ($file->user_id !== $user->id) {
                return $this->error('Unauthorized to delete this file', null, 403);
            }
            
            // Delete file from storage
            Storage::disk($file->disk)->delete($file->path);
            
            // Delete file record
            $file->delete();
            
            return $this->success(null, 'File deleted successfully');
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->error('File not found', null, 404);
        } catch (\Exception $e) {
            return $this->error('Failed to delete file', $e->getMessage(), 500);
        }
    }
}