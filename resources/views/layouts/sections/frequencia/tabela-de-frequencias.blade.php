<div class="table-responsive text-nowrap table-escala overflow-visible">
  <table class="table table-bordered table-sm table-hover table-striped">
    <thead>
      <tr>
        <th class="text-dark"></th>
        @foreach($escalas as $escala)
          @php
          $dt = explode('/', $escala['data']);
          echo '<th class="text-dark">';
            echo $dt[0].'/'.$dt[1];
          echo '</th>';
          @endphp
        @endforeach
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Presença</td>
        @foreach($escalas as $escala)
          @php
          echo '<td>';
            if(array_key_exists($escala['data'], $frequencias)){
              echo '<span class="text-dark">P</span>';
            }else{
              $data = explode('/', $escala['data']);
              if($data[1] < date('m')){
                echo '<span class="text-danger">F</span>';
              }else{
                echo '<span class="text-muted">-</span>';
              }
            }
          echo '</td>';
          @endphp
        @endforeach
      </tr>
      <tr>
        <td>Leitura</td>
        @foreach($escalas as $escala)
          @php
          echo '<td>';
            if(array_key_exists($escala['data'], $frequencias)){
              if($frequencias[$escala['data']] == 1){
                echo 'Sim';
              }elseif($frequencias[$escala['data']] == '-1'){
                echo '<span class="text-muted">-</span>';
              }else{
                echo '<span class="text-danger">Não</span>';
              }
            }else{
              $data = explode('/', $escala['data']);
              if($data[1] < date('m')){
                echo '<span class="text-danger">F</span>';
              }else{
                echo '<span class="text-muted">-</span>';
              }
            }
          echo '</td>';
          @endphp
          
        @endforeach
      </tr>
    </tbody>
  </table>
</div>