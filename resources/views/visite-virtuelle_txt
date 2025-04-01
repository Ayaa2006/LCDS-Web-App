<?php

namespace App\Services;

use App\Models\Submited_Task;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskService
{
    public function storeTaskSubmission($taskId, $userId, $submittedFiles)
{
    try {
        $user = User::findOrFail($userId);
        $username = Str::slug($user->name);
        
        // Normalisation du chemin
        $folderPath = "Tasks/{$userId}_{$username}";
        $storagePath = "public/{$folderPath}";
        
        // Création du dossier
        if (!Storage::exists($storagePath)) {
            Storage::makeDirectory($storagePath, 0755, true);
        }

        // Récupération ou création de la soumission
        $submission = Submited_Task::firstOrNew([
            'id_task' => $taskId,
            'id_user' => $userId
        ]);

        // Nettoyage des fichiers existants
        $existingFiles = $submission->exists ? 
            array_filter(explode(',', trim($submission->files, '"'))) : [];
        
        $existingFilesMap = [];

        foreach ($existingFiles as $filePath) {
            if (preg_match('/_Image(\d+)\./', basename($filePath), $matches)) {
                $existingFilesMap[$matches[1]] = trim($filePath, '"');
            }
        }

        // Traitement des nouveaux fichiers
        foreach ($submittedFiles as $imageNumber => $file) {
            if (!$file || !$file->isValid()) continue;

            // Suppression de l'ancien fichier
            if (isset($existingFilesMap[$imageNumber])) {
                $oldPath = str_replace('public/', '', $existingFilesMap[$imageNumber]);
                Storage::delete("public/{$oldPath}");
            }

            // Enregistrement du nouveau fichier
            $extension = $file->getClientOriginalExtension();
            $filename = "{$userId}_{$username}_Task{$taskId}_Image{$imageNumber}.{$extension}";
            $filePath = $file->storeAs($storagePath, $filename);
            
            // Chemin relatif sans "public/" et sans guillemets
            $relativePath = str_replace('public/', '', $filePath);
            $existingFilesMap[$imageNumber] = $relativePath;
        }

        // Sauvegarde finale
        ksort($existingFilesMap);
        
        $filesList = implode(',', $existingFilesMap);
        
        $submission->fill([
            'status' => 'waiting',
            'files' => $filesList // Stocké sans guillemets
        ])->save();

        return [
            'success' => true,
            'data' => $submission
        ];

    } catch (\Exception $e) {
        return [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}
}