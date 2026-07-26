<div>
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2 class="card-title h4 mb-0">
                                <i class="bi bi-list-check"></i> Saved Forms
                            </h2>
                            <a href="{{ route('form.builder') }}" class="btn btn-light btn-sm">
                                <i class="bi bi-plus-circle"></i> Create New Form
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        @if($forms->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Form Title</th>
                                            <th>Fields</th>
                                            <th>Submissions</th>
                                            <th>Created</th>
                                            <th>Last Submission</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($forms as $form)
                                            <tr>
                                                <td>
                                                    <strong>{{ $form->title }}</strong>
                                                </td>
                                                <td>
                                                    <span class="badge bg-info">{{ $form->fields_count }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge bg-success">{{ $form->submissions_count }}</span>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        {{ $form->created_at->format('M j, Y') }}
                                                    </small>
                                                </td>
                                                <td>
                                                    <small class="text-muted">
                                                        @if($form->submissions_count > 0)
                                                            {{ $form->submissions->last()->created_at->format('M j, Y g:i A') }}
                                                        @else
                                                            No submissions
                                                        @endif
                                                    </small>
                                                </td>
                                                <td>
                                                    <div class="btn-group btn-group-sm">
                                                        <a href="{{ route('form.display', $form->id) }}" 
                                                           class="btn btn-outline-primary" 
                                                           target="_blank"
                                                           title="View Form">
                                                            <i class="bi bi-eye"></i>
                                                        </a>
                                                        <a href="{{ route('form.builder') }}?edit={{ $form->id }}" 
                                                           class="btn btn-outline-secondary"
                                                           title="Edit Form">
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <button type="button" 
                                                                wire:click="duplicateForm({{ $form->id }})"
                                                                class="btn btn-outline-info"
                                                                title="Duplicate Form">
                                                            <i class="bi bi-copy"></i>
                                                        </button>
                                                        <button type="button" 
                                                                wire:click="deleteForm({{ $form->id }})"
                                                                class="btn btn-outline-danger"
                                                                onclick="return confirm('Are you sure you want to delete this form? All submissions will be lost.')"
                                                                title="Delete Form">
                                                            <i class="bi bi-trash"></i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Cards View for Mobile -->
                            <div class="d-lg-none mt-4">
                                @foreach($forms as $form)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $form->title }}</h5>
                                            <div class="d-flex justify-content-between mb-2">
                                                <small class="text-muted">
                                                    <i class="bi bi-input-cursor"></i> {{ $form->fields_count }} fields
                                                </small>
                                                <small class="text-muted">
                                                    <i class="bi bi-inbox"></i> {{ $form->submissions_count }} submissions
                                                </small>
                                            </div>
                                            <div class="d-flex justify-content-between mb-3">
                                                <small class="text-muted">
                                                    Created: {{ $form->created_at->format('M j, Y') }}
                                                </small>
                                            </div>
                                            <div class="btn-group w-100">
                                                <a href="{{ route('form.display', $form->id) }}" 
                                                   class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-eye"></i> View
                                                </a>
                                                <a href="{{ route('form.builder') }}?edit={{ $form->id }}" 
                                                   class="btn btn-outline-secondary btn-sm">
                                                    <i class="bi bi-pencil"></i> Edit
                                                </a>
                                                <button type="button" 
                                                        wire:click="duplicateForm({{ $form->id }})"
                                                        class="btn btn-outline-info btn-sm">
                                                    <i class="bi bi-copy"></i> Copy
                                                </button>
                                                <button type="button" 
                                                        wire:click="deleteForm({{ $form->id }})"
                                                        class="btn btn-outline-danger btn-sm"
                                                        onclick="return confirm('Delete this form?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="bi bi-inbox display-1 text-muted"></i>
                                </div>
                                <h4 class="text-muted">No Forms Created Yet</h4>
                                <p class="text-muted mb-4">Start by creating your first dynamic form</p>
                                <a href="{{ route('form.builder') }}" class="btn btn-primary btn-lg">
                                    <i class="bi bi-plus-circle"></i> Create Your First Form
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Stats -->
                @if($forms->count() > 0)
                    <div class="row mt-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $forms->count() }}</h4>
                                            <span>Total Forms</span>
                                        </div>
                                        <i class="bi bi-list-check display-6 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $forms->sum('submissions_count') }}</h4>
                                            <span>Total Submissions</span>
                                        </div>
                                        <i class="bi bi-inbox display-6 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $forms->sum('fields_count') }}</h4>
                                            <span>Total Fields</span>
                                        </div>
                                        <i class="bi bi-input-cursor display-6 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-warning text-white">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h4 class="mb-0">{{ $forms->where('submissions_count', '>', 0)->count() }}</h4>
                                            <span>Active Forms</span>
                                        </div>
                                        <i class="bi bi-check-circle display-6 opacity-50"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>