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
                <button class="btn btn-info w500" id="user-history" data-id="{{ $detail->id }}" data-target="#modalContent">
                    <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                </button>
            </td>
    @endforeach
    </tbody>
</table>
<div class="py-2 px-3">
    {{ $users->links() }}
</div>

<script>
    $(document).ready(function () {
        $(document).on('click', '#user-history', function () {
            var idBuku = $(this).data('id');

            $.ajax({
                url: '/show-table-laporan-user/' + idBuku,
                method: 'GET',
                success: function (response) {
                    $('#modalContent').html(response);
                    $('#detailModal').modal('show');
                },
                error: function (xhr) {
                    console.error('Error:', xhr.responseText);
                    alert('Terjadi kesalahan: ' + xhr.responseText);
                }
            });
        });
    });
</script>
