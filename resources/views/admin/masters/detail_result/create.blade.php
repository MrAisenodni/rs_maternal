<form class="row g-3" action="{{ $c_menu->url }}" method="POST">
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="result">Judul</label>
        <select class="single-select form-control @error('result') is-invalid @enderror" id="result" name="result" @if($access->add == 0) disabled @endif>
            <option value="">=== SILAHKAN PILIH ===</option>
            @if ($results)
                @foreach ($results as $item)
                    <option value="{{ $item->id }}" @if ($item->id == old('result')) selected @endif>{{ $item->title }}</option>
                @endforeach
            @endif
        </select>
        @error('result')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="title">Sub Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" @if($access->add == 0) disabled @endif>
        @error('title')
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