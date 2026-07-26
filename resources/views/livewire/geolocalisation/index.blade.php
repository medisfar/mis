<x-slot name="titre">Geolocalisation</x-slot>

              <x-slot name="stitre">@include('livewire.projet.menu')</x-slot><div>
  
<x-mtabs :tabs="[
    ['id' => 'regions', 'label' => 'Regions','content'=>'', 'component' => 'geolocalisation.regions.region-liste',
     'params'=>['regions'=>\App\Models\Region::all()]],
    ['id' => 'prefectures', 'label' => 'Prefectures', 'content' =>'','component'=> 'geolocalisation.prefectures.prefecture-liste',
     'params'=>['prefectures'=>\App\Models\Prefecture::all()]], 
      ['id' => 'ssprefectures', 'label' => 'Sous Prefectures', 'content' =>'','component'=> 'geolocalisation.ssprefectures.ssprefecture-liste',
     'params'=>['ssprefectures'=>\App\Models\Ssprefecture::paginate(50)]], 
      ['id' => 'localites', 'label' => 'Localites', 'content' =>'','component'=> 'geolocalisation.localites.localite-liste',
     'params'=>['localites'=>\App\Models\Localite::paginate(50)]],
     ['id' => 'zones', 'label' => 'Zones', 'content' =>'',
     'component'=> 'geolocalisation.zones.zone-liste'],
     
]" />  
</div>