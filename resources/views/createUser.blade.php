@extends('Template.template')
@section('vue')
<div class="card">
    <div class="card-header">
        <div class="card-title">Crée un utilisateur</div>
    </div>
    <div class="card-body">
        <div class="form-group">
            <form method="POST" action="{{ route('user.Store') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus />

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />

                        <x-input id="email" class="form-control" type="email" name="email" :value="old('email')" required />
                    </div>

                    <!-- post_id -->
                    <div class="form-text-container">
                        <x-label for="post_id" :value="__('post_id')" />
                        <select name="post_id" id="post_id" class="form-select form-control">
                            @foreach($post as $d)
                            <option value="{{$d->id}}">{{$d->titre_post}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Password')" />

                        <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />

                        <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                    </div>
                </div>


                <div class="flex items-center justify-end mt-4">
                    <x-button class="btn btn-success">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection