<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UploadServices
{
    private $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

    public function upload(Request $request)
    {
        $linkTarget = storage_path('app/public');
        $linkName = public_path('storage');

        if (!file_exists($linkName)) {
            symlink($linkTarget, $linkName);
        }

        $request->validate([
            'file' => 'required|file',
        ]);

        $image = [];

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $extension = strtolower($file->getClientOriginalExtension());

            if (!in_array($extension, $this->allowedExtensions)) {
                $image = [
                    'status' => false,
                    'error' => 'O arquivo não é uma imagem válida (permitidos: jpg, jpeg, png, gif).',
                ];
            } else {
                $file->store('public/images');
                $name = $file->hashName();
                $image = [
                    'status' => true,
                    'file_name' => $name,
                ];
            }

            return $image;
        }
    }
}
