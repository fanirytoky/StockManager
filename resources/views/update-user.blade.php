@extends('Template.template')
@section('vue')
<div class="card">
    <div class="card-header" id="entete">
        @foreach($user_post as $u)
        <div class="card-title" style="color: white;">Modifier l'utilisateur {{$u->name}}</div>
        @endforeach
    </div>
    <div class="card-body">
        <div class="form-group">
            <form method="POST" action="{{ route('modifUser') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-label for="name" :value="__('Nom')" />
                    @foreach($user_post as $u)
                    <x-input id="idUser" class="form-control" type="hidden" name="idUser" value="{{$u->id}}" required autofocus />
                    <x-input id="name" class="form-control" type="text" name="name" value="{{$u->name}}" required autofocus />
                    @endforeach
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Login')" />
                        @foreach($user_post as $u)
                        <x-input value="{{$u->email}}" id="email" class="form-control" type="email" name="email" required />
                        @endforeach
                    </div>
                    <!-- post_id -->
                    <div class="mt-4">
                        @foreach($user_post as $up)
                        <h5>Poste actuelle:</h5> <p>{{$up->titre_post}}</p>
                        @endforeach
                        <x-label for="post_id" :value="__('Changer Poste')" />
                        <select name="post_id" id="post_id" class="form-select form-control">
                            @foreach($post as $p)
                            <option value="{{$p->id}}">{{$p->titre_post}}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('Mot de passe')" />
                        <x-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirmer mot de passe')" />

                        <x-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
                    </div>
                </div>


                <div class="flex items-center justify-end mt-4">
                    <x-button class="btn btn-success">
                        {{ __('Modifier') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection