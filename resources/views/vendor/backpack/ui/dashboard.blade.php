@extends(backpack_view('blank'))

@php
    $widgets['after_content'][] = [
        'type'        => 'progress',
        'class'       => 'card text-white bg-primary mb-2',
        'value'       => '11.456',
        'description' => 'Registered users.',
        'progress'    => 57, // integer
        'hint'        => '8544 more until next milestone.',
    ];
@endphp

@section('content')
    <h1></h1>
@endsection
