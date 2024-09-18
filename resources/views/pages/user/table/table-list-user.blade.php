<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col" class="text-start">No</th>
        <th scope="col" class="text-start">Nama User</th>
        <th scope="col" class="text-start">Email</th>
        <th scope="col" class="text-start">Role</th>
        <th scope="col" class="text-start">Opsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($users as $index => $detail)
        <tr>
            <td class="text-start">{{ $users->firstItem() + $index }}</td>
            <td class="text-start">
                {{ $detail->nama}}
            </td>
            <td class="text-start">{{ $detail->email }}</td>
            <td class="text-start"
                style="text-transform: uppercase">{{ $detail->role }}</td>
            <td class="text-start d-flex column-gap-1">
                <a href="{{ route('editUser', $detail->id) }}">
                    <button class="btn btn-warning">
                        <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </a>
                <form action="{{ route('destroyUser', $detail->id)}}" method="post"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger">
                        <span class="btn-label">
                            <i class="fas fa-times"></i>
                        </span>
                    </button>
                </form>
            </td>
    @endforeach
    </tbody>
</table>
<div class="py-2 px-3">
    {{ $users->links() }}
</div>
