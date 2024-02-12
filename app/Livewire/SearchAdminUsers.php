<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

class SearchAdminUsers extends Component
{
    #[Url]
    public $search = '';

    public function search()
    {
        $this->resetPage();
    }

    public function render(Request $request)
    {
        $sort = $request->get('sort');

        if (!in_array($sort, ['id', 'name', 'email'])) {
            $sort = 'name';
        }

        $order = $request->get('order');

        if (!in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        return view('livewire.search-admin-users', [
            'admin_users' => User::query()
                ->where('id', 'LIKE', "%$this->search%")
                ->orWhere('name', 'LIKE', "%$this->search%")
                ->orWhere('email', 'LIKE', "%$this->search%")
                ->orderBy($sort, $order)
                ->paginate(3, ['*'], 'page', ''),
        ]);
    }
}
