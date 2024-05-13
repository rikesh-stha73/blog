<?php

// app/Http/Controllers/PermissionController.php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    /**
     * Check the user's role and grant permissions accordingly.
     *
     * @return array
     */
    public function checkPermissions()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return ['post' => true, 'news' => true];
        } elseif ($user->hasRole('Post Manager')) {
            return ['post' => true, 'news' => false];
        } elseif ($user->hasRole('News Manager')) {
            return ['post' => false, 'news' => true];
        }

        return ['post' => false, 'news' => false];
    }
}
