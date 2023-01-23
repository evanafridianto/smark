@extends('layouts.main')
@section('content')
    <div id="base-style" class="card">
        <!-- .card-body -->
        <div class="card-body">
            <!-- .form -->
            <form method="POST" action="{{ route('category.store') }}">
                @csrf
                @method('post')
                <!-- .fieldset -->
                <div class="form-group">
                    <label>Nama Kategori</label>
                    <input type="text" class="form-control form-control-lg" name="name" placeholder="Nama Kategori"
                        autofocus autocomplete="name" />
                    @error('name')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div><!-- /.form-group -->
                <!-- .form-group -->
                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" placeholder="Deskripsi" class="form-control" rows="4"></textarea>
                    @error('description')
                        <small class="form-text text-danger">{{ $message }}</small>
                    @enderror
                </div><!-- /.form-group -->
                <button type="submit" class="btn btn-info">Save</button>
                <a href="{{ route('category.index') }}" class="btn btn-secondary">Back</a>
            </form><!-- /.form -->
        </div><!-- /.card-body -->
    </div><!-- /.card -->
    <script>
        @if (session('status') == 'category-created')
            bootprompt.alert({
                message: "Category created!",
                title: "Success!",
                size: "small",
                buttons: {
                    ok: {
                        label: "OK",
                        className: "btn-info",
                    },
                },
                callback: (result) => {
                    window.location.href = "{{ route('category.index') }}";
                }
            });
        @endif
    </script>
@endsection
