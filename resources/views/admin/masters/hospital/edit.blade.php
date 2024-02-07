<form class="row g-3" action="{{ $c_menu->url }}/{{ $detail->id }}" method="POST">
    @method('PUT')
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="name">Nama {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $detail->name) }}">
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="type">Tipe</label>
        <select class="single-select form-control @error('type') is-invalid @enderror" id="type" name="type" @if($access->add == 0) disabled @endif>
            <option value="int" @if (old('type', $detail->type) == 'int') selected @endif>Intervensi</option>
            <option value="tec" @if (old('type', $detail->type) == 'tec') selected @endif>Mentor</option>
            <option value="tem" @if (old('type', $detail->type) == 'tem') selected @endif>Tim E-Learning Muhammadiyah</option>
        </select>
        @error('type')
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