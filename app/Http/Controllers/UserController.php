<?php

namespace App\Http\Controllers;

use App\Domain\Models\User;
use App\Domain\Services\UserService;
use App\Enums\StatusEnums;
use App\Exceptions\DuplicateUserException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
//        if ($this->userService->exists($request->name)) {
//            return response('', Response::HTTP_OK);
//        }
//
//        $id = $this->userService->store($request->name, $request->email, $request->password);
//        return response('', Response::HTTP_CREATED)
//            ->header('Location', '/api/users/' . $id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->userService->store($request->username, $request->email, $request->password);
        return redirect('/auth');
    }

    public function emailCheck(Request $request)
    {
        $userStatus = $this->userService->checkEmailStatus($request->email);

        switch ($userStatus) {
//            もう登録済みのEmail
            case StatusEnums::USER_EXIST:
                return response('Email is already exist', Response::HTTP_CONFLICT);

//            登録可能なEmail
            case StatusEnums::USER_AVAILABLE:
                return response('This email is usable', Response::HTTP_OK);

//            削除され、登録できないEmail
            case StatusEnums::USER_DELETED:
                return response('This email is exist. but It has been deleted.', Response::HTTP_GONE);

//                その他、予測できないErrorが発生した際
            default:
                return response('An unexpected error occurred', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
//        Log::info($user);
//        return response()->json(['message' => 'success']);
        $this->authorize('edit', $user);
        $user->delete();

        auth()->logout();
        return redirect()->route('index');
    }
}
