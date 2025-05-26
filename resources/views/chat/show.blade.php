@extends('layouts.app')

@section('title', 'Conversation - Assistant IA')

@push('styles')
<style>
    .chat-container {
        height: calc(100vh - 300px);
        min-height: 400px;
        background-color: #f9fafb;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23a5b4fc' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        border: 1px solid #e5e7eb;
        border-radius: 0.75rem;
        box-shadow: inset 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        scrollbar-width: thin;
        scrollbar-color: #d1d5db #f3f4f6;
    }

    .chat-container::-webkit-scrollbar {
        width: 8px;
    }

    .chat-container::-webkit-scrollbar-track {
        background: #f3f4f6;
        border-radius: 0.75rem;
    }

    .chat-container::-webkit-scrollbar-thumb {
        background-color: #d1d5db;
        border-radius: 0.75rem;
        border: 2px solid #f3f4f6;
    }

    .message-user {
        background-color: #f3f4f6;
        border-radius: 18px 18px 0 18px;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
        position: relative;
        transition: all 0.2s ease;
    }

    .message-user:hover {
        background-color: #f9fafb;
    }

    .message-assistant {
        background-color: #ede9fe;
        border-radius: 18px 18px 18px 0;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        border: 1px solid #ddd6fe;
        position: relative;
        transition: all 0.2s ease;
    }

    .message-assistant:hover {
        background-color: #f5f3ff;
    }

    .chat-header {
        background: linear-gradient(135deg, #f9fafb 0%, #f3f4f6 100%);
        border-bottom: 1px solid #e5e7eb;
        border-radius: 0.75rem 0.75rem 0 0;
    }

    .ai-icon {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.2), 0 2px 4px -1px rgba(99, 102, 241, 0.1);
    }

    .send-button {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        transition: all 0.3s ease;
    }

    .send-button:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 6px -1px rgba(99, 102, 241, 0.4), 0 2px 4px -1px rgba(99, 102, 241, 0.2);
    }

    .typing-indicator {
        display: inline-flex;
        align-items: center;
    }

    .typing-indicator span {
        height: 8px;
        width: 8px;
        margin: 0 1px;
        background-color: #8b5cf6;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.4;
    }

    .typing-indicator span:nth-child(1) {
        animation: pulse 1s infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation: pulse 1s infinite 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation: pulse 1s infinite 0.4s;
    }

    @keyframes pulse {
        0% {
            opacity: 0.4;
            transform: scale(1);
        }
        50% {
            opacity: 1;
            transform: scale(1.2);
        }
        100% {
            opacity: 0.4;
            transform: scale(1);
        }
    }

    .modal-content {
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 py-6 sm:py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="chat-header p-4 sm:p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center">
                <div class="flex items-center mb-4 sm:mb-0">
                    <a href="{{ route('chat.index') }}" class="mr-3 text-gray-500 hover:text-indigo-600 transition-colors duration-200 p-1 rounded-full hover:bg-indigo-50">
                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                    <div class="ai-icon w-10 h-10 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <h1 class="text-lg sm:text-xl font-bold text-gray-800 conversation-title truncate max-w-[150px] sm:max-w-xs" data-id="{{ $conversation->id }}">{{ $conversation->title }}</h1>
                        <button id="editTitleBtn" class="ml-2 text-gray-400 hover:text-indigo-600 p-1 rounded-full hover:bg-gray-100 transition-colors duration-200">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('chat.new') }}" class="text-indigo-600 hover:text-indigo-800 bg-indigo-50 hover:bg-indigo-100 px-3 py-1.5 rounded-lg text-sm font-medium transition-colors duration-200 flex items-center">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        <span>Nouvelle</span>
                    </a>
                    <form action="{{ route('chat.archive', $conversation->id) }}" method="POST" class="inline-block">
                        @csrf
                        <button type="submit" class="text-gray-600 hover:text-gray-800 bg-gray-100 hover:bg-gray-200 p-1.5 rounded-lg transition-colors duration-200" title="Archiver la conversation">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div id="chat-messages" class="chat-container overflow-y-auto p-4 sm:p-6">
                @foreach($messages as $message)
                    <div class="mb-6 {{ $message->role === 'user' ? 'text-right' : '' }}">
                        <div class="inline-block max-w-[85%] sm:max-w-[75%] px-4 py-3 {{ $message->role === 'user' ? 'message-user' : 'message-assistant' }}">
                            <div class="text-sm sm:text-base {{ $message->role === 'user' ? 'text-gray-800' : 'text-gray-800' }}">
                                {!! nl2br(e($message->content)) !!}
                            </div>
                        </div>
                        <div class="text-xs text-gray-500 mt-1 {{ $message->role === 'user' ? 'text-right' : 'text-left' }} flex {{ $message->role === 'user' ? 'justify-end' : 'justify-start' }}">
                            <span class="inline-flex items-center">
                                <svg class="w-3 h-3 mr-1 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message->created_at->format('H:i') }}
                            </span>
                        </div>
                    </div>
                @endforeach
                <div id="typing-indicator" class="mb-6 hidden">
                    <div class="inline-block max-w-[75%] px-4 py-3 message-assistant">
                        <div class="typing-indicator">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="p-4 sm:p-6 border-t border-gray-100 bg-white">
                <form id="chat-form" action="{{ route('chat.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
                    <div class="flex items-end space-x-2">
                        <div class="flex-1 bg-gray-50 rounded-xl border border-gray-200 focus-within:border-indigo-300 focus-within:ring-2 focus-within:ring-indigo-100 transition-all duration-200">
                            <textarea
                                name="message"
                                id="message-input"
                                class="w-full bg-transparent border-0 rounded-xl px-4 py-3 focus:outline-none resize-none text-sm sm:text-base"
                                placeholder="Tapez votre message ici... (Shift+Entrée pour sauter une ligne)"
                                rows="1"
                                required
                            ></textarea>
                        </div>
                        <button type="submit" class="send-button text-white p-3 rounded-xl hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all duration-200">
                            <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour éditer le titre -->
<div id="editTitleModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="h-full w-full flex items-center justify-center p-4">
        <div class="modal-content bg-white rounded-xl shadow-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-800">Modifier le titre</h2>
                <button type="button" id="cancelEditBtn" class="text-gray-400 hover:text-gray-600 p-1 rounded-full hover:bg-gray-100">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <form id="editTitleForm">
                <div class="mb-4">
                    <label for="titleInput" class="block text-sm font-medium text-gray-700 mb-1">Titre de la conversation</label>
                    <input
                        type="text"
                        id="titleInput"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-300 transition-all duration-200"
                        value="{{ $conversation->title }}"
                        placeholder="Entrez un titre pour cette conversation"
                    >
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" id="cancelEditBtnAlt" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 transition-colors duration-200">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg hover:from-indigo-700 hover:to-purple-700 transition-all duration-200 shadow-sm hover:shadow">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const chatMessages = document.getElementById('chat-messages');
        const chatForm = document.getElementById('chat-form');
        const messageInput = document.getElementById('message-input');
        const typingIndicator = document.getElementById('typing-indicator');
        const editTitleBtn = document.getElementById('editTitleBtn');
        const editTitleModal = document.getElementById('editTitleModal');
        const cancelEditBtn = document.getElementById('cancelEditBtn');
        const editTitleForm = document.getElementById('editTitleForm');
        const titleInput = document.getElementById('titleInput');
        const conversationTitle = document.querySelector('.conversation-title');
        const conversationId = conversationTitle.dataset.id;

        // Scroll to bottom of chat
        chatMessages.scrollTop = chatMessages.scrollHeight;

        // Handle form submission
        chatForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const message = messageInput.value.trim();
            if (!message) return;

            // Add user message to chat
            addMessage('user', message);

            // Clear input
            messageInput.value = '';

            // Show typing indicator
            typingIndicator.classList.remove('hidden');

            // Scroll to bottom
            chatMessages.scrollTop = chatMessages.scrollHeight;

            // Send message to server
            fetch(chatForm.action, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    message: message,
                    conversation_id: conversationId
                })
            })
            .then(response => response.json())
            .then(data => {
                // Hide typing indicator
                typingIndicator.classList.add('hidden');

                // Add assistant message to chat
                addMessage('assistant', data.message.content);

                // Scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            })
            .catch(error => {
                console.error('Error:', error);
                typingIndicator.classList.add('hidden');
            });
        });

        // Function to add message to chat
        function addMessage(role, content) {
            const now = new Date();
            const time = now.getHours().toString().padStart(2, '0') + ':' + now.getMinutes().toString().padStart(2, '0');

            const messageDiv = document.createElement('div');
            messageDiv.className = `mb-4 ${role === 'user' ? 'text-right' : ''}`;

            const messageContent = document.createElement('div');
            messageContent.className = `inline-block max-w-3xl px-4 py-3 ${role === 'user' ? 'message-user' : 'message-assistant'}`;

            const messageText = document.createElement('div');
            messageText.className = `text-sm ${role === 'user' ? 'text-gray-800' : 'text-gray-800'}`;
            messageText.innerHTML = content.replace(/\n/g, '<br>');

            const messageTime = document.createElement('div');
            messageTime.className = `text-xs text-gray-500 mt-1 ${role === 'user' ? 'text-right' : 'text-left'}`;
            messageTime.textContent = time;

            messageContent.appendChild(messageText);
            messageDiv.appendChild(messageContent);
            messageDiv.appendChild(messageTime);

            chatMessages.insertBefore(messageDiv, typingIndicator);
        }

        // Handle title editing
        editTitleBtn.addEventListener('click', function() {
            editTitleModal.classList.remove('hidden');
            setTimeout(() => {
                titleInput.focus();
                titleInput.select();
            }, 100);
        });

        cancelEditBtn.addEventListener('click', function() {
            editTitleModal.classList.add('hidden');
        });

        // Add event listener for the alternative cancel button
        document.getElementById('cancelEditBtnAlt').addEventListener('click', function() {
            editTitleModal.classList.add('hidden');
        });

        editTitleForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const newTitle = titleInput.value.trim();
            if (!newTitle) return;

            // Show loading state
            const submitBtn = this.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Enregistrement...
            `;

            fetch(`/chat/${conversationId}/title`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    title: newTitle
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    conversationTitle.textContent = newTitle;
                    editTitleModal.classList.add('hidden');

                    // Show success notification
                    const notification = document.createElement('div');
                    notification.className = 'fixed bottom-4 right-4 bg-green-50 text-green-800 px-4 py-2 rounded-lg shadow-lg flex items-center';
                    notification.innerHTML = `
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Titre modifié avec succès
                    `;
                    document.body.appendChild(notification);

                    // Remove notification after 3 seconds
                    setTimeout(() => {
                        notification.classList.add('opacity-0');
                        notification.style.transition = 'opacity 0.5s ease';
                        setTimeout(() => {
                            document.body.removeChild(notification);
                        }, 500);
                    }, 3000);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Show error notification
                const notification = document.createElement('div');
                notification.className = 'fixed bottom-4 right-4 bg-red-50 text-red-800 px-4 py-2 rounded-lg shadow-lg flex items-center';
                notification.innerHTML = `
                    <svg class="w-5 h-5 mr-2 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Erreur lors de la modification du titre
                `;
                document.body.appendChild(notification);

                // Remove notification after 3 seconds
                setTimeout(() => {
                    notification.classList.add('opacity-0');
                    notification.style.transition = 'opacity 0.5s ease';
                    setTimeout(() => {
                        document.body.removeChild(notification);
                    }, 500);
                }, 3000);
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;
            });
        });

        // Close modal when clicking outside
        editTitleModal.addEventListener('click', function(e) {
            if (e.target === editTitleModal || e.target.classList.contains('h-full')) {
                editTitleModal.classList.add('hidden');
            }
        });

        // Handle textarea auto-resize and enter key
        messageInput.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        messageInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                chatForm.dispatchEvent(new Event('submit'));
            }
        });
    });
</script>
@endpush
