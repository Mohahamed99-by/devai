<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    protected $openAIService;

    public function __construct(\App\Services\OpenAIService $openAIService)
    {
        $this->middleware('auth');
        $this->openAIService = $openAIService;
    }

    public function index()
    {
        $user = auth()->user();
        $conversations = \App\Models\ChatConversation::where('user_id', $user->id)
            ->where('status', 'active')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('chat.index', compact('conversations'));
    }

    public function show($id)
    {
        $user = auth()->user();
        $conversation = \App\Models\ChatConversation::where('user_id', $user->id)
            ->findOrFail($id);

        $messages = $conversation->messages;

        return view('chat.show', compact('conversation', 'messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'conversation_id' => 'nullable|exists:chat_conversations,id'
        ]);

        $user = auth()->user();
        $conversationId = $request->conversation_id;

        // Create a new conversation if needed
        if (!$conversationId) {
            $conversation = \App\Models\ChatConversation::create([
                'user_id' => $user->id,
                'title' => 'Nouvelle conversation',
                'status' => 'active'
            ]);
            $conversationId = $conversation->id;
        } else {
            $conversation = \App\Models\ChatConversation::where('user_id', $user->id)
                ->findOrFail($conversationId);
        }

        // Save user message
        $userMessage = \App\Models\ChatMessage::create([
            'user_id' => $user->id,
            'conversation_id' => $conversationId,
            'role' => 'user',
            'content' => $request->message
        ]);

        // Get conversation history
        $messages = [];

        // Add system message
        $systemPrompt = $this->openAIService->generateSystemPrompt($user);
        $messages[] = ['role' => 'system', 'content' => $systemPrompt];

        // Add previous messages (limit to last 10 for context)
        $previousMessages = \App\Models\ChatMessage::where('conversation_id', $conversationId)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get()
            ->reverse();

        foreach ($previousMessages as $message) {
            $messages[] = [
                'role' => $message->role,
                'content' => $message->content
            ];
        }

        // Generate AI response
        $aiResponse = $this->openAIService->generateChatResponse($messages);

        // Save AI response
        $assistantMessage = \App\Models\ChatMessage::create([
            'user_id' => $user->id,
            'conversation_id' => $conversationId,
            'role' => 'assistant',
            'content' => $aiResponse
        ]);

        // Update conversation title if it's new
        if ($conversation->title === 'Nouvelle conversation') {
            $titlePrompt = "Basé sur ce message: \"{$request->message}\", génère un titre court (5 mots maximum) pour cette conversation. Réponds uniquement avec le titre, sans ponctuation ni guillemets.";

            $titleMessages = [
                ['role' => 'system', 'content' => 'Tu es un assistant qui génère des titres courts et pertinents.'],
                ['role' => 'user', 'content' => $titlePrompt]
            ];

            $title = $this->openAIService->generateChatResponse($titleMessages);
            $title = trim($title);

            // Limit title length
            if (strlen($title) > 50) {
                $title = substr($title, 0, 47) . '...';
            }

            $conversation->update(['title' => $title]);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'message' => $assistantMessage,
                'conversation' => $conversation
            ]);
        }

        return redirect()->route('chat.show', $conversationId);
    }

    public function newConversation()
    {
        $user = auth()->user();

        $conversation = \App\Models\ChatConversation::create([
            'user_id' => $user->id,
            'title' => 'Nouvelle conversation',
            'status' => 'active'
        ]);

        return redirect()->route('chat.show', $conversation->id);
    }

    public function updateTitle(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:50'
        ]);

        $user = auth()->user();
        $conversation = \App\Models\ChatConversation::where('user_id', $user->id)
            ->findOrFail($id);

        $conversation->update(['title' => $request->title]);

        return response()->json(['success' => true]);
    }

    public function archiveConversation($id)
    {
        $user = auth()->user();
        $conversation = \App\Models\ChatConversation::where('user_id', $user->id)
            ->findOrFail($id);

        $conversation->update(['status' => 'archived']);

        return redirect()->route('chat.index')->with('success', 'Conversation archivée avec succès');
    }
}
