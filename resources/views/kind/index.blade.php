@extends('layouts.app')


@section('content')
    <section class="section">
        <div class="container">
            <h1 style="color:white; font-size: 24px; text-decoration: underline; padding: 0 0 2em 0">List of all spell-<b>kinds</b></h1>
        </div>
        <list-kinds></list-kinds>
    </section>
@endsection
