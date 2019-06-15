<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait UploadFiles
{
    /**
     * Upload the given file and return the path.
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $directory
     *
     * @return string
     */
    public function storeFile(UploadedFile $file, string $directory = 'default'): string
    {
        return $this->storeFileAs($file, $directory, str_random(10) . time());
    }

    /**
     * Upload the given file and return the path.
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string $suggestedName
     *
     * @return string
     *
     * @throws \Exception
     */
    public function storeFileAs(
        UploadedFile $file,
        string $directory = 'default',
        string $suggestedName
    ): string
    {
        if ($file->isValid()) {
            $generatedName = $this->generateFileName($file, $suggestedName);

            if ($path = $file->storeAs($directory, $generatedName, 'public')) {
                return $path;
            }

            throw new \Exception("Something goes wrong when moving the document.");
        }

        throw new \Exception("Invalid document.");
    }

    /**
     * Generate file name from the given parameters.
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $suggestedName
     *
     * @return string
     */
    private function generateFileName(UploadedFile $file, string $suggestedName): string
    {
        return sprintf('%s-%d.%s',
            str_slug($suggestedName),
            time(),
            $file->getClientOriginalExtension()
        );
    }

    /**
     * Upload the given file then delete the old one and return the new path.
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string|null $oldImagePath
     * @param  bool $deleteOldImage
     *
     * @return string
     */
    public function updateFile(
        UploadedFile $file,
        string $directory = 'default',
        ?string $oldImagePath,
        bool $deleteOldImage = true
    ): string
    {
        return $this->updateFileAs($file, $directory, str_random(10), $oldImagePath, $deleteOldImage);
    }

    /**
     * Upload the given file then delete the old one and return the new path.
     *
     * @param  Illuminate\Http\UploadedFile $file
     * @param  string $directory
     * @param  string $suggestedName
     * @param  string|null $oldImagePath
     * @param  bool $deleteOldImage
     *
     * @return string
     */
    function updateFileAs(
        UploadedFile $file,
        string $directory = 'default',
        string $suggestedName,
        ?string $oldFilePath,
        bool $deleteOldFile = true
    ): string
    {
        $newFilePath = $this->storeFileAs($file, $directory, $suggestedName);

        if ($deleteOldFile) {
            $this->deleteFile($oldFilePath);
        }

        return $newFilePath;
    }

    /**
     * delete the given file if found.
     *
     * @param  string|null $oldFilePath
     *
     * @return void
     *
     * @throws \Exception
     */
    public function deleteFile(?string $oldFilePath): void
    {
        if ($oldFilePath) {
            try {
                $deleted = Storage::delete('public/' . $oldFilePath);

                if (!$deleted) {
                    throw new \Exception(
                        sprintf('An error happened while deleting this image path [%s]',
                            $oldFilePath)
                    );
                }
            } catch (\Exception $e) {
                // In deleting old images we need only if something goes wrong to log the exception
                // and not return anything to the user.
                report($e);
            }
        }
    }
}
