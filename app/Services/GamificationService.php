<?php

namespace App\Services;

use App\Models\Gamification;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GamificationService
{
    public function handlePaymentGamification($userId)
    {
        Log::info("Starting gamification update for user ID: $userId"); // Add this line
        try {
            $user = User::find($userId);
            
            if (!$user) {
                Log::warning("User not found with ID: $userId");
                return;
            }
            
            // Find or create gamification profile
            $gamification = Gamification::firstOrCreate(
                ['user_id' => $userId],
                [
                    'level' => 1,
                    'point' => 500,
                    'Code' => '',
                    'friendCode' => '',
                    'tasks_done' => 0,
                ]
            );
            
            // Award fixed 500 points for payment
            $pointsEarned = 500;
            
            // Update gamification
            $gamification->increment('point', $pointsEarned);
            $gamification->increment('tasks_done');
            
            // Handle level progression
            $this->handleLevelProgression($gamification);
            
            Log::info("Updated gamification for user $userId. Added $pointsEarned points.");
            
        } catch (\Exception $e) {
            Log::error("Gamification update error for user $userId: " . $e->getMessage());
        }
    }

    protected function handleLevelProgression($gamification)
    {
        $currentLevel = $gamification->level;
        $tasksDone = $gamification->tasks_done;
        $remainingTasks = $this->calculateRemainingTasks($currentLevel, $tasksDone);
        
        // If remaining tasks reaches 0, level up
        if ($remainingTasks <= 0) {
            $gamification->level += 1;
            $gamification->save();
            
            // After level up, check if we need to level up again
            $newRemaining = $this->calculateRemainingTasks($gamification->level, $tasksDone);
            if ($newRemaining <= 0) {
                // This handles cases where multiple level-ups might be needed
                $this->handleLevelProgression($gamification);
            }
        }
    }

    protected function calculateRemainingTasks($currentLevel, $tasksDone)
    {
        $remaining = 0;
        
        if ($currentLevel == 1) {
            $remaining = 2 - $tasksDone;
        } 
        elseif ($currentLevel <= 6) {
            $remaining = ($currentLevel * 2 + 1) - $tasksDone;
        } 
        else {
            $remaining = (($currentLevel - 6) * 4) + 4 - $tasksDone;
        }
        
        return $remaining;
    }
}