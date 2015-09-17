@extends('site.template.siteTemplate')

@section('head')

    <link rel="stylesheet" href="{{ url('styles/plan.css') }}">

    @stop





    @section('content')

   <div class="row">

        <div class="col-sm-8">
        <h1>Plan</h1>
            <form action="#" method="post">
            @foreach($dates as $date)
                <select name="{{ $date->format('d-m-y') }}">
                @foreach($dishes as $dish)

                    <option value="{{ $dish['dishid'] }}">{{ $dish['dishname'] }}</option>

                    @endforeach
                </select>


                <h3>{{ $translate[$date->format('N')] }} {{ $date->format('d-m') }}
                    @if($today->format('d-m-y') == $date->format('d-m-y'))

                        - I dag

                        @endif
                </h3><br>

                @endforeach

            </form>
        </div>
        <div class="col-sm-4">
            <h1>Hjælp</h1>
        </div>

    </div>








@stop
