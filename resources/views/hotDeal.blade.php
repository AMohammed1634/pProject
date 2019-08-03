@extends('masterView')

@section('header')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container">
                <div class="banner_content text-center">
                    <h2>Add DeatLine To Anew Deal</h2>
                    <div class="page_link">
                        <a href="{{route('home')}}">Home</a>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
@endsection

@section('body')
    <br>
    <div class="form" >
        <div class="container">
            <form method="post" action="/setHotDeal">
                {{csrf_field()}}
                <div class="form-group row">
                    <label for="day" class="col-sm-2 col-form-label">Day</label>
                    <div class="col-sm-4">
                        <input type="number"  class="form-control" name="day" value="">
                    </div>
                    <label for="hour" class="col-sm-2 col-form-label">Hour</label>
                    <div class="col-sm-4">
                        <input type="number"  class="form-control" name="hour" value="">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="min" class="col-sm-2 col-form-label">Minute</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control"  name="min">
                    </div>
                    <label for="sec" class="col-sm-2 col-form-label">Second</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control"  name="sec">
                    </div>
                </div>
                <div class="form-group row">
                    <button type="submit" class="btn btn-primary" style="padding-left: 35px;padding-right: 35px;
                                margin: auto">SET</button>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="form" >
        <div class="container">
            <form method="post" action="/fireDeal" id="fire">
                {{csrf_field()}}
                <?php  $i=0; ?>
                @foreach($deals as $deal)
                    <?php $i++; ?>
                    <div class="form-check" style="margin: auto;">
                        <input class="form-check-input" type="radio" name="deal" id="selectDeal{{$i}}" value="{{$deal->id}}"
                        >
                        <label class="form-check-label" for="selectDeal{{$i}}">
                            {{$deal->day }} Days *//*  {{$deal->hour }} Houre *//* {{$deal->min }} Minute *//*  {{$deal->sec }} Seconds
                        </label>
                    </div>

                @endforeach
                <br>
                <button type="submit" class="btn btn-primary" style="padding-left: 35px;padding-right: 35px;
                                margin: auto">SELECT DEAL</button>
            </form>
            <script>
                var form = document.getElementById('fire');
                form.onsubmit = function () {
                    form.preventDefault();
                    alert("asd");
                    form.submit();
                }
            </script>
        </div>
    </div>
    <br><br>
@endsection
