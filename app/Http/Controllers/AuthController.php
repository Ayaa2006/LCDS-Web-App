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
            'referral_code' => 'nullable|string|exists:users,code'
        ])->validate();
    
        // Generate a unique referral code for the user
        do {
            $referralCode = Str::random(8);
        } while (User::where('code', $referralCode)->exists());
    
        // Generate a unique 7-character gamification code
        do {
            $gamificationCode = Str::random(7); // 7 caractères majuscules
        } while (Gamification::where('code', $gamificationCode)->exists());
    
        // Create the user with the referral code
        $register = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'code' => $referralCode
        ]);
    
        // Create the Gamification record with the generated code
        Gamification::create([
            'level' => 1,
            'point' => 0,
            'code' => $gamificationCode, // Code généré automatiquement
            'friendCode' => $request->referral_code, // Code de parrainage si fourni
            'tasks_done' => 0,
            'user_id' => $register->id
        ]);
    
        if ($request->filled('referral_code')) {
            $referrer = User::where('code', $request->referral_code)->first();
    
            Parrainage::insert([
                'user_id' => $register->id,
                'referrer_id' => $referrer->id,
                'code' => $referrer->code,
                'name_filleul' => $register->name,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            // Add points for the new user and referrer
            $this->addPointsToUser($register->id, 100);
            $this->addPointsToUser($referrer->id, 200);
        }
    
        // Send confirmation email
        Mail::to($register->email)->send(new RegistrationCreated($register));
    
        return redirect()->route('login');
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

    public function AdminLogin()
    {
        return view('auth/loginAdmin');
    }
    public function userLoginAction(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Attempt to authenticate the user using the 'web' guard
        if (Auth::guard('web')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            $request->session()->put('role', 'user');
            session(['role' => 'user']);
            return redirect()->route('lcds')->with('success', 'Login successful.');
        }

        // Handle failed login attempts for users
        return redirect()->back()->withErrors(['message' => 'Invalid user credentials. Please try again.']);
    }


    public function adminLoginAction(Request $request)
    {
        $credentials = $request->validate([
            'Adminemail' => 'required|email',
            'Adminpassword' => 'required'
        ]);
    
        // Manually authenticate the admin
        $admin = Admin::where('email', $credentials['Adminemail'])->first();
        
        // check if the admin exists and verify the password knowing that the password is hashed
        // If the admin does not exist or the password is incorrect, redirect back with an error
         // Check if the admin exists and verify the password


        if (!$admin || !Hash::check($credentials['Adminpassword'], $admin->password)) {
            return redirect()->back()->withErrors(['message' => 'Invalid admin credentials. Please try again.']);
        }
        // Specify the admin guard explicitly
        // Log the admin in using the 'admin' guard

        // Regenerate the session to prevent session fixation attacks
        $request->session()->regenerate();
        session(['role' => 'admin']);
        $request->session()->put('role', 'admin');
        // Store the admin's role in the session
        Auth::guard('admin')->login($admin);
        
    
        return redirect()->route('dashboard')->with('success', 'Admin login successful.');
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
            session()->forget('role');
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
    // Check authentication
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $user = Auth::user();
    
    // Load gamification with fallback creation
    $user->load(['gamification' => function($query) {
        $query->firstOrCreate(
            ['user_id' => Auth::id()],
            ['point' => 0, 'level' => 1, 'tasks_done' => 0]
        );
    }]);

    // Get all available tasks
    $tasks = Task::all(); // Or any specific query you need
    
    // Calculate level progress
    $gamification = $user->gamification;
    $currentPoints = $gamification->point;
    $currentLevel = $gamification->level;
    $pointsToNextLevel = max(0, (($currentLevel + 1) * 100) - $currentPoints);
    $currentLevelProgress = min(100, ($currentPoints % 100));

    return view('gamification', [
        'user' => $user,
        'gamification' => $gamification,
        'tasks' => $tasks, // Make sure this is passed
        'currentLevel' => $currentLevel,
        'pointsToNextLevel' => $pointsToNextLevel,
        'currentLevelProgress' => $currentLevelProgress
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
