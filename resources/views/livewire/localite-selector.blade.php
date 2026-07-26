<div class="row">
    <!-- First Select (Independent) -->
    <x-selectd 
        fd="region_id" 
        :options="$regions" 
        label="Region" 
        nc="3"
    />
    
    <!-- Second Select (Depends on Country) -->
    <x-selectd 
        fd="prefecture_id" 
        :options="$prefectures" 
        label="Prefecture" 
        nc="3"
        dependsOn="region_id"
    />
      <!-- Second Select (Depends on Country) -->
    <x-selectd 
        fd="ssprefecture_id" 
        :options="$ssprefectures" 
        label="Sous Prefecture" 
        nc="3"
        dependsOn="prefecture_id"
    />
    <!-- Third Select (Depends on State) -->
    <x-selectd
    fd="model"
        emitEvent="valueUpdated"
        :options="$localites" 
        label="Localite" 
        nc="3"
        dependsOn="ssprefecture_id"
    />
</div>