<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    // La liste des conversations
    public function index()
    {
        $me = Auth::user();

        if (!$me) return redirect()->route('login');

        // On définit la requête de base selon le rôle
        $query = ($me->role === 'coach') 
            ? User::where('role', 'client') 
            : User::where('role', 'coach');

        // On ajoute le compte des messages non lus envoyés par chaque utilisateur vers MOI
        $users = $query->withCount(['sentMessages as unread_count' => function ($q) use ($me) {
            $q->where('receiver_id', $me->id)
              ->whereNull('read_at');
        }])->get();

        return view('messages.index', compact('users'));
    }

    // Affiche la discussion avec un utilisateur précis
    public function show(User $user)
    {
        $myId = Auth::id();

        // On marque comme lus tous les messages que cet utilisateur m'a envoyés
        Message::where('sender_id', $user->id)
               ->where('receiver_id', $myId)
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        // On récupère aussi la liste des contacts pour la sidebar (avec les badges mis à jour)
        $me = Auth::user();
        $queryContacts = ($me->role === 'coach') 
            ? User::where('role', 'client') 
            : User::where('role', 'coach');

        $users = $queryContacts->withCount(['sentMessages as unread_count' => function ($q) use ($myId) {
            $q->where('receiver_id', $myId)
              ->whereNull('read_at');
        }])->get();

        $messages = Message::where(function($q) use ($user, $myId) {
            $q->where('sender_id', $myId)->where('receiver_id', $user->id);
        })->orWhere(function($q) use ($user, $myId) {
            $q->where('sender_id', $user->id)->where('receiver_id', $myId);
        })->orderBy('created_at', 'asc')->get();

        // On passe $users à la vue pour que la sidebar puisse afficher les badges
        return view('messages.show', compact('messages', 'user', 'users'));
    }

    // Sauvegarde et diffuse le message
    public function store(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'read_at' => null, // Par défaut non lu
        ]);

        broadcast(new MessageSent($message))->toOthers();

        return response()->json($message);
    }
}