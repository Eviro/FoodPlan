@extends('site.template.siteTemplate')


@section('content')
<link rel="stylesheet" href="{{ asset('styles/shoppinglist.css') }}">
    <h1>Indkøbsliste</h1>

    <table>
        @foreach($componentList as $item => $amount)
            <tr>
                <td><span class="icon glyphicon glyphicon-ok"></span></td>
                <td class="amount">{{ $amount }}</td>
                <td class="divider">X</td>
                <td class="itemName">{{ $item }}</td>
            </tr>


        @endforeach
    </table>
<br><br>
<script>
    /*window.onbeforeunload = function() {
        return "Are you sure you want to navigate away?";
    }*/
</script>
@stop