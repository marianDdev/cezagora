<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleRoleRequest;
use App\Http\Requests\ToggleUserActiveRequest;
use App\Models\User;
use App\Services\Company\CompanyServiceInterface;
use App\Services\File\FileServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function toggleActive(
        ToggleUserActiveRequest $request,
        UserServiceInterface    $userService,
        CompanyServiceInterface $companyService,
        int                     $id
    ): RedirectResponse
    {
        $validated = $request->validated();
        $user = User::find($id);
        $userService->toggleActive($user, $validated['activate'], $validated['deleted_at']);
        $companyService->toggleActive($user, $validated['activate']);

        if ($validated['activate']) {
            return redirect()->route('account.reactivated.page');
        }

        Auth::logout();
        Session::flush();

        return redirect()->route('account.deactivated.page');
    }

    public function uploadProfileImage(Request $request, FileServiceInterface $fileService): RedirectResponse
    {
        try {
            $fileService->uploadProfilePicture($request);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->back()->with('success', 'Profile image uploaded successfully.');
    }

    public function toggleRole(ToggleRoleRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $user = $this->authUser();
        $currentRole = $user->getRoleNames()->first();
        $newRole = $validated['role'];

        if ($newRole === $currentRole) {
            return redirect()->back();
        }

        $user->removeRole($currentRole);
        $user->assignRole($newRole);

        if ($newRole === UserServiceInterface::ROLE_SELLER && !$user->stripe_account_enabled) {
            return redirect()->route('onboarding');
        }

        return redirect()->back();
    }
}
