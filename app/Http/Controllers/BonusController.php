<?php

namespace App\Http\Controllers;

use App\Contracts\Services\BonusService\BonusService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Requests\BonusRequest;
use App\Models\Bonus;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BonusController extends Controller
{
    /**
     * Constructor for BonusController.
     *
     * Initializes the BonusController with instances of BonusService and UserService.
     *
     * @param BonusService $bonusService Instance of BonusService for handling bonus-related operations.
     * @param UserService $userService Instance of UserService for handling user-related operations.
     */
    public function __construct(
        protected BonusService $bonusService,
        protected UserService  $userService
    )
    {
    }


    /**
     * Display a listing of the resource.
     *
     * This function retrieves all bonuses from the database and displays them in a paginated view.
     * It also authorizes the current user to perform the 'viewAny' action before proceeding.
     *
     * @return View Returns a view with a list of bonuses.
     */
    public function index()
    {
        $this->authorizeAction('viewAny');
        $bonuses = $this->bonusService->getAll();
        return view('bonuses.index', compact('bonuses'));
    }


    /**
     * Stores a new bonus record in the database.
     *
     * This function handles the creation of a new bonus record. It first authorizes the current user
     * to perform the 'create' action. Then, it validates the incoming request data using the BonusRequest
     * class. After validation, it creates a new bonus record using the BonusService and redirects the user
     * to the bonuses index page.
     *
     * @param BonusRequest $request The incoming request containing the bonus data.
     *
     * @return RedirectResponse Redirects the user to the bonuses index page.
     */
    public function store(BonusRequest $request)
    {
        $this->authorizeAction('create');
        $this->bonusService->create($request->all());
        return redirect()->route('bonuses.index');
    }


    /**
     * Displays a form for creating a new bonus record.
     *
     * This function authorizes the current user to perform the 'create' action.
     * It then retrieves a list of users who do not have a bonus assigned from the UserService.
     * Finally, it returns a view with a form for creating a new bonus, along with the list of users.
     *
     * @return View Returns a view with a form for creating a new bonus and a list of users.
     */
    public function create()
    {
        $this->authorizeAction('create');
        $users = $this->userService->getUsersWithoutBonus();
        return view('bonuses.create', compact('users'));
    }


    /**
     * Displays the specified bonus record.
     *
     * This function retrieves a bonus record from the database based on the provided Bonus model instance.
     * It authorizes the current user to perform the 'view' action before proceeding.
     * After authorization, it returns a view with the bonus details.
     *
     * @param Bonus $bonus The Bonus model instance representing the bonus record to be displayed.
     *
     * @return View Returns a view with the bonus details.
     */
    public function show(Bonus $bonus)
    {
        $this->authorizeAction('view');
        return view('bonuses.show', compact('bonus'));
    }


    /**
     * Displays a form for editing the specified bonus record.
     *
     * This function authorizes the current user to perform the 'update' action.
     * It then returns a view with a form for editing the specified bonus,
     * passing the bonus model instance as a parameter to the view.
     *
     * @param Bonus $bonus The Bonus model instance representing the bonus record to be edited.
     *
     * @return View Returns a view with the bonus edit form and the bonus model instance.
     */
    public function edit(Bonus $bonus)
    {
        $this->authorizeAction('update');
        return view('bonuses.edit', compact('bonus'));
    }


    /**
     * Updates an existing bonus record in the database.
     *
     * This function handles the update of an existing bonus record. It first authorizes the current user
     * to perform the 'update' action. Then, it validates the incoming request data using the BonusRequest
     * class. After validation, it updates the specified bonus record using the BonusService and redirects the user
     * to the bonus details page.
     *
     * @param BonusRequest $request The incoming request containing the updated bonus data.
     * @param Bonus $bonus The Bonus model instance representing the existing bonus record to be updated.
     *
     * @return RedirectResponse Redirects the user to the bonus details page.
     */
    public function update(BonusRequest $request, Bonus $bonus)
    {
        $this->authorizeAction('update');
        $this->bonusService->update($bonus, $request->all());
        return redirect()->route('bonuses.show', $bonus);
    }


    /**
     * Deletes a bonus record from the database.
     *
     * This function handles the deletion of a bonus record. It first authorizes the current user
     * to perform the 'delete' action. After authorization, it retrieves the ID of the bonus from the
     * provided Bonus model instance and deletes the corresponding record using the BonusService.
     * Finally, it redirects the user to the bonuses index page.
     *
     * @param Bonus $bonus The Bonus model instance representing the bonus record to be deleted.
     *
     * @return RedirectResponse Redirects the user to the bonuses index page.
     */
    public function destroy(Bonus $bonus)
    {
        $this->bonusService->delete($bonus->id);
        return redirect()->route('bonuses.index');
    }
}
