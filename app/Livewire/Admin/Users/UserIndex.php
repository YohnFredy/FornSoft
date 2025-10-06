<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserIndex extends Component
{
    use WithPagination, WithoutUrlPagination;

    public $search = '', $searchTerms;
    public $active = '';

    // --- Para roles ---
    public bool $showRoleModal = false;
    public $selectedUser;
    public $selectedRole;

    public function openRoleModal($userId)
    {
        $this->selectedUser = User::findOrFail($userId);
        $this->selectedRole = $this->selectedUser->roles->pluck('name')->first() ?? null;
        $this->showRoleModal = true;
    }

    public function assignRole()
    {
        $this->validate([
            'selectedRole' => 'nullable|string|exists:roles,name',
        ]);

        if ($this->selectedUser->id == 1) {
            session()->flash('success', ' este usuario no se le puede cambiar el rol');
        } else {
            if ($this->selectedUser) {
                if ($this->selectedRole) {
                    // Si selecciona un rol, lo asignamos
                    $this->selectedUser->syncRoles([$this->selectedRole]);
                    session()->flash('success', "Rol '{$this->selectedRole}' asignado al usuario {$this->selectedUser->username}");
                } else {
                    // Si selecciona "Ninguno", quitamos todos los roles
                    $this->selectedUser->syncRoles([]);
                    session()->flash('success', "Se eliminaron todos los roles del usuario {$this->selectedUser->username}");
                }
            }
        }
        $this->showRoleModal = false;
    }

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

    #[Layout('components.layouts.admin')]
    public function render()
    {
        $this->authorize('admin.users.index');

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
            'users' => $users,
            'roles' => Role::all(),
        ]);
    }
}
