@extends('admin.layout')
@section('content')
<div>
    <style>
        :root {
            --bg: #0b0f15;
            --panel: #101827;
            --muted: #9aa3af;
            --text: #e5e7eb;
            --border: #1f2937;
            --brand: #22c55e;
            --brand-2: #0ea5e9;
            --warn: #f59e0b;
            --danger: #ef4444;
        }

        * { box-sizing: border-box }

        html, body { height: 100% }

        body {
            margin: 0;
            font: 14.5px/1.55 system-ui, -apple-system, "Segoe UI", Roboto, Arial;
            background: var(--bg);
            color: var(--text)
        }

        .layout {
            display: grid;
            grid-template-columns: 260px 1fr;
            min-height: 100vh
        }

        .sidebar {
            background: var(--panel);
            border-right: 1px solid var(--border);
            flex-direction: column;
            transition: left .3s ease;
        }

        .brand { display: flex; gap: 10px; align-items: center; padding: 16px 18px; border-bottom: 1px solid var(--border) }
        .brand-logo { width: 36px; height: 36px; border-radius: 8px; background: linear-gradient(135deg, var(--brand), var(--brand-2)); display: grid; place-items: center; font-weight: 800; color: #00110a }
        .brand-name { font-weight: 800 }

        .nav { padding: 10px }
        .nav a { display: flex; align-items: center; gap: 10px; padding: 10px 12px; border-radius: 10px; color: var(--text); text-decoration: none }
        .nav a.active { background: #0f1b2a }

        .content { display: flex; flex-direction: column }

        .topbar {
            display: flex;
            gap: 12px;
            align-items: center;
            justify-content: space-between;
            padding: 12px 16px;
            border-bottom: 1px solid var(--border);
            background: rgba(0, 0, 0, .2);
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .search { flex: 1; display: flex; align-items: center; gap: 8px; background: #0e1620; border: 1px solid var(--border); border-radius: 10px; padding: 8px 10px }
        .search input { flex: 1; background: transparent; border: 0; outline: 0; color: var(--text) }

        .actions { display: flex; gap: 10px; align-items: center }
        .btn { background: var(--brand); color: #00110a; border: 0; padding: 10px 12px; border-radius: 10px; font-weight: 700; cursor: pointer }
        .icon-btn { border: 1px solid var(--border); background: #121c28; color: var(--text); padding: 8px 10px; border-radius: 10px; cursor: pointer }

        .main { padding: 18px; display: grid; gap: 18px }

        .grid-4 {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 16px
        }

        .card {
            background: var(--panel);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 16px
        }

        .stat { display: flex; align-items: center; justify-content: space-between }

        .stat .kpi { font-size: 1.6rem; font-weight: 800 }

        .stat .label { color: var(--muted); font-size: .9rem }

        .trend { display: flex; gap: 8px; align-items: center; color: #9fe7c5 }

        .grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px
        }

        .table { width: 100%; border-collapse: separate; border-spacing: 0 }

        .table th, .table td {
            padding: 10px 12px;
            text-align: left;
            border-bottom: 1px solid var(--border)
        }

        .table th { font-size: .9rem; color: var(--muted); font-weight: 600 }

        .kanban {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px
        }

        .kanban-col {
            background: #0e1620;
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 10px
        }

        .kanban-col h4 {
            margin: 0 0 10px;
            font-size: .95rem;
            color: var(--muted)
        }

        .kanban-item {
            background: #0f1b2a;
            border: 1px solid var(--border);
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 8px
        }


                /* Overlay for mobile */
        .overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,.5);
            z-index: 50;
        }

        /* Responsive tweaks */
        @media (max-width:1100px) {
            .grid-4 { grid-template-columns: repeat(2, 1fr) }
            .grid-3 { grid-template-columns: 1fr }
        }

        @media (max-width:720px) {
            .layout { grid-template-columns: 1fr } /* no fixed sidebar */
            .sidebar {
                position: fixed;
                top: 0;
                left: -260px;
                width: 240px;
                height: 100%;
                z-index: 100;
            }
            .sidebar.open { left: 0 }
            .overlay.show { display: block }
        }

        @media (max-width:480px) {
            .layout { grid-template-columns: 1fr }
            .sidebar {
                position: fixed;
                top: 0;
                left: -260px;
                width: 240px;
                height: 100%;
                z-index: 100;
            }
            .sidebar.open { left: 0 }
            .topbar { flex-wrap: wrap }
            .search { flex: 1 1 100%; margin-bottom: 10px }
            .actions { flex: 1 1 100%; justify-content: flex-end }
            .grid-4, .grid-3, .kanban { grid-template-columns: 1fr }
            .table th, .table td { font-size: 12px; padding: 6px 8px }
        }
    </style>

    <div class="layout">
        <aside class="sidebar" id="sidebar">
            <div class="brand">
                <div class="brand-logo">R</div>
                <div class="brand-name">Raquibul Islam</div>
            </div>
            <nav class="nav">
                <a href="#" class="active"><span>🏠</span><span>Overview</span></a>
                <a href="{{ route('blog') }}"><span>🚀</span><span>Blog</span></a>
                <a href="{{ route('gallery') }}"><span>📁</span><span>Photo Gallery</span></a>
                <a href="{{ route('logout') }}"><span>📁</span><span>Log out</span></a>
            </nav>
        </aside>
        <!-- Overlay -->
        <div class="overlay" id="overlay"></div>
        <section class="content">
            <div class="topbar">
                <button class="icon-btn" id="menuBtn">☰</button>
                <div class="search"><span>🔎</span><input id="searchInput"
                        placeholder="Search ventures, posts, events…" /></div>
                <div class="actions">
                    <button class="icon-btn" id="themeBtn">🌓</button>
                    <button class="icon-btn" id="notifBtn">🔔</button>
                    <button class="btn" id="newBtn">+ New</button>
                </div>
            </div>

            <div class="main">
                <!-- KPIs -->
                <div class="grid-4">
                    <div class="card">
                        <div class="stat">
                            <div>
                                <div class="label">Post Count</div>
                                <div class="kpi" id="kpiRevenue">{{ $allposts }}</div>
                            </div>
                            <div class="trend">▲ 7.8%</div>
                        </div>
                        <canvas id="sparkRev" height="40"></canvas>
                    </div>
                    <div class="card">
                        <div class="stat">
                            <div>
                                <div class="label">Unpublished</div>
                                <div class="kpi" id="kpiVentures">{{ $unpublished }}</div>
                            </div>
                        </div>
                        <canvas id="sparkVent" height="40"></canvas>
                    </div>
                    <div class="card">
                        <div class="stat">
                            <div>
                                <div class="label">Photos</div>
                                <div class="kpi" id="kpiSubs">{{ $photos }}</div>
                            </div>
                            <div class="trend">▲ 2.1%</div>
                        </div>
                        <canvas id="sparkSubs" height="40"></canvas>
                    </div>
                    <div class="card">
                        <div class="stat">
                            <div>
                                <div class="label">Total visited</div>
                                <div class="kpi" id="kpiReach">{{ $pageVisit }}</div>
                            </div>
                            <div class="trend">▲ 5.3%</div>
                        </div>
                        <canvas id="sparkReach" height="40"></canvas>
                    </div>
                </div>

                <div class="grid-3">
                    <div class="card">
                        <h3 class="panel-title">Content Pipeline</h3>
                        <div class="kanban">
                            <div class="kanban-col"><h4>Ideas</h4><p>{{ $ideas }}</p></div>
                            <div class="kanban-col"><h4>Archived</h4><p>{{ $unpublished }}</p></div>
                            <div class="kanban-col"><h4>Published</h4><p>{{ $allposts }}</p></div>
                        </div>
                    </div>

                    <div class="card">
                        <h3 class="panel-title">Upcoming Events</h3>
                        <table class="table" id="eventsTable">
                            <thead>
                                <tr><th>Date</th><th>Event</th><th>Location</th><th></th></tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    <div class="card">
                        <h3 class="panel-title">Tasks</h3>
                        <div class="list" id="tasksList"></div>
                        <div style="display:flex;gap:8px;margin-top:10px">
                            <input id="taskInput" placeholder="Add a task…"
                                style="flex:1;padding:10px;border-radius:10px;border:1px solid var(--border);background:#0e1620;color:var(--text)">
                            <button class="btn" id="addTaskBtn">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script>
        const menuBtn = document.getElementById('menuBtn');
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            overlay.classList.toggle('show');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('open');
            overlay.classList.remove('show');
        });
    </script>
</div>
@endsection
