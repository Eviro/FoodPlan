@extends('site.template.siteTemplate')

@section('head')

<link rel="stylesheet" href="{{ url('styles/retter.css') }}">

@stop

@section('content')

<!-- Script to dynamically add more fields -->
<script>
    $( document ).ready(function() {

        function addDropdown()
        {
            var string = "<br><select name='dishGoods[]'><option value=''></option>";

            @foreach($goodsList as $good)

                string += "<option value='{{ $good->id }}'>{{ $good->displayname }}</option>";

            @endforeach

            string += '</select>';



            $('#dishGoods').after(string);

        }

    addDropdown();

        $('#addMoreBtn').click(function(e){
            e.preventDefault();
            addDropdown();
        });


    });
</script>


<div class="row">

    <div class="col-sm-8">
        <h1>Retter</h1>
        <h4>Tilføj en ny ret</h4>
        <br><br>

        <form action="{{ url('api1/dish/add/') }}" method="post">
            <input type="hidden" name="_token" value="{{{ csrf_token() }}}" />

            <label>Rettens navn:</label>
            <input type="text" name="dishName">
            <input type="submit" value="Gem">
            <button id="addMoreBtn">Tilføj et felt mere</button>


            <br>
            <label id="dishGoods">Ingredienser:</label><br>





        </form>
    </div>
    <div class="col-sm-4">
        <h1>Hjælp</h1>
    </div>

</div>








@stop
