@extends('site.template.siteTemplate')

@section('head')

    <link rel="stylesheet" href="{{ url('styles/plan.css') }}">

    @stop





    @section('content')
    <script type="text/javascript">
    $(document).ready(function(){


        function success(data)
        {
            var item = "select[name="+data.timestamp+"]";
            console.log(item);
            $(item).next().after('<span id="notify" class="label label-success">Saved</span>');
            setTimeout(function() {console.log($("#notify").remove())}, 1000);
        }

       $(document.body).on('change','#planSelect',function(){
            
            timestamp = $(this).attr('name');
            dishid = $(this).val();

            data = {'timestamp': timestamp, 'dishid': dishid, _token: '{{ csrf_token() }}'};

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
        <h1>Plan</h1>
            <form action="#" method="post">
            @foreach($dates as $date)




                <select id="planSelect" name="{{ $date->format('U') }}">
                <option value=""></option>
                @foreach($dishes as $dish)

                   
                    


                    <option value="{{ $dish['dishid'] }}"

                     @foreach($currentPlans as $planDate => $plan)

                        @if($planDate == $date->format('d-m-y') && $dish['dishid'] == $plan['dishid'])
                
                        selected="selected"

                        @endif

                    @endforeach

                    >{{ $dish['dishname'] }}</option>

                    @endforeach
                </select>

                    @if($today->format('d-m-y') == $date->format('d-m-y'))

                        <h3 style="color:darkgreen">
                    @else
                        <h3>
                        @endif
                {{ $translate[$date->format('N')] }} {{ $date->format('d-m') }}

                </h3><br>

                @endforeach

            </form>
        </div>
        <div class="col-sm-4">
            <h1>Hjælp</h1>
        </div>

    </div>








@stop
