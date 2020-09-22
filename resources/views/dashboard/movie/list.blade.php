@extends('layouts.dashboard')

    @section('content')
        <div class="mb-2">
            <a href="{{ route('dashboard.movies.create') }}" class="btn btn-primary-outline">+ Movie</a>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8 align-self-center">
                        <h2>Movies</h2>
                    </div>
                    {{-- fitur search --}}
                    <div class="col-4">
                        <form action="{{ url('dashboard/movies') }}" method="get">
                            <div class="input-group">
                                <input type="text" name="q" class="form-control form-control-sm" value="{{ $request['q'] ?? ''}}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary btn-sm">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="card-body p-0">
                @if($movies->total())
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Thumbnail</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($movies as $movie)
                            <tr>
                                {{-- iterasi otomatis per page --}}
                                <th scope="row">{{ ($movies->currentPage() - 1) * $movies->perPage() + $loop->iteration }}</th>
                                <td>{{ $movie->title }}</td>
                                <td>
                                    <img src="{{ asset('storage/movies/'.$movie->thumbnail) }}" >
                                </td>
                                {{-- url menggunakan route agar lebih mudah diedit ketika pembaharuan --}}
                                <td><a href="{{ route('dashboard.movies.edit', ['id' => $movie->id]) }}" title="Edit" class="btn btn-success btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- fungsi untuk membuat link iteration scr otomatis & didalamnya trdpat class=pagination --}}
                {{ $movies->appends($request)->links() }}
                @else
                    <h4 class="text-center p-3">Belum ada data movies</h4>
                @endif
            </div>
        </div>
        
    @endsection
