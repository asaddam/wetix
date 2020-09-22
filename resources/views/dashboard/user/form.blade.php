@extends('layouts.dashboard')

    @section('content')
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-8 align-self-center">
                        <h2>Users</h2>
                    </div>
                    {{-- fitur form --}}
                    <div class="col-4 text-right">
                        <button class="btn btn-sm text-secondary" data-toggle="modal" data-target="#deleteModal" >
                            <i class="fas fa-trash"></i>    
                        </button>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        {{-- csrf untuk security --}}
                        <form action="{{ route('dashboard.users.update', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" class="form-control" value="{{ $user->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" value="{{ old('email') ?? $user->email }}">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-0">
                                <button type="button" onclick="window.history.back()" class="btn btn-secondary btn-sm">Cancel</button>
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
{{-- popup delete --}}
        <div class="modal fade" id="deleteModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Delete</h5>
                        <button type="button" class="close" data-dismiss="modal" >&times;</button>

                    </div>
                    <div class="modal-body">
                        <p>Anda yakin ingin menghapus User {{ $user->name }}</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('dashboard.users.delete', ['id' => $user->id]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-sm btn-danger">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
    @endsection
