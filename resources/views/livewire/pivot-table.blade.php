<div>
    {{-- Info Bar --}}
    @if($queryTitle || $recordCount > 0 || $errorMessage)
    <div class="info-bar">
        @if($queryTitle)
            <span class="info-title">📊 {{ $queryTitle }}</span>
        @endif
        
        @if($recordCount > 0)
            <span class="record-badge">{{ $recordCount }} records</span>
        @endif
        
        @if($url)
            <span class="info-url">{{ $url }}</span>
        @endif
        
        @if($isLoading)
            <span class="loading-text">⏳ Loading...</span>
        @endif
        
        @if($errorMessage)
            <span class="error-text">❌ {{ $errorMessage }}</span>
        @endif
    </div>
    @endif

    {{-- Pivot Table Container --}}
    <div id="pivot-container" wire:ignore>
        @if($recordCount == 0 && !$errorMessage && !$isLoading)
            <div class="placeholder">
                <div class="placeholder-icon">📊</div>
                <h3>No data available</h3>
                <p>Load data from a URL</p>
            </div>
        @elseif($errorMessage && !$isLoading)
            <div class="error-box">
                <strong>Error:</strong> {{ $errorMessage }}
            </div>
        @else
            <div class="pivot-loading">Loading pivot table...</div>
        @endif
    </div>
</div>

{{-- Styles --}}
@push('mescss')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/pivottable@2.23.0/dist/pivot.min.css">
    <style>
        .info-bar {
            background: #f8f9fa;
            padding: 10px 16px;
            border-radius: 6px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
            border: 1px solid #e9ecef;
            font-size: 14px;
        }
        .info-title {
            font-weight: 600;
            color: #2d3748;
        }
        .record-badge {
            background: #28a745;
            color: white;
            padding: 2px 12px;
            border-radius: 12px;
            font-size: 12px;
        }
        .info-url {
            color: #6c757d;
            font-size: 12px;
            word-break: break-all;
            max-width: 300px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .loading-text {
            color: #0d6efd;
        }
        .error-text {
            color: #dc3545;
        }
        #pivot-container .pvtUI {
            padding: 15px;
            background: white;
            border-radius: 8px;
            border: 1px solid #e9ecef;
        }
        /* Style for empty pivot table - show all fields as draggable */
        #pivot-container .pvtAxisContainer {
            min-height: 60px;
        }
        #pivot-container .pvtUnused {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 6px;
            border: 2px dashed #dee2e6;
            min-height: 80px;
        }
        #pivot-container .pvtUnused .pvtAttr {
            background: #e9ecef;
            padding: 4px 12px;
            border-radius: 4px;
            margin: 4px;
            cursor: grab;
            font-size: 13px;
            border: 1px solid #ced4da;
        }
        #pivot-container .pvtUnused .pvtAttr:hover {
            background: #dee2e6;
        }
        .placeholder {
            text-align: center;
            padding: 60px 20px;
            color: #6c757d;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        .placeholder-icon {
            font-size: 48px;
            margin-bottom: 16px;
        }
        .placeholder h3 {
            color: #2d3748;
            margin-bottom: 8px;
            font-weight: 600;
        }
        .placeholder p {
            color: #6c757d;
        }
        .pivot-loading {
            text-align: center;
            padding: 30px;
            color: #6c757d;
        }
        .error-box {
            color: #842029;
            background: #f8d7da;
            padding: 12px 16px;
            border-radius: 6px;
            border: 1px solid #f5c2c7;
        }
        /* Instruction text when no rows/cols selected */
        .pvtVals .pvtAttr {
            background: #e9ecef;
            padding: 4px 12px;
            border-radius: 4px;
            margin: 4px;
            cursor: grab;
            font-size: 13px;
            border: 1px solid #ced4da;
        }
        .pvtVals .pvtAttr:hover {
            background: #dee2e6;
        }
    </style>
@endpush

{{-- Scripts --}}
@push('messcripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/pivottable@2.23.0/dist/pivot.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const initialData = @json($pivotData);
            const recordCount = @json($recordCount);
            
            if (recordCount > 0 && initialData && initialData.length > 0) {
                setTimeout(() => {
                    renderPivotTable({
                        data: initialData,
                        title: @json($queryTitle),
                        description: @json($queryDescription),
                        recordCount: recordCount
                    });
                }, 200);
            }

            Livewire.on('analyticsLoaded', (eventData) => {
                console.log('Analytics loaded:', eventData);
                setTimeout(() => {
                    renderPivotTable(eventData);
                }, 200);
            });
        });

        function renderPivotTable(config) {
            const container = $('#pivot-container');
            
            if (!config || !config.data || !Array.isArray(config.data) || config.data.length === 0) {
                if (config && config.error) {
                    container.html(`
                        <div class="error-box">
                            <strong>Error:</strong> ${config.description || 'Failed to load data'}
                        </div>
                    `);
                } else {
                    container.html(`
                        <div class="placeholder">
                            <div class="placeholder-icon">📊</div>
                            <h3>No data available</h3>
                            <p>${config?.title || 'Load data from a URL'}</p>
                        </div>
                    `);
                }
                return;
            }

            container.html('<div class="pivot-loading">⏳ Loading pivot table...</div>');

            // Clean data
            const cleanData = config.data.map(item => {
                const clean = {};
                Object.keys(item).forEach(key => {
                    const value = item[key];
                    if (value === null || value === undefined) {
                        clean[key] = '';
                    } else if (typeof value === 'object' && !Array.isArray(value)) {
                        clean[key] = JSON.stringify(value);
                    } else if (Array.isArray(value)) {
                        clean[key] = value.join(', ');
                    } else {
                        clean[key] = value;
                    }
                });
                return clean;
            });

            // Destroy existing pivot
            try {
                if (container.data('pivotUI')) {
                    container.pivotUI('destroy');
                }
            } catch (e) {}

            const fields = Object.keys(cleanData[0]);
            console.log('Fields detected:', fields);

            try {
                // Render with NO rows, NO cols, NO vals - just show all fields as draggable
                container.pivotUI(cleanData, {
                    rows: [],      // Empty - user drags fields here
                    cols: [],      // Empty - user drags fields here
                    vals: [],      // Empty - user drags fields here
                    aggregatorName: 'Sum',
                    rendererName: 'Table',
                    // Show all fields available
                    unusedAttrsVertical: true,
                    // Show a helpful message
                    onRefresh: function(config) {
                        // Optional: callback when pivot refreshes
                        console.log('Pivot refreshed');
                    }
                });

                // Add a helper message for users
                setTimeout(() => {
                    const unusedArea = container.find('.pvtUnused');
                    if (unusedArea.length && unusedArea.find('.pvtAttr').length > 0) {
                        // If there are fields but no rows/cols selected
                        const hasRows = container.find('.pvtRows .pvtAttr').length > 0;
                        const hasCols = container.find('.pvtCols .pvtAttr').length > 0;
                        const hasVals = container.find('.pvtVals .pvtAttr').length > 0;
                        
                        if (!hasRows && !hasCols && !hasVals) {
                            // Add instruction above the unused fields
                            if (!container.find('.pvt-instruction').length) {
                                container.find('.pvtUnused').before(`
                                    <div class="pvt-instruction" style="
                                        background: #fff3cd;
                                        border: 1px solid #ffc107;
                                        padding: 10px 16px;
                                        border-radius: 6px;
                                        margin-bottom: 10px;
                                        font-size: 14px;
                                        color: #856404;
                                    ">
                                        💡 Drag fields from below to <strong>Rows</strong>, <strong>Columns</strong>, or <strong>Values</strong> to build your pivot table
                                    </div>
                                `);
                            }
                        }
                    }
                }, 100);

            } catch (error) {
                console.error('Pivot rendering error:', error);
                container.html(`
                    <div class="error-box">
                        <strong>Error rendering pivot table</strong>
                        <p style="margin-top:5px;font-size:13px;">${error.message || 'Unknown error'}</p>
                        <p style="font-size:12px;margin-top:8px;color:#6c757d;">
                            Fields: ${fields.join(', ')}
                        </p>
                    </div>
                `);
            }
        }
    </script>
@endpush