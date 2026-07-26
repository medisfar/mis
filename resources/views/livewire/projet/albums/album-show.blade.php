<div>
    @if($album)
        {{-- Album Info --}}
        <div class="album-header">
            <h2>{{ $album->titre }}</h2>
            <p><strong>Date:</strong> {{ $album->date_photos ?? 'N/A' }} <strong>Total photos:</strong> {{ $album->photos ? $album->photos->count() : 0 }}</p>
            
        </div>

        {{-- Upload Form --}}
        <div class="upload-section">
            <h4>Ajouter une photo</h4>
            <form wire:submit.prevent="uploadPhoto">
                @csrf
                <div class="upload-form row">
                   <input type="hidden" value="{{$album->id}}" name="album_id">
                    <div class="form-group col-md-6">
                        <label for="description">Description</label>
                        <input type="text" wire:model="description" id="description" class="form-control" placeholder="Description">
                        @error('description') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group  col-md-4">
                        <label for="photo">Photo</label>
                        <input type="file" wire:model="photo" id="photo" class="form-control" accept="image/*" required>
                        @error('photo') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                   
                    <div class="form-group  col-md-2">
                        <label>Action</label>
                        <button type="submit" class="btn btn-primary" >
                            <span ><i class="fas fa-upload"></i> Upload</span>
                            
                        </button>
                    </div>
                </div>
            </form>

            @if(session()->has('message'))
                <div class="alert alert-success mt-3">
                    {{ session('message') }}
                </div>
            @endif
        </div>

        {{-- Photo Grid - 4 Columns --}}
        @if($album->photos && $album->photos->count() > 0)
            <div class="photo-grid">
                @foreach($album->photos as $photo)
                <img src="{{url('/').$photo->url}}">
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-camera" style="font-size: 3rem; display: block; margin-bottom: 15px; color: #94a3b8;"></i>
                <p style="font-size: 1.2rem; color: #64748b;">Aucune photo dans cet album</p>
                <p style="color: #94a3b8;">Utilisez le formulaire ci-dessus pour ajouter des photos</p>
            </div>
        @endif

        {{-- Simple Popup --}}
        
    @else
        <div class="alert alert-danger">
            Album non trouvé
        </div>
    @endif
</div>