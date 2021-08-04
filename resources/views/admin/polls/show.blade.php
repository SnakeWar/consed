@extends('adminlte::page')

@section('title', $title)

@section('content_header')

    <h1>{{$title}}</h1>

    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-address-card"></i> Home</a></li>
      <li class="active">{{$title}}</li>
  </ol>

@stop

@section('content')
  <div class="box">

    <div class="box-header">
      <a onclick="history.go(-1)" class="btn btn-primary"><i class="fa fa-arrow-circle-left"></i> Voltar</a>
    </div>
   
    <div class="box-body">

      <div class="box-header with-border">
        <h3 class="box-title"><strong>Enquete: </strong>{{ $poll->title }} <br />
          <strong>Total de Votos:</strong> @if(isset($votos->total) && $votos->total > 0) {{ $votos->total }} @else 0 @endif</h3>
      </div>
      

      <table class="table table-bordered">
        <thead>
          <tr>
            <th scope="col">Título</th>
            <th scope="col">Votos </th>
            
          </tr>
        </thead>
        <tbody>
           @foreach ($poll->alternatives as $item)
          <tr>            
            <td width="50%"> {{ $item->title }} </td>

            @if(isset($votos->total) && $votos->total > 0)
              <td align="center">
                  {{ $item->votes}} Votos
                  <div class="progress">
                      <div class="progress-bar progress-bar-striped" role="progressbar" style="width:  {!! round(($item->votes/$votos->total)*100) !!}%; color: #fff; font-size: 14px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{!! round(($item->votes/$votos->total)*100) !!}%</div>
                    </div>              
              </td>
            @else
              <td>
                  <div class="progress">
                      <div class="progress-bar progress-bar-striped" role="progressbar" style="width:  0%; color: #fff; font-size: 14px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">0</div>
                    </div>              
              </td>

            @endif
            
          </tr>
           @endforeach
        </tbody>
      </table>
     

     
     


    </div>
    <!-- /.box-body -->
  </div>
@stop
