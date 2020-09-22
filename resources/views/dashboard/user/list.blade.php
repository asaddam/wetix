@extends('layouts.dashboard')

    @section('content')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8 align-self-center">
                        <h2>Users</h2>
                    </div>
                    {{-- fitur search --}}
                    <div class="col-4">
                        <form action="{{ url('dashboard/users') }}" method="get">
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
                <table class="table table-borderless table-striped table-hover">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Registered</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                {{-- iterasi otomatis per page --}}
                                <th scope="row">{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>{{ $user->updated_at }}</td>
                                {{-- url menggunakan route agar lebih mudah diedit ketika pembaharuan --}}
                                <td><a href="{{ route('dashboard.users.edit', ['id' => $user->id]) }}" title="Edit" class="btn btn-success btn-sm">
                                    <i class="fas fa-pen"></i>
                                </a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- fungsi untuk membuat link iteration scr otomatis & didalamnya trdpat class=pagination --}}
                {{ $users->appends($request)->links() }}

            </div>
        </div>
        
    @endsection
