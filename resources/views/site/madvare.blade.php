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
            $('input[type=submit]').before('<label>Navn: </label><input type="text" name="foodNames[]"><br>')
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

        <form action="{{ url('api1/madvare/add/') }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />
            <input type="submit" value="Gem">

        </form>
<button id="addMoreBtn">Tilføj et felt mere</button>
    </div>
    <div class="col-sm-4">
        <h1>Hjælp</h1>
        <p>Her kan du tilføje de enkelte madvare som dine retter består af.</p>
    </div>

</div>








@stop