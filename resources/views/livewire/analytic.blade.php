<div>
    {{-- Dropdown --}}
    <div class="dropdown-container">
        <label for="endpoint-select" style="font-weight: 600; margin-right: 10px;">📊 Select Analytics:</label>
        <select 
            id="endpoint-select" 
            wire:model.live="selectedUrl"
            style="padding: 10px 14px; border: 2px solid #e2e8f0; border-radius: 6px; font-size: 14px; background: #f7fafc; cursor: pointer; min-width: 250px;"
        >
            <option value="{{ url('analytics/projects') }}">Project Analytics</option>
            <option value="{{ url('/analytics/sites') }}">Site Analytics</option>
            <option value="{{ url('/api/analytics/groupements') }}">Groupement Analytics</option>
            <option value="{{ url('/api/analytics/activities') }}">Activity Analytics</option>
            <option value="{{ url('/analytics/members') }}">Member Demographics</option>
            <option value="{{ url('/analytics/financial') }}">Financial Analytics</option>
            <option value="{{ url('/analytics/localities') }}">Geographic Analytics</option>
            <option value="{{ url('/analytics/tasks') }}">Task Analytics</option>
            <option value="{{ url('/analytics/dashboard') }}">Dashboard Overview</option>
        </select>
    </div>

    {{-- Child Pivot Table Component --}}
    <livewire:pivot-table :url="$selectedUrl" />


<style>
    .dropdown-container {
        background: #ffffff;
        padding: 16px 20px;
        border-radius: 8px;
        border: 1px solid #e2e8f0;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
</style></div>