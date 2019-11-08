<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GetAuthenticatedUserInfo extends Controller
{
    /**
     * Get the authenticated user's information
     *
     * @return Response
     */
    public function __invoke()
    {
        $user = request()->user();

        $user->load([
            'accessControls',
            'accessControls.module' => function ($query) {
                $query->orderBy('created_at');
            },
        ]);

        return response($user);
    }
}
