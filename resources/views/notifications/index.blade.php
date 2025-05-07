@extends('layouts.app')

@section('title', 'Notifications - Générateur de Fiche Technique')

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Notifications</h1>
            
            @if($notifications->isNotEmpty())
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>
        
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif
        
        @if($notifications->isEmpty())
            <div class="text-center py-8">
                <p class="text-gray-500">Vous n'avez pas de notifications.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($notifications as $notification)
                    <div class="border rounded-lg p-4 {{ $notification->read_at ? 'bg-gray-50' : 'bg-blue-50 border-blue-200' }}">
                        <div class="flex justify-between items-start">
                            <div>
                                <h3 class="font-semibold text-lg">{{ $notification->data['title'] }}</h3>
                                <p class="text-gray-600 mt-1">{{ $notification->data['message'] }}</p>
                                
                                <div class="mt-2 text-sm">
                                    <span class="text-gray-500">
                                        {{ $notification->created_at->diffForHumans() }}
                                    </span>
                                    
                                    @if(isset($notification->data['client_response_id']))
                                        <a href="{{ url('/client-response/' . $notification->data['client_response_id']) }}" class="text-blue-500 hover:text-blue-700 ml-2">
                                            Voir la fiche technique
                                        </a>
                                    @endif
                                </div>
                            </div>
                            
                            @if(!$notification->read_at)
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                    @csrf
                                    <button type="submit" class="text-blue-500 hover:text-blue-700">
                                        Marquer comme lu
                                    </button>
                                </form>
                            @else
                                <span class="text-green-500 text-sm">Lu</span>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="mt-6">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>
@endsection
