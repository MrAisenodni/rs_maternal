<form class="row g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="result">Judul</label>
        <input type="text" class="form-control @error('result') is-invalid @enderror" id="result" name="result" value="{{ old('result', $detail->result->title) }}" disabled>
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="title">Sub Judul</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $detail->title) }}" disabled>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="d-grid">
                    <a href="{{ $c_menu->url }}" class="btn btn-primary">TAMBAH</a>
                </div>
            </div>
        </div>
    </div>
</form>