<?php

namespace App\Http\Controllers;

use Illuminate\Console\Events\ScheduledTaskStarting;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use App\Models\Gamification;
use App\Models\Task;
use App\Models\Parrainage;
use Illuminate\Support\Str;
use App\Mail\RegistrationCreated;
use App\Mail\AbonnementCreated;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;



class AuthController extends Controller
{
    //GESTION DES USERS SUR LE DASHBOARD
    public function index()
    {
        // Récupérer tous les utilisateurs
        $utilisateurs = User::all();

        // Passer les utilisateurs à la vue
        return view('utilisateurs.index', compact('utilisateurs'));
    }

    //DELETE USER
    public function destroy($id)
    {
        $utilisateurs = User::findOrFail($id);

        if ($utilisateurs->id == auth()->id()) {
            return redirect()->route('utilisateurs.index')->with('error', 'Vous ne pouvez pas vous supprimer vous-même.');
        }

        $utilisateurs->delete();

        return redirect()->route('utilisateurs.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

//DELETE ACCOUNT
    public function destroyProfile()
{
    $user = Auth::user();

    // Perform the deletion logic
    $user->delete();

    // Logout the user and redirect
    Auth::logout();

    return redirect()->route('lcds')->with('success', 'Your account has been deleted successfully.');
}


    //Admin-Profil
    public function indexss()
    {
       //the admin profile
       $admins = Admin::all();


       return view('settings/indexss', compact('admins'));
    }


    public function register()
    {
        return view('auth/register');
    }


    public function registerSave(Request $request)
{
    // Validate the request data
    Validator::make($request->all(), [
        'name' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed',
        'referral_code' => 'nullable|string|exists:users,code' // validate referral code if provided
    ])->validate();

    // Generate a unique referral code
    do {
        $referralCode = Str::random(8);
    } while (User::where('code', $referralCode)->exists());

    // Create the user with the referral code
    $register = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'code' => $referralCode
    ]);

    // Create the Gamification record for the new user
    Gamification::create([
        'level' => 1,
        'point' => 0,
        'Code' => null,
        'friendCode' => null,
        'tasks_done' => 0,
        'user_id' => $register->id // Link to the newly created user
    ]);

    if ($request->filled('referral_code')) {
        $referrer = User::where('code', $request->referral_code)->first();

        // Add entry to the referral table
        Parrainage::insert([
            'user_id' => $register->id,
            'referrer_id' => $referrer->id,
            'code' => $referrer->code,
            'name_filleul' => $register->name, // Ensure to include this line
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Add points for the new user and referrer
        $this->addPointsToUser($register->id, 100);
        $this->addPointsToUser($referrer->id, 200);
    }

    // Send confirmation email
    Mail::to($register->email)->send(new RegistrationCreated($register));

    // Redirect to the login page
    return redirect()->route('login');
}




    private function addPointsToUser($userId, $points)
    {
        // Vérifier si l'utilisateur a déjà une entrée dans la table gamification
        $gamification = Gamification::firstOrNew(['user_id' => $userId]);

        // Ajouter les points à la colonne 'point' au lieu de 'points'
        $gamification->point = $gamification->point + $points;
        $gamification->level = $this->calculateLevel($gamification->point);

        // Sauvegarder les changements
        $gamification->save();
    }

    private function calculateLevel($points)
    {
        // Logique pour calculer le niveau en fonction des points
        if ($points >= 1000) {
            return 5;
        } elseif ($points >= 500) {
            return 4;
        } elseif ($points >= 200) {
            return 3;
        } elseif ($points >= 100) {
            return 2;
        } else {
            return 1;
        }
    }




    public function profile()
{
    $user = Auth::user(); // Fetch the authenticated user
    return view('profile', compact('user'));
}




    public function login()
    {
        return view('auth/login');
    }

    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ])->validate();

        // auth user
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
        //session variable role
        $request->session()->put('role', 'user');
            return redirect()->route('lcds');
        }
    // Manually authenticate the Admin model for plain text passwords
    $credentials = $request->only('email', 'password');
    $admin = Admin::where('email', $credentials['email'])->first();

    if ($admin && $admin->password === $credentials['password']) {
        Auth::guard('admin')->login($admin);
        $request->session()->regenerate();
        $request->session()->put('role', 'admin');
        return redirect()->route('lcds');
    }

    // Handle failed login attempts
    return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);

    }


    public function logout(Request $request)
    {
        // Determine the guard used for authentication
        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            return redirect('/lcds');
        } elseif (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $request->session()->invalidate();
            return redirect('/auth/login');
        }
    }




    //USER-FACE PROFIL
    public function indexs()
{
    $user = Auth::user();

    return view('profile', compact('user'));
}

   // Affiche le formulaire d'édition du profil
   public function edit()
   {
       $user = Auth::user();

       // Check if user is authenticated
       if (!$user) {
           return redirect()->route('login')->with('error', 'You must be logged in to edit your profile.');
       }

       return view('profile-edit', compact('user'));
   }

    // Gère la mise à jour du profil
    public function update(Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'You must be logged in to update your profile.');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $user->name = $request->input('name');

    if ($request->hasFile('img')) {
        Log::info('Updating profile image...');

        if ($user->img && Storage::exists('public/' . $user->img)) {
            Storage::delete('public/' . $user->img);
        }

        $path = $request->file('img')->store('profile_images', 'public');
        $user->img = $path;
        Log::info('Profile image updated to: ' . $path);
    }

    $user->save();

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully');
}


//to show the gamif blade to the user
public function indexsss()
{
    $user = Auth::user()->load('gamification');
    // dd($user->gamification); // Check if gamification data is loaded


    // Initialize variables
    $gamification = $user->gamification;
    $pointsToNextLevel = null;
    $currentLevel = 1; // Default level
    $currentPoints = 0; // Default points

    if ($gamification) {
        $currentPoints = $gamification->point;

        // Define the points required to level up
        $levelUpPoints = [
            1 => 100,  // Bronze
            2 => 200,  // Silver
            3 => 300,  // Gold
            // Add more levels if necessary
        ];

        // Determine current level based on points
        foreach ($levelUpPoints as $level => $points) {
            if ($currentPoints >= $points) {
                $currentLevel = $level;
            }
        }

        // Calculate points to next level
        $pointsToNextLevel = isset($levelUpPoints[$currentLevel]) ? $levelUpPoints[$currentLevel] - $currentPoints : 0;
    }

    // Retrieve tasks
    $tasks = Task::all();

    // Return the view with all relevant data
    return view('gamification', [
        'gamification' => $gamification,
        'pointsToNextLevel' => max(0, $pointsToNextLevel),
        'currentLevel' => $currentLevel,
        'currentPoints' => $currentPoints,
        'tasks' => $tasks,
    ]);
}


private function pointsForNextLevel($currentLevel)
{
    // Simple example: Increase required points as the level increases
    switch ($currentLevel) {
        case 1:
            return 50;  // 50 points for level 2
        case 2:
            return 100; // 100 points for level 3
        case 3:
            return 150; // 150 points for level 4
        default:
            return 200; // Beyond level 3, 200 points per level
    }
}



public function completeTask($taskId)
{
    $user = Auth::user();
    $task = Task::find($taskId);

    if ($task) {
        if (!$task->completed) {
            $task->completed = true; // Mark the task as completed
            $task->save(); // Save the task

            // Update gamification points
            $this->updateGamificationPoints($user->id, $task->point);

            return redirect()->back()->with('success', 'Task completed successfully!');
        }

        return redirect()->back()->with('error', 'Task already completed.');
    }

    return redirect()->back()->with('error', 'Task not found.');
}

private function updateGamificationPoints($userId, $points)
{
    $gamification = Gamification::where('user_id', $userId)->first();
    if ($gamification) {
        $gamification->point += $points; // Correctly updating the points
        $gamification->level = $this->calculateLevel($gamification->point); // Update level based on new points
        $gamification->save(); // Save the changes
    }
}



// public function completeTask($taskId)
// {
//     $user = Auth::user();

//     // Find the task
//     $task = Task::findOrFail($taskId);

//     if (!$task->completed) {
//         // Award points to the user
//         $pointsPerTask = $task->point;

//         // Update the user's gamification
//         if ($user->gamification) {
//             $user->gamification->point += $pointsPerTask;
//             $user->gamification->tasks_done += 1;

//             // Check for level-up logic (example logic)
//             $pointsForNextLevel = $this->pointsForNextLevel($user->gamification->level);

//             if ($user->gamification->point >= $pointsForNextLevel) {
//                 $user->gamification->level += 1; // Increment level
//                 // Reset points after level up
//                 $user->gamification->point = $user->gamification->point - $pointsForNextLevel;
//             }

//             $user->gamification->save();
//         }

//         // Mark the task as completed
//         $task->completed = true;
//         $task->save();

//         return redirect()->back()->with('success', 'Task completed and points awarded!');
//     }

//     return redirect()->back()->with('error', 'Task already completed!');
// }


// public function completeTask($taskId)
// {
//     $user = Auth::user();
//     $task = Task::find($taskId);

//     if ($task && !$task->completed) {
//         $task->completed = true; // Mark the task as completed
//         $task->save();

//         // Add points to the user
//         $gamification = Gamification::where('user_id', $user->id)->first();
//         if ($gamification) {
//             $gamification->points += $task->point; // Adjust according to your points logic
//             $gamification->save();
//         }

//         return redirect()->back()->with('success', 'Task completed successfully!');
//     }

//     return redirect()->back()->with('error', 'Task not found or already completed.');
// }






}
