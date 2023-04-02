<form class="row g-3" action="{{ $c_menu->url }}" method="POST">
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="name">Nama {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        @if ($access->add == 1)
            <div class="d-grid">
                <button type="submit" class="btn btn-success">SIMPAN</button>
            </div>
        @endif
    </div>
</form>