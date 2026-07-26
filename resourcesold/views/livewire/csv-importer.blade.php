<div class="card csv-importer">
    <div class="card-header bg-white">
        <h5 class="card-title mb-0">
            <i class="fas fa-file-import me-2"></i> CSV Import
        </h5>
    </div>
    
    <div class="card-body">
        <!-- File Upload -->
        <div class="mb-4">
            <label class="form-label fw-semibold">Upload CSV File</label>
            
            <input type="file" wire:model="file" 
                   class="form-control" 
                   accept=".csv,.txt" />
                   <button class="btn btn-success" wire:click="import">Import</button>
            
            <div class="form-text">
                Supported formats: CSV, TXT. Maximum file size: 10MB
            </div>
            <table>
                <tr>
                <th>Id</th>
                <th>Chef</th>
                <th>Tel</th>
                <th>Long</th>
                <th>lat</th>
                <th>Conjoint(e)</th>
                <th>Localite</th></tr>
                @foreach($dts as $dt )
                <tr>
                    <td>{{$dt['id']}}</td>
                    <td>{{$dt['chef']}}</td>
                    <td>{{$dt['tel']}}</td>
                    <td>{{$dt['long']}}</td>
                    <td>{{$dt['lat']}}</td>
                    <td>{{$dt['conjoint']}}</td>
                    <td>{{$dt['loc']}}</td>

                </tr>
            
@endforeach
            </table>

        </div>
    </div>
    </div>        
           