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
        <label class="form-label" for="city">Kota</label>
        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="[{{ $detail->city->code }}] {{ $detail->city->name }}" disabled>
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