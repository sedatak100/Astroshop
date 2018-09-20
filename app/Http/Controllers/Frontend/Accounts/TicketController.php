<?php

namespace App\Http\Controllers\Frontend\Accounts;

use App\Http\Controllers\FrontendController;
use App\Model\Orders\Order;
use App\Model\Tickets\Ticket;
use App\Model\Tickets\TicketReply;
use Illuminate\Http\Request;

class TicketController extends FrontendController
{
    public function lists()
    {
        view()->share('breadcrumbs', [
            ['name' => 'Profilim', 'link' => route('frontend.account.view')],
            ['name' => 'Destek', 'link' => '']
        ]);

        $blade = [];

        $tickets = Ticket::orderBy('created_at', 'DESC')
            ->where('customer_id', auth()->user()->id())
            ->paginate(15);
        $blade['tickets'] = $tickets;

        $orders = Order::orderBy('created_at', 'DESC')
            ->with('orderStatus')
            ->where('order_status_id', '>', '0')
            ->where('customer_id', auth()->user()->id())
            ->limit(30)
            ->get();
        $blade['orders'] = $orders;

        return view('frontend.accounts.ticket_lists', $blade);
    }

    public function view($id)
    {
        $ticket = Ticket::where('customer_id', auth()->user()->id())
            ->findOrFail($id);

        view()->share('breadcrumbs', [
            ['name' => 'Profilim', 'link' => route('frontend.account.view')],
            ['name' => 'Destek', 'link' => route('frontend.account.ticket.lists')],
            ['name' => '#' . $ticket->id(), 'link' => '']
        ]);

        $blade = [];
        $blade['ticket'] = $ticket;

        return view('frontend.accounts.ticket_view', $blade);
    }

    public function added(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'subject' => 'required|string|max:250',
            'message' => 'required|string|min:15',
        ]);

        Ticket::create([
            'customer_id' => auth()->id(),
            'order_id' => $request->post('order_id'),
            'firstname' => auth()->user()->firstname,
            'lastname' => auth()->user()->lastname,
            'email' => auth()->user()->email,
            'gsm' => auth()->user()->gsm,
            'subject' => $request->post('subject'),
            'message' => $request->post('message'),
            'reply' => 0,
            'close' => 0,
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);
        return redirect()->route('frontend.account.ticket.lists')
            ->with('success', 'Destek Talebiniz Oluşturulmuştur');
    }

    public function replyAdded($ticket_id, Request $request)
    {

        $ticket = Ticket::where('close', '!=', 1)
            ->findOrFail($ticket_id);

        $request->validate([
            'message' => 'required|string|min:15',
        ]);

        TicketReply::create([
            'ticket_id' => $ticket->id(),
            'customer_id' => auth()->id(),
            'user_id' => 0,
            'firstname' => auth()->user()->firstname,
            'lastname' => auth()->user()->lastname,
            'message' => $request->post('message'),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent()
        ]);

        $ticket->update([
            'reply' => 0
        ]);

        return redirect()->route('frontend.account.ticket.view', ['id' => $ticket->id()])
            ->with('success', 'Cevap Oluşturulmuştur');
    }
}
