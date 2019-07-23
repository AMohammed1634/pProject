@extends('masterView')

@section('header')
    <!--================Home Banner Area =================-->
    <section class="banner_area">
        <div class="banner_inner d-flex align-items-center">
            <div class="container" style="position: relative">
                <div class="banner_content text-center">
                    <h2>{{$user->name}}</h2>
                    <div class="page_link">
                        <a href="{{route('home')}}">Home</a>
                        <a href="{{route('viewProfile',$user->id)}}">{{$user->name}}</a>

                    </div>
                </div>
                <div style="position: absolute; top:100px;right: 0;width:172px;height: 172px;
                border-radius: 50%;">
                    <div class="" >
                        <img src="/storage/profile_images/{{$user->img}}" alt=""
                             style="width: 168px;height: 168px; border-radius: 50%;  border: 4px solid #FFF;" id="img">
                    </div>
                    <style>
                        form{
                            position: absolute;
                            top: 68px;
                            left: 14px;
                            z-index: -1;
                            opacity: 0;
                            display: none;
                        }
                    </style>
                    @if(Auth::check() &&Auth::user()->id === $user->id)
                        <form action="{{route('addImageProfile',$user->id)}}" id="form" method="post" enctype="multipart/form-data">
                            {{csrf_field()}}
                            Select Image <input type="file" name="img" id="file">
                            <input type="submit" value="Change">
                        </form>
                    @endif
                    <script>
                        var file = document.getElementById('file');
                        var img = document.getElementById('img');
                        img.onclick = function () {
                            file.click();
                        }
                        img.onmouseover = function(){
                            img.style.cursor = "pointer";
                            img.style.opacity = 0.5;
                        }
                        img.onmouseleave = function (){
                            img.style.opacity = 1;
                        }
                        file.onchange = function () {
                            console.log(document.getElementById('form'));
                            document.getElementById('form').submit();
                        }
                    </script>
                </div>


            </div>
        </div>
    </section>
    <!--================End Home Banner Area =================-->
@endsection

@section('body')

@endsection