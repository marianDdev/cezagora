<?php

namespace App\Http\Controllers;

use App\Http\Requests\ToggleUserActiveRequest;
use App\Models\User;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
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
}
