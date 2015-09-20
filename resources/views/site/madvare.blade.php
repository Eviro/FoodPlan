@extends('site.template.siteTemplate')

@section('head')

<link rel="stylesheet" href="{{ url('styles/madvare.css') }}">

@stop

@section('content')

<!-- Script to dynamically add more fields -->
<script>
    $( document ).ready(function() {

        function addField()
        {
            $('input[type=submit]:first').before('<label>Navn: </label><input type="text" name="foodNames[]"><br>')
        }

        $('#addMoreBtn').click(function(){
            addField();
        });


        addField();

    });
</script>


<div class="row">

    <div class="col-sm-8">
        <h1>Madvare</h1>
        <h4>Tilføj en eller flere nye madvare</h4>
        <br><br>

        <form action="{{ url('api1/good/add/') }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="submit" value="Gem">

        </form>
        <button id="addMoreBtn">Tilføj et felt mere</button>


        <h4>Slet Madvare</h4>
        <br><br>

        <form action="{{ url('api1/good/delete/') }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="submit" value="Slet">
            <select name="goodToDelete">
                @foreach($goods as $good)
                    <option value="{{ $good->id }}">{{ $good->displayname }}</option>
                @endforeach

            </select>
            @if(Session::has('status'))
                {{ session('status')}}
            @endif
        </form>

    </div>
    <div class="col-sm-4">
        <h1>Hjælp</h1>
        <p>Her kan du tilføje de enkelte madvare som dine retter består af.</p>
    </div>

</div>








@stop
