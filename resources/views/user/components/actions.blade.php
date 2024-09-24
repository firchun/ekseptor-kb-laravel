<div class="btn-group">
    <button class="btn btn-sm btn-primary" onclick="editCustomer({{ $user->id }})">Edit</button>
    @if (Auth::id() != $user->id)
        <button class="btn btn-sm btn-danger " onclick="deleteCustomers({{ $user->id }})">Delete</button>
    @endif
</div>
