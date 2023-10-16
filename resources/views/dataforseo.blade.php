@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
              <form action="{{  route('get-rank') }}" method="POST" >
            @csrf
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-6">
                    <label for="search_keyword">Keyword:</label>
                    <input class="form-control" type="text" name="search_keyword" id="search_keyword">
                    <br>
                    <label for="country">Choose Country:</label>
                    <select name="country"  class="form-control">
                        <option value="Paksitan">Pakistan</option>
                        <option value="Usa">USA</option>
                    </select>
                    <br>
                    <label for="device">Choos Device:</label>
                    <select name="device"  class="form-control">
                        <option value="Desktop">Desktop</option>
                        <option value="Mobile">Mobile</option>
                    </select>
                    <br>
                    <label for="repetitions">Set Number of Search:</label>
                    <input type="number" name="repetitions" id="repetitions"  class="form-control">
                    <br>
                    <button type="submit">Submit</button>
                </div>
                <div class="col-md-4"></div>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection

<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
 