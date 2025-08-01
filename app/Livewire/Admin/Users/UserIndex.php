<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use App\Models\UserActivation;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class UserIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '', $searchTerms;
    public $active = '';


    public function deactivate($id)
    {
        User::findOrFail($id)?->activation?->update([
            'is_active' => 0,
        ]);
    }

    public function activate($id)
    {
        $user = User::findOrFail($id);

        $user->activation
            ? $user->activation->update(['is_active' => 1])
            : $user->activation()->create(['is_active' => 1]);
    }


    public function searchEnter()
    {
        if (empty(trim($this->search))) {
            $this->clearSearch();
        } else {
            $this->searchTerms = array_filter(explode(' ', $this->search));
            $this->resetPage();
        }
    }

    public function clearSearch()
    {
        $this->search = '';
        $this->searchTerms = [];
        $this->resetPage();
    }

    public function render()
    {
        $users = User::query();

        if (!empty($this->searchTerms)) {
            foreach ($this->searchTerms as $term) {
                $users->where(function ($query) use ($term) {
                    $query->where('username', 'like', '%' . $term . '%')
                        ->orWhere('name', 'like', '%' . $term . '%')
                        ->orWhere('last_name', 'like', '%' . $term . '%')
                        ->orWhere('dni', 'like', '%' . $term . '%')
                        ->orWhere('email', 'like', '%' . $term . '%')
                        ->orWhereHas('userData', function ($q) use ($term) {
                            $q->where('phone', 'like', '%' . $term . '%');
                        });
                });
            }
        }

        $users = $users->orderBy('id', 'desc')->paginate(10);

        return view('livewire.admin.users.user-index', [
            'users' => $users
        ]);
    }
}
