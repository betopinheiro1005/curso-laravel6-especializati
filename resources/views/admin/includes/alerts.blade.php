@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    
    </div>
@endif

{{-- <div class="alert">
    Alert - {{ $content ?? '' }}

</div> --}}