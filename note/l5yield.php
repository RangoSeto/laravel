// =>yield(,)

@extends('layouts.layout'); //loop မှာ extends က inherit လုပ်တာလို့ယူဆလို့ရ ဟိုဘက်ကဟာကို copy ယူပြီးထည့်တာ



<title>@yield('title')</title>

yield ကိုလှမ်းခေါ်သုံးချင်ရင် section နဲ့သုံး
@section(,);

@section('title','About page');



//ကြားထဲစာတွေအများကြီးထည့်ရေးပေးချင်ရင် ဒီလိုရေးလို့ရ
@section('heading')
    My First Contact Template
@endsection




@section('content')
    <div>
        <h4>This is our company info from Member</h4>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
    </div>

    <hr/>
@stop

//@stopနဲ့ပိတ်လည်းရ

