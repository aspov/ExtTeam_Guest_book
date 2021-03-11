@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Message') }}</div>
                <div class="text-center">@include('flash::message')</div>
                <div class="card-body">
                    <form action="{{ route('messages.store') }}" method="POST">
                    @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="name">{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="enter your name" name="name" value = "{{ old('name') ?? '' }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">{{ __('email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="name@example.com" name="email" value = "{{ old('email')  ?? '' }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                            </div>
                        </div>               
                        
                        <div class="form-group">
                            <label for="text">{{ __('Text')}}</label>
                            <textarea class="form-control @error('text') is-invalid @enderror" id="text" name="text" rows="3" >{{ old('text') ?? '' }}</textarea>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror                        
                        </div>
                        <div class="form-group mt-4 mb-4">
                            <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-danger" class="reload" id="reload">
                                    ↻
                                </button>                                    
                            </div>
                        </div>

                        <div class="form-group mb-4">
                            <input id="captcha" type="text" class="form-control @error('captcha') is-invalid @enderror" placeholder="Enter Captcha" name="captcha">
                                @error('captcha')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mb-2">{{ __('Send') }}</button>
                    </form>                    
                </div>
            </div>
            @foreach ($messages->sortByDesc('created_at')->all() as $message)                
                <div class="card-group pt-2">
                    <div class="card" style="max-width: 15rem;">                            
                        <div class="card-body" >
                        <h5 class="card-title"> {{ $message->name }} </h5>
                        <p class="card-text">{{ $message->email }}</p>      
                        </div>
                    </div>
                    <div class="card">                                
                        <div class="card-body">                        
                        <p class="card-text">{{ $message->text }}</p>
                        <p class="card-text"><small class="text-muted">{{ $message->created_at }}</small></p>
                        </div>
                    </div> 
                </div>
            @endforeach 
            <div class="pt-2">
                {{ $messages->links() }}
            </div>
        </div>        
    </div>   
</div>
@endsection
