<form class="row g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="code">Kode {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $detail->code) }}">
        @error('code')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="name">Nama {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $detail->name) }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="province">Provinsi</label>
        <select class="single-select form-control @error('province') is-invalid @enderror" id="province" name="province">
            <option value="">=== SILAHKAN PILIH ===</option>
            @if ($provinces)
                @foreach ($provinces as $item)
                    <option value="{{ $item->id }}" @if ($item->id == old('province', $detail->province_id)) selected @endif>[{{ $item->code }}] {{ $item->name }}</option>
                @endforeach
            @endif
        </select>
        @error('province')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12 text-left">
                <button type="submit" class="btn btn-success">SIMPAN</button>
                @if ($access->add == 1)
                    <a href="{{ $c_menu->url }}" class="btn btn-primary">TAMBAH</a>
                @endif
            </div>
        </div>
    </div>
</form>