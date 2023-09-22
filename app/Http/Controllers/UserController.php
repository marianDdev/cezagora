<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Ingredient\IngredientServiceInterface;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function softDelete(
        UserServiceInterface $userService,
        CompanyServiceInterface $companyService,
        IngredientServiceInterface $ingredientService,
        int $id
    ): RedirectResponse {
        $user = User::find($id);
        $userService->softDelete($user);
        $companyService->markAsInactive($user);
        $ingredientService-

        Auth::logout();
        Session::flush();

        return redirect('/account-deleted');
    }
}
