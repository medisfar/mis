<x-slot name="titre">Donnees {{$donnees[0]->membre->nom??''}}</x-slot>

              <x-slot name="stitre">@include('livewire.datacollect.menu')</x-slot>
<div>
 
     @php
     $dtg=[];
   
     foreach($donnees as $d)
        $dtg[$d->lessession->date_session]=rand(1,10);
    // ⭐ Complex multi-dataset data
    $chartData = [
        'labels' => array_keys($dtg),
        'datasets' => [
            [
                'label' => 'Poids',
                'data' =>array_values($dtg),
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 2,
                'fill' => true,
                'tension' => 0.4
            ]
        ],
        'type' => 'line'
    ];
    
    // ⭐ Custom options
    $options = [
        'responsive' => true,
        'maintainAspectRatio' => true,
        'interaction' => [
            'mode' => 'index',
            'intersect' => false
        ],
        'plugins' => [
            'title' => [
                'display' => true,
                'text' => 'evolutions du poids',
                'font' => ['size' => 18]
            ],
            'legend' => [
                'position' => 'bottom'
            ],
            'tooltip' => [
                'callbacks' => [
                    'label' => 'function(context) {
                        return context.dataset.label + ": $" + context.parsed.y.toLocaleString();
                    }'
                ]
            ]
        ],
        'scales' => [
            'y' => [
                'beginAtZero' => true,
                'title' => [
                    'display' => true,
                    'text' => 'poids (kg)'
                ]
            ]
        ]
    ];
@endphp
<livewire:chart-component 
    :params="[
        'data' => $chartData,
        'options' => $options
    ]" 
/>
    <?php
$fields= \App\Models\Formulaire::find(5)->properties();
?>

<table  class="table table-bordered">
    <tr>
        <th>Session</th>
	@foreach($fields as  $k=>$v)
              <th width="100">{{$v}}</th>
        @endforeach
        </tr>
        
        @foreach($donnees as $donnee)
	<tr>
     
          
    <td>{{$donnee->lessession->date_session}}</td>
    @php $dt=json_decode($donnee->donnes,1)??[]; @endphp
@foreach( $fields as $k=>$v)

	
	<td>{{$dt[$k]??''}}</td>


@endforeach </tr>
@endforeach
</table></div>