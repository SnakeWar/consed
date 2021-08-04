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
      <td>
          <div class="progress">
              <div class="progress-bar progress-bar-striped" role="progressbar" style="width:  {!! round(($item->votes/$votos->total)*100) !!}%; color: #fff; font-size: 14px;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">{{ $item->votes}}  ({!! round(($item->votes/$votos->total)*100) !!}%)</div>
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