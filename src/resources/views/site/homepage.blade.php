@extends('site.template.siteTemplate')

@section('head')

    <link rel="stylesheet" href="{{ url('styles/plan.css') }}">

@stop





@section('content')
    <script type="text/javascript">
        $(document).ready(function () {


            function success(data) {
                var item = "select[name=" + data.timestamp + "]";
                console.log(item);
                $(item).next().after('<span id="notify" class="label label-success">Saved</span>');
                setTimeout(function () {
                    console.log($("#notify").remove())
                }, 1000);
            }

            $(document.body).on('change', '#planSelect', function () {

                timestamp = $(this).attr('name');
                recipeid = $(this).val();

                data = {'timestamp': timestamp, 'recipeid': recipeid, _token: '{{ csrf_token() }}'};

                console.log(data);


                $.ajax({
                    type: "POST",
                    url: '{{ url("api1/plan/timestamp/save")}}',
                    data: data,
                    success: success
                })

            });


        });
    </script>



    <div class="row">

        <div class="col-sm-8">
            <h1>14 dags plan</h1>

            <form action="#" method="post">
                @foreach($dates as $date)




                    <select id="planSelect" name="{{ $date->format('U') }}">
                           <option value="clear"></option>
                        @foreach($recipes as $recipe)





                            <option value="{{ $recipe->id }}"

                                    @foreach($currentPlans as $planDate => $plan)

                                    @if($planDate == $date->format('d-m-y') && $recipe->id == $plan['recipeid'])

                                    selected="selected"

                                    @endif

                                    @endforeach

                                    >{{ $recipe->displayname }}</option>

                        @endforeach
                    </select>

                    @if($today->format('d-m-y') == $date->format('d-m-y'))

                        <h3 style="color:darkgreen">
                            @else
                                <h3>
                                    @endif
                                    {{ $translate[$date->format('N')] }} {{ $date->format('d/M') }}

                                </h3><br>

                        @endforeach

            </form>

            <a href="{{ url('/shoppinglist/'.$today->format('d-m-y')) }}">Shoppinglist</a>
        </div>
        <div class="col-sm-4">
            <h1>Hjælp</h1>
            Her kan du se din plan for de sidste 7 dage og de næste 7 dage.<br>
            Når du vælger en ret på listen gemmes den automatisk.
        </div>

    </div>








@stop
