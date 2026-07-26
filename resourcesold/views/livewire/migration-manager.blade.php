<div>
    <table>
@foreach($mig as $m)
<tr>
    <td>php artisan migrate:refresh --path="database/migrations/{{$m->migration}}.php"</td>
</tr>
@endforeach
</table>
</div>
