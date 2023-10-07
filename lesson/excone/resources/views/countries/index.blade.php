@extends('layouts.app')

@section('title','Index Page')

@section('content')

    <h1>Index Page</h1>

    <div class="col-md-12 mb-3">
        <a href="{{route('countries.create')}}" class="btn btn-primary btn-sm rounded-0"> Create New Country</a>
    </div>

    <div class="col-md-12">
        <table id="mydata" class="table table-sm table-hover border">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Capital</th>
                    <th>Currency</th>
                    <th>User Id</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($countries as $idx=>$country)
                <tr>
                    <td>{{++$idx}}</td> {{-- ဒါဆို db ကidမဟုတ်တော့ဘူး ဒီတိုင်း1,2,3ပဲပြမှာ --}}
                    <td><a href="{{route('countries.show',$country->id)}}">{{$country->name}}</a></td>
                    <td>{{$country->capital}}</td>
                    <td>{{$country->currency}}</td>
                    <td>{{$country->user_id}}</td>
                    <td>{{$country->created_at}}</td>
                    <td>{{$country->updated_at}}</td>
                    <td>
                        <a href="{{route('countries.edit',$country->id)}}" class="text-info me-3"><i class="fas fa-pen"></i></a>
                        <form action="{{route('countries.destroy',$country->id)}}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="btn btn-danger btn-sm rounded-0"><i class="fas fa-trash-alt"></i></button>
                        </form>
                        {{-- <a href="{{route('countries.delete',$country->id)}}" class="text-danger"><i class="fas fa-trash-alt"></i></a> --}}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection
