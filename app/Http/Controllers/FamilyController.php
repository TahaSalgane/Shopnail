<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFamilyRequest;
use App\Http\Requests\UpdateFamilyRequest;
use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    // Display a paginated list of family members with their associated users
    public function index()
    {
        $families = Family::with('user')->paginate(10);
        return view('dashboard.families.index', compact('families'));
    }

    // Show the form for creating a new family member
    public function create()
    {
        // Get users who do not have family members
        $users = User::doesntHave('familyMembers')->get();
        return view('dashboard.families.create', compact('users'));
    }

    // Store a newly created family member in the database
    public function store(StoreFamilyRequest $request)
    {
        Family::create($request->validated());
        return redirect()->route('families.index')->with('success', 'Family member created successfully.');
    }

    // Show the form for editing an existing family member
    public function edit(Family $family)
    {
        // Get users who do not have family members or the currently associated user
        $users = User::doesntHave('familyMembers')
            ->orWhere('id', $family->user_id)
            ->get();
        return view('dashboard.families.edit', compact('family', 'users'));
    }

    // Update the specified family member in the database
    public function update(UpdateFamilyRequest $request, Family $family)
    {
        $family->update($request->validated());
        return redirect()->route('families.index')->with('success', 'Family member updated successfully.');
    }

    // Remove the specified family member from the database
    public function destroy(Family $family)
    {
        $family->delete();
        return redirect()->route('families.index')->with('success', 'Family member deleted successfully.');
    }
}
