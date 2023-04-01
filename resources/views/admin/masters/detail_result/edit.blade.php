<form class="row g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="result">Judul</label>
        <select class="single-select form-control @error('result') is-invalid @enderror" id="result" name="result">
            <option value="">=== SILAHKAN PILIH ===</option>
            @if ($results)
                @foreach ($results as $item)
                    <option value="{{ $item->id }}" @if ($item->id == old('result', $detail->result_id)) selected @endif>{{ $item->title }}</option>
                @endforeach
            @endif
        </select>
        @error('result')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="title">Sub Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}">
        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12 text-left">
                <button type="submit" class="btn btn-success">SIMPAN</button>
                <a href="{{ $c_menu->url }}" class="btn btn-primary">TAMBAH</a>
            </div>
        </div>
    </div>
</form>