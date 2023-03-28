<form class="row g-3" action="{{ $c_menu->url }}" method="POST">
    @csrf
    <div class="col-12 mb-2">
        <label class="form-label" for="code">Kode {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ $detail->code }}" disabled>
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="name">Nama {{ $c_menu->title }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $detail->name }}" disabled>
    </div>
    <div class="col-12 mb-2">
        <label class="form-label" for="province">Provinsi</label>
        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="[{{ $detail->province->code }}] {{ $detail->province->name }}" disabled>
    </div>
    <div class="col-12">
        <div class="row">
            <div class="col-12">
                <div class="d-grid">
                    @if ($access->add == 1)
                        <a href="{{ $c_menu->url }}" class="btn btn-primary">TAMBAH</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>