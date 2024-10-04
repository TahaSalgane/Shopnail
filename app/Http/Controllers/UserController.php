<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService; // Inject the UserService for handling user-related operations
        $this->middleware('auth');
    }

    // Display a paginated list of users along with their family members
    public function index()
    {
        $users = User::with('familyMembers')->paginate(10);
        return view('dashboard.users.index', compact('users'));
    }

    public function create()
    {
        return view('dashboard.users.create');
    }

    // Store a newly created user in the database
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();
    
        // Hash the user's password before saving
        $validated['password'] = bcrypt($validated['password']);
        $familyData = $request->has('family') ? $request->family : [];
        
        // Use the UserService to create the user and their family members
        $this->userService->createUserWithFamily($validated, $familyData);
    
        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }
    
    // Show the form for editing an existing user
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }

    // Update the specified user in the database
    public function update(UpdateUserRequest $request, User $user)
    {
        $validated = $request->validated();
        $familyData = $request->has('family') ? $request->family : [];
    
        $this->userService->updateUserWithFamily($user, $validated, $familyData);
    
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Remove the specified user from the database
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
