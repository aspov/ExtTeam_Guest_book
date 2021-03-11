@extends('layouts.admin')

@section('title', 'Guest book')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">{{ __('Messages') }}</h1>
            </div><!-- /.col --> 
        </div>       
    </div><!-- /.container-fluid -->
</div>
    <!-- TO DO List -->      
    <div class="card">    
        <!-- /.card-header -->
        <div class="card-body">       
            @foreach ($messages->sortBy('confirmed')->all() as $message)  
                <ul class="todo-list" data-widget="todo-list">
                    <li>
                        <!-- todo text -->
                        <span class="font-weight-bold">{{ "{$message->name} ({$message->email}) - {$message->created_at}" }}</span>
                        @if ($message->confirmed)
                            <small class="badge badge-success"><i class="far"></i>  {{ __('confirmed') }}</small>
                            @else
                            <small class="badge badge-danger"><i class="far"></i>  {{ __('not confirmed') }}</small>
                        @endif                    
                        <br>
                        <div class="row">
                            <div class="col-10 pb-2">
                                <span>{{ $message->text  }}</span> 
                            </div>                                                
                            <div class="tools col-2">
                                <!-- jquery-ujs -->
                                <a href="{{ route('admin.messages.update', $message) }}" class="fas btn btn-primary btn-sm" data-confirm="Вы уверены?" data-method="put" rel="nofollow"> {{ __('Confirm') }}</a>
                                <a href="{{ route('admin.messages.update', $message) }}" class="fas btn btn-primary btn-sm" data-confirm="Вы уверены?" data-method="delete" rel="nofollow"> {{ __('Delete') }}</a>
                            </div>
                        </div>
                    </li>
                </ul> 
            @endforeach 
        </div> 
    </div>
<div>
    {{ $messages->links() }}
</div>
<!-- /.card -->
@endsection