@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Loger Viewer') }}</div>

        <div  id="result" class="card-body">

        </div>
        </div>
    </div>



    <div style="margin-top: 20px; text-align: center">
        <a href="javascript:void(0)" class="first"> first</a>
        <a href="javascript:void(0)" class="next">  next</a>
        <a href="javascript:void(0)" class="prev"> perious</a>
        <a href="javascript:void(0)" class="last"> last</a>

    </div>
</div>
@endsection


@section('script')

<script>




    // to handle next / previous /first / last
    var i = 0;
    var limit = {{$limit}} ;

    $('.first').on('click', function(){
                    console.log(i);
                    create (i);

                })

                $('.next').on('click', function(){
                    i = i + limit;
                    create (i);

                })

                $('.prev').on('click', function(){
                    i = i - limit;
                    if(i <= 0 ) i = 0 ;
                    create (i);
                })

                $('.last').on('click', function(){
                    i = {{$lines}} - limit;
                    create (i);

                })


// ajax call to ready from a file by start line
    function create (start) {
        document.getElementById("result").innerHTML = "..." ;
    $.ajax({
        url:"{{ url('log') }}"+"/"+start,    //the page containing php script
        type: "get",    //request type,
        success:function(result){
            console.log(result);
            document.getElementById("result").innerHTML = result
        }
    });
    }
// to load first chuck to the page
$(document).ready(function() {
    create ( i) ;
  });

</script>


@endsection






