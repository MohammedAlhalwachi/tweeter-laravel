<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProfileBannerController extends Controller
{
    /**
     * Delete the current user's profile photo.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function destroy(Request $request)
    {
        $request->user()->deleteProfileBanner();

        return back(303)->with('status', 'profile-photo-deleted');
    }
}
