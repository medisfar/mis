<div><table class="table border">
    <tr>
<td colspan="4"></td>

    @for($i=1;$i<=5;$i++)
       <td colspan="7">s{{$i}}</td>
    @endfor
</tr>
    @foreach($dc as $lg)
   <tr>
       <td width="100">Activite {{$lg->id}}</td>
       <td>{{$lg->date_debut}}</td>
       <td>{{$lg->date_fin}}</td>
       <td>{{$lg->completed}}%</td>
       @if(true)
        <?php $d=rand(1,20); ?>
        <td style="border-left:red" colspan="{{$d}}" width="2"></td>
        <td colspan="10" width="2" style="background: purple;color: wheat;"></td>
        <td style="border-left:solid 1px red !important" colspan="30-10-$d" width="2"></td>

       @else
       <td colspan="30" width="2"></td>
       @endif


   </tr>
    @endforeach
</div></table>
