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

    public function calculateRemainingTasksToNextLevel(Gamification $gamification, callable $initialize = null): int
    {
        $tasksDone = $gamification->tasks_done ?? 0;
        $currentLevel = $gamification->level;
    
        // Determine tasks required for the current level

        if ($currentLevel === 1) {
            $tasksRequired = 2;
        } elseif ($currentLevel === 2) {
            $tasksRequired = 5;
        } elseif ($currentLevel === 3) {
            $tasksRequired = 9;
        } elseif ($currentLevel === 4) {
            $tasksRequired = 14;
        } elseif ($currentLevel === 5) {
            $tasksRequired = 20;
        } elseif ($currentLevel === 6) {
            $tasksRequired = 27;
        } else {
            $tasksRequired = 27 + (($currentLevel - 6) * 5);
        }
    
        $remaining = $tasksRequired - $tasksDone;
    
        if ($remaining <= 0) {
            // Level up if possible
            $this->updateLevel($gamification);
    
            if ($initialize) {
                call_user_func($initialize);
            }
    
            return 0;
        }
    
        return $remaining;
    }

    public function updateLevel(Gamification $gamification)
{
    $gamification->level += 1;
    $gamification->save();

    // You can return success message or bool if needed
    return true;
}

}