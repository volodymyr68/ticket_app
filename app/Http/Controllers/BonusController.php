<?php

namespace App\Http\Controllers;

use App\Contracts\Services\BonusService\BonusService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Requests\BonusRequest;
use App\Models\Bonus;

class BonusController extends Controller
{
    public function __construct(
        protected BonusService $bonusService,
        protected UserService  $userService
    )
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bonuses = $this->bonusService->getAll();
        return view('bonuses.index', compact('bonuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BonusRequest $request)
    {
        $this->bonusService->create($request->all());
        return redirect()->route('bonuses.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = $this->userService->getUsersWithoutBonus();
        return view('bonuses.create', compact('users'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bonus $bonus)
    {
        return view('bonuses.show', compact('bonus'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bonus $bonus)
    {
        return view('bonuses.edit', compact('bonus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BonusRequest $request, Bonus $bonus)
    {
        $this->bonusService->update($bonus, $request->all());
        return redirect()->route('bonuses.show', $bonus);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bonus $bonus)
    {
        $this->bonusService->delete($bonus->id);
        return redirect()->route('bonuses.index');
    }
}
