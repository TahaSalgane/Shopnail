<?php

namespace App\Services;

use App\Models\User;
use App\Models\Family;

class UserService
{
    public function createUserWithFamily($userData, $familyData)
    {
        // Create the user
        $user = User::create($userData);

        // Check if family data is provided and valid
        if (!empty($familyData)) {
            foreach ($familyData as $family) {
                if (!empty($family['name']) && !empty($family['relationship']) && !empty($family['date_of_birth'])) {
                    $user->familyMembers()->create($family);
                }
            }
        }

        return $user;
    }

    public function updateUserWithFamily($user, $userData, $familyData)
    {
        // Update user data
        $user->update($userData);
    
        // Process family data
        foreach ($familyData as $family) {
            // If the family member already exists (has an 'id'), update it
            if (isset($family['id'])) {
                $user->familyMembers()->updateOrCreate(['id' => $family['id']], $family);
            } else {
                // Otherwise, create a new family member
                if (!empty($family['name']) && !empty($family['relationship']) && !empty($family['date_of_birth'])) {
                    $user->familyMembers()->create($family);
                }
            }
        }
    
        return $user;
    }
    
}

