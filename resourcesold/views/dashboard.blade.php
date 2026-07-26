<x-app-layout>
@push('mescss')
    <style>
        * {
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, sans-serif;
        }
        body {
            background: #f4f7fc;
            padding-bottom: 2rem;
        }
        .dashboard-header {
            background: linear-gradient(135deg, #0b2b3b 0%, #1a4a5f 100%);
            border-radius: 0 0 1.5rem 1.5rem;
            padding: 1.8rem 0 1.5rem 0;
            margin-bottom: 2rem;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
        }
        .project-badge {
            background: rgba(255,255,255,0.15);
            backdrop-filter: blur(4px);
            border-radius: 40px;
            padding: 0.3rem 1rem;
            font-size: 0.8rem;
            font-weight: 500;
        }
        .stat-card {
            border: none;
            border-radius: 1.2rem;
            transition: all 0.2s ease;
            background: white;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.02), 0 2px 4px rgba(0,0,0,0.02);
            border: 1px solid rgba(0,0,0,0.03);
        }
        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.1);
            border-color: rgba(30, 130, 130, 0.15);
        }
        .card-icon {
            font-size: 2rem;
            color: #1e6f5c;
            background: #e9f3f0;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 1rem;
        }
        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            line-height: 1.2;
            color: #1f2e3a;
        }
        .stat-label {
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.03em;
            color: #5f7f8c;
        }
        .progress-custom {
            height: 10px;
            border-radius: 12px;
            background-color: #e2e8f0;
        }
        .progress-custom .progress-bar {
            border-radius: 12px;
            background: #2c9c7c;
        }
        .detail-card {
            border-radius: 1.5rem;
            border: none;
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.03);
            background: white;
            overflow: hidden;
        }
        .kv-row {
            display: flex;
            flex-wrap: wrap;
            border-bottom: 1px solid #edf2f7;
            padding: 0.9rem 0;
            transition: background 0.1s;
        }
        .kv-row:last-child {
            border-bottom: none;
        }
        .kv-key {
            font-weight: 600;
            color: #2c3e44;
            width: 40%;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .kv-value {
            width: 60%;
            color: #1f2e3a;
            font-weight: 500;
            word-break: break-word;
        }
        .badge-custom {
            background: #eef2ff;
            color: #1e5f7a;
            font-weight: 500;
            padding: 0.35rem 0.9rem;
            border-radius: 30px;
            font-size: 0.8rem;
        }
        .footer-note {
            font-size: 0.75rem;
            color: #6c8d9b;
            border-top: 1px solid #e0eef4;
            padding-top: 1.5rem;
            margin-top: 1rem;
            text-align: center;
        }
        @media (max-width: 768px) {
            .stat-value {
                font-size: 1.4rem;
            }
            .kv-key, .kv-value {
                width: 100%;
            }
            .kv-key {
                margin-bottom: 4px;
            }
            .kv-row {
                flex-direction: column;
            }
        }
    </style>
@endpush

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="container">
          
                <!-- ROW 1: primary KPI cards -->
                <div class="row g-4 mb-4">
                    <!-- Completion % -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-percent fs-4"></i></div>
                                    <h6 class="stat-label mb-1">Completion %</h6>
                                    <div class="mt-2"><span class="stat-value">%</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Total Budget -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-cash-stack fs-4"></i></div>
                                    <h6 class="stat-label mb-1">Total Budget (USD)</h6>
                                    <div class="mt-2"><span class="stat-value">$125,000</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Status -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-check-circle-fill fs-4"></i></div>
                                    <h6 class="stat-label mb-1">Status</h6>
                                    <div class="mt-2"><span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 fs-6 fw-semibold">In Progress</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Project Lead -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-person-badge fs-4"></i></div>
                                    <h6 class="stat-label mb-1">SITES</h6>
                                    <div class="mt-2"><span class="stat-value fs-5">5</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW 2: secondary KPI cards -->
                <div class="row g-4 mb-4">
                    <!-- Team Size -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-people-fill fs-4"></i></div>
                                    <h6 class="stat-label mb-1">MENAGES</h6>
                                    <div class="mt-2"><span class="stat-value">200</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Start Date -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-calendar3 fs-4"></i></div>
                                    <h6 class="stat-label mb-1">Start Date</h6>
                                    <div class="mt-2"><span class="stat-value fs-5">Jan 15, 2025</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Date (target) -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-calendar-event fs-4"></i></div>
                                    <h6 class="stat-label mb-1">End Date (target)</h6>
                                    <div class="mt-2"><span class="stat-value fs-5">Sep 30, 2025</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Risk Level -->
                    <div class="col-sm-6 col-md-3">
                        <div class="card stat-card h-100 p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="card-icon mb-3"><i class="bi bi-exclamation-triangle fs-4"></i></div>
                                    <h6 class="stat-label mb-1">Activites en retard</h6>
                                    <div class="mt-2"><span class="badge bg-warning bg-opacity-10 text-warning px-3 py-2 fs-6 fw-semibold">3</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW 3: progress insights -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="card stat-card h-100 p-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="card-icon"><i class="bi bi-pie-chart-fill fs-3"></i></div>
                                    <div>
                                        <h6 class="stat-label mb-0">COMPLETION RATE</h6>
                                        <span class="fw-bold fs-4">68%</span>
                                    </div>
                                </div>
                                <div class="progress progress-custom mt-2">
                                    <div class="progress-bar" style="width: 68%" role="progressbar" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 small text-secondary">
                                    <span><i class="bi bi-check2-circle"></i> Milestones achieved</span>
                                    <span><strong>4/9</strong> · on track</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card stat-card h-100 p-3">
                            <div class="card-body">
                                <div class="d-flex align-items-center gap-3 mb-3">
                                    <div class="card-icon"><i class="bi bi-coin"></i></div>
                                    <div>
                                        <h6 class="stat-label mb-0">BUDGET UTILIZATION</h6>
                                        <span class="fw-bold fs-4">67%</span>
                                    </div>
                                </div>
                                <div class="progress progress-custom mt-2">
                                    <div class="progress-bar bg-info" style="width: 67%" role="progressbar" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="d-flex justify-content-between mt-2 small text-secondary">
                                    <span><i class="bi bi-cash-stack"></i> Spent: <span>$84,200</span></span>
                                    <span><i class="bi bi-piggy-bank"></i> Remaining: <span>$40,800</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ROW 4: FULL key-value pairs (all project attributes) -->
                

                <div class="footer-note">
                    <i class="bi bi-arrow-repeat me-1"></i> Live dashboard · data snapshot reflects current project scope
                </div>
            </div>
        </div>
    </div>
</div>
</x-app-layout>