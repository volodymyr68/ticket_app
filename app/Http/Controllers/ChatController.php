<?php

namespace App\Http\Controllers;

use App\Contracts\Services\ChatService\ChatService;
use App\Contracts\Services\UserService\UserService;
use App\Http\Requests\ChatRequest;
use App\Models\Chat;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ChatController extends Controller
{
    /**
     * ChatController constructor.
     *
     * Initializes the ChatController with the provided ChatService and UserService instances.
     *
     * @param ChatService $chatService The ChatService instance for managing chat-related operations.
     * @param UserService $userService The UserService instance for managing user-related operations.
     */
    public function __construct(
        protected ChatService $chatService,
        protected UserService $userService
    )
    {
    }


    /**
     * Display a listing of all chats.
     *
     * This function retrieves all chats from the ChatService and displays them in the "chats.index" view.
     *
     * @return View|Factory
     */
    public function index()
    {
        $chats = $this->chatService->getAll();
        return view("chats.index", compact('chats'));
    }


    /**
     * Stores a new chat in the system.
     *
     * This function accepts a ChatRequest object, extracts the data from it, adds the authenticated user's ID as the manager,
     * and then creates a new chat using the ChatService. After the chat is created, the function redirects the user to the
     * chats index page.
     *
     * @param ChatRequest $request The request object containing the chat data.
     * @return RedirectResponse
     */
    public function store(ChatRequest $request)
    {
        $data = $request->all();
        $data['manager_id'] = auth()->user()->id;
        $this->chatService->create($data);
        return redirect()->route('chats.index');
    }


    /**
     * Displays a form to create a new chat.
     *
     * This function retrieves all clients from the UserService and passes them to the "chats.create" view.
     * The view is then rendered with a list of clients to select from when creating a new chat.
     *
     * @return View|Factory
     */
    public function create()
    {
        $clients = $this->userService->getAllClients();
        return view("chats.create", compact('clients'));
    }


    /**
     * Displays the specified chat and its associated messages.
     *
     * This function retrieves a specific chat by its ID, fetches all messages associated with that chat,
     * and then passes both the chat and its messages to the "chats.show" view for display.
     *
     * @param Chat $chat The chat model instance to be displayed.
     * @return View|Factory
     * @return View|Factory The rendered view with the chat and its messages.
     */
    public function show(Chat $chat)
    {
        $messages = $chat->messages;
        return view("chats.show", compact('chat', 'messages'));
    }


    /**
     * Deletes the specified chat from the system.
     *
     * This function accepts a Chat model instance, deletes the chat from the database,
     * and then redirects the user to the chats index page.
     *
     * @param Chat $chat The chat model instance to be deleted.
     * @return RedirectResponse The redirect response to the chats index page.
     */
    public function destroy(Chat $chat)
    {
        $chat->delete();
        return redirect()->route('chats.index');
    }
}
