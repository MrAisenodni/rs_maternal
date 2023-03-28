<form class="g-3" action="{{ $c_menu->url }}" method="POST">
    @csrf
    <div class="row mb-2">
        <div class="col-12 mb-2">
            <label class="form-label" for="code">Kode {{ $c_menu->title }}</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code') }}">
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 mb-2">
            <label class="form-label" for="name">Nama {{ $c_menu->title }}</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col-12 mb-2">
            <label class="form-label" for="city">Kota</label>
            <select class="single-select form-control @error('city') is-invalid @enderror" id="city" name="city">
                <option value="">=== SILAHKAN PILIH ===</option>
                @if ($cities)
                    @foreach ($cities as $item)
                        <option value="{{ $item->id }}" @if ($item->id == old('city')) selected @endif>[{{ $item->code }}] {{ $item->name }}</option>
                    @endforeach
                @endif
            </select>
            @error('city')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($access->add == 1)
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">SIMPAN</button>
                </div>
            @endif
        </div>
    </div>
</form>