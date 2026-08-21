@extends('layouts.admin')
@section('title', 'Manage Messages')
@section('header_title', 'Inbox')

@section('content')
<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <h2 class="text-gray-800 font-medium">All Messages</h2>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-500">
            <thead class="bg-gray-50/50 text-gray-700 uppercase font-medium">
                <tr>
                    <th scope="col" class="px-6 py-4">Received</th>
                    <th scope="col" class="px-6 py-4">Name / Email</th>
                    <th scope="col" class="px-6 py-4 min-w-[300px]">Message</th>
                    <th scope="col" class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($messages as $msg)
                <tr class="border-t border-gray-100 {{ $msg->is_read ? 'hover:bg-gray-50/50' : 'bg-blue-50/30' }} transition">
                    <td class="px-6 py-4 whitespace-nowrap">
                        {{ $msg->created_at->diffForHumans() }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900">
                        {{ $msg->name }} <br>
                        <span class="text-xs text-gray-500 font-normal">{{ $msg->email }}</span>
                    </td>
                    <td class="px-6 py-4 text-gray-600">
                        {{ \Str::limit($msg->message, 80) }}
                    </td>
                    <td class="px-6 py-4 flex justify-end gap-2 text-right">
                        <form action="{{ route('messages.destroy', $msg->id) }}" method="POST" onsubmit="return confirm('Delete this message?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded transition">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-400">
                        <i class="fa-regular fa-envelope-open text-3xl mb-3"></i>
                        <p>No messages received yet.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($messages->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $messages->links() }}
    </div>
    @endif
</div>
@endsection
