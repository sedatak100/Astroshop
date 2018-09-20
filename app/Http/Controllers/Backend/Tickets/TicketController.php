<?php

namespace App\Http\Controllers\Backend\Tickets;

use App\Model\Tickets\Ticket;
use App\Model\Tickets\TicketReply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Destek Yönetimi', 'link' => ''],
            ['name' => 'Gelenler', 'link' => '']
        ]);

        $blade = [];

        $tickets = Ticket::orderBy('created_at', 'DESC')
            ->paginate(15);
        $blade['tickets'] = $tickets;

        return view('backend.tickets.ticket_lists', $blade);
    }

    public function view($id)
    {
        $ticket = Ticket::findOrFail($id);

        view()->share('breadcrumbs', [
            ['name' => 'Destek Yönetimi', 'link' => ''],
            ['name' => 'Gelenler', 'link' => route('backend.ticket.lists')],
            ['name' => '#' . $ticket->id(), 'link' => '']
        ]);

        $blade = [];
        $blade['ticket'] = $ticket;

        return view('backend.tickets.ticket_view', $blade);
    }

    public function replyAdded($ticket_id, Request $request)
    {

        $ticket = Ticket::findOrFail($ticket_id);

        $request->validate([
            'message' => 'required|string|min:15',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id(),
            'customer_id' => 0,
            'user_id' => auth('user')->id(),
            'firstname' => auth('user')->user()->firstname,
            'lastname' => auth('user')->user()->lastname,
            'message' => $request->post('message'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $ticket->update([
            'reply' => 1
        ]);

        return redirect()->route('backend.ticket.view', ['id' => $ticket->id()])
            ->with('success', 'Cevap Oluşturulmuştur');
    }

    public function closed($id, Request $request)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'close' => 1
        ]);

        return redirect()->route('backend.ticket.view', ['id' => $ticket->id()])
            ->with('success', 'Ticket Kapatıldı.');
    }
}
