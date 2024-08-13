<table class="table align-items-center mb-0">
    <thead class="thead-light">
    <tr>
        <th scope="col" class="text-start">No</th>
        <th scope="col">Judul Buku</th>
        <th scope="col" class="text-start">Penulis</th>
        <th scope="col" class="text-start">Penerbit</th>
        <th scope="col" class="text-start">Tahun Terbit</th>
        <th scope="col" class="text-start">Stock Buku</th>
        <th scope="col" class="text-start">Opsi</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($data as $index => $item)
        <tr>
            <td class="text-start">{{ $data->firstItem() + $index }}</td>
            <th scope="row">
                {{ $item->judul_buku}}
            </th>
            <td class="text-start">{{ $item->penulis }}</td>
            <td class="text-start">{{ $item->penerbit }}</td>
            <td class="text-start">{{ $item->tahun_terbit }}</td>
            <td class="text-start">{{ $item->stock }}</td>
            <td class="text-start d-flex column-gap-1">

                <a href="{{ route('historyBuku', $item->id) }}">
                    <button class="btn btn-secondary w500">
                        <span class="btn-label">
                            <i class="fas fa-bars"></i>
                        </span>
                    </button>
                </a>
                <button class="btn btn-info w500" id="book-history"
                        data-id="{{ $item->id }}" data-target="#modalContent">
                    <span class="btn-label">
                        <i class="fas fa-bars"></i>
                    </span>
                </button>
            </td>
    @endforeach
    </tbody>
</table>
<div class="py-2 px-3">
    {{ $data->links() }}
</div>
