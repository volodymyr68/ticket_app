<?php

namespace App\Http\Controllers\api;

use App\Contracts\Services\ChatServiceInterface;
use App\Contracts\Services\UserServiceInterface;
use App\Models\Chat;
use App\Services\ChatService;
use App\Services\UserService;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ChatApiController extends BaseApiController
{
    /**
     * ChatApiController constructor.
     *
     * Initializes the ChatApiController with necessary services and checks if the request expects JSON.
     *
     * @param ChatService $chatService The service for managing chats.
     * @param UserService $userService The service for managing users.
     * @param Request $request The incoming request.
     *
     * @throws ResponseFactory|Response
     */
    public function __construct(
        protected ChatServiceInterface $chatService,
        protected UserServiceInterface $userService,
        Request                        $request
    )
    {
        parent::__construct($request);
    }


    /**
     * Retrieves the client's chat and returns it as a JSON response.
     *
     * @return JsonResponse The JSON response containing the client's chat and the client's ID.
     *
     * @throws ResponseFactory|Response
     *     If the request does not expect JSON, an HTTP 406 Not Acceptable response is thrown.
     */
    public function index()
    {
        $chat = $this->chatService->getClientChat();
        return response()->json([$chat, 'client_id' => auth()->user()->id]);
    }


    /**
     * Displays the specified chat resource.
     *
     * Retrieves the specified chat and its associated messages, then returns them as a JSON response.
     *
     * @param Chat $chat The chat resource to be displayed.
     *
     * @return JsonResponse The JSON response containing the chat and its messages, with a HTTP 200 status code.
     *
     * @throws ResponseFactory|Response
     *     If the request does not expect JSON, an HTTP 406 Not Acceptable response is thrown.
     */
    public function show(Chat $chat)
    {
        $messages = $chat->messages;
        return response()->json([$chat, $messages], 200);
    }
}
