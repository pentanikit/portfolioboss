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

            * {
                box-sizing: border-box
            }

            html,
            body {
                height: 100%
            }

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

            .brand {
                display: flex;
                gap: 10px;
                align-items: center;
                padding: 16px 18px;
                border-bottom: 1px solid var(--border)
            }

            .brand-logo {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: linear-gradient(135deg, var(--brand), var(--brand-2));
                display: grid;
                place-items: center;
                font-weight: 800;
                color: #00110a
            }

            .brand-name {
                font-weight: 800
            }

            .nav {
                padding: 10px
            }

            .nav a {
                display: flex;
                align-items: center;
                gap: 10px;
                padding: 10px 12px;
                border-radius: 10px;
                color: var(--text);
                text-decoration: none
            }

            .nav a.active {
                background: #0f1b2a
            }

            .content {
                display: flex;
                flex-direction: column
            }

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

            .search {
                flex: 1;
                display: flex;
                align-items: center;
                gap: 8px;
                background: #0e1620;
                border: 1px solid var(--border);
                border-radius: 10px;
                padding: 8px 10px
            }

            .search input {
                flex: 1;
                background: transparent;
                border: 0;
                outline: 0;
                color: var(--text)
            }

            .actions {
                display: flex;
                gap: 10px;
                align-items: center
            }

            .btn {
                background: var(--brand);
                color: #00110a;
                border: 0;
                padding: 10px 12px;
                border-radius: 10px;
                font-weight: 700;
                cursor: pointer
            }

            .icon-btn {
                border: 1px solid var(--border);
                background: #121c28;
                color: var(--text);
                padding: 8px 10px;
                border-radius: 10px;
                cursor: pointer
            }

            .main {
                padding: 18px;
                display: grid;
                gap: 18px
            }

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

            .stat {
                display: flex;
                align-items: center;
                justify-content: space-between
            }

            .stat .kpi {
                font-size: 1.6rem;
                font-weight: 800
            }

            .stat .label {
                color: var(--muted);
                font-size: .9rem
            }

            .trend {
                display: flex;
                gap: 8px;
                align-items: center;
                color: #9fe7c5
            }

            .grid-3 {
                display: grid;
                grid-template-columns: 1fr 1fr 1fr;
                gap: 16px
            }

            .table {
                width: 100%;
                border-collapse: separate;
                border-spacing: 0
            }

            .table th,
            .table td {
                padding: 10px 12px;
                text-align: left;
                border-bottom: 1px solid var(--border)
            }

            .table th {
                font-size: .9rem;
                color: var(--muted);
                font-weight: 600
            }

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
                background: rgba(0, 0, 0, .5);
                z-index: 50;
            }

            /* Responsive tweaks */
            @media (max-width:1100px) {
                .grid-4 {
                    grid-template-columns: repeat(2, 1fr)
                }

                .grid-3 {
                    grid-template-columns: 1fr
                }
            }

            @media (max-width:720px) {
                .layout {
                    grid-template-columns: 1fr
                }

                /* no fixed sidebar */
                .sidebar {
                    position: fixed;
                    top: 0;
                    left: -260px;
                    width: 240px;
                    height: 100%;
                    z-index: 100;
                }

                .sidebar.open {
                    left: 0
                }

                .overlay.show {
                    display: block
                }
            }

            @media (max-width:480px) {
                .layout {
                    grid-template-columns: 1fr
                }

                .sidebar {
                    position: fixed;
                    top: 0;
                    left: -260px;
                    width: 240px;
                    height: 100%;
                    z-index: 100;
                }

                .sidebar.open {
                    left: 0
                }

                .topbar {
                    flex-wrap: wrap
                }

                .search {
                    flex: 1 1 100%;
                    margin-bottom: 10px
                }

                .actions {
                    flex: 1 1 100%;
                    justify-content: flex-end
                }

                .grid-4,
                .grid-3,
                .kanban {
                    grid-template-columns: 1fr
                }

                .table th,
                .table td {
                    font-size: 12px;
                    padding: 6px 8px
                }
            }
        </style>

        <div class="layout">
            <aside class="sidebar" id="sidebar">
                <a class="brand" href="{{ route('dashboard') }}">
                    <div class="brand-logo">R</div>
                    <div class="brand-name">Raquibul Islam</div>
                </a>
                <nav class="nav">
                    <a href="#" class="active"><span>🏠</span><span>Overview</span></a>
                    <a href="{{ route('blog') }}"><span>🚀</span><span>Blog</span></a>
                    <a href="{{ route('gallery') }}"><span>📁</span><span>Photo Gallery</span></a>
                    <a href="{{ route('album') }}"><span>📁</span><span>Show Gallery</span></a>
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
                       
                        <a class="btn" href="{{ route('blog') }}" id="newBtn">+ New</a>
                    </div>
                </div>

                <div class="main">
                    <!-- KPIs -->
                    <div class="grid-4">
                        <div class="card">
                            <div class="stat">
                                <div>
                                    <div class="label">Post Count</div>
                                    <div class="kpi" id="kpiRevenue">{{ $allposts->count() }}</div>
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
                                <div class="kanban-col">
                                    <h4>Ideas</h4>
                                    <p>{{ $ideas }}</p>
                                </div>
                                <div class="kanban-col">
                                    <h4>Archived</h4>
                                    <p>{{ $unpublished }}</p>
                                </div>
                                <div class="kanban-col">
                                    <h4>Published</h4>
                                    <p>{{ $allposts->count() }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <h3 class="panel-title">Upcoming Events</h3>
                            <table class="table" id="eventsTable">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Event</th>
                                        <th>Location</th>
                                        <th></th>
                                    </tr>
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
                    <div class="grid-5">
                        <div class="max-w-7xl mx-auto p-6">
                            <div class="flex items-center justify-between mb-4">
                                <h1 class="text-2xl font-semibold">Posts</h1>

                                {{-- Bulk actions --}}
                                <div class="flex items-center gap-2">
                                    <select id="bulkAction" class="border rounded px-3 py-2">
                                        <option value="">Bulk actions…</option>
                                        <option value="unpublish">Unpublish</option>
                                        <option value="delete">Delete</option>
                                    </select>
                                    <button id="applyBulk" class="px-4 py-2 rounded bg-black text-white hover:opacity-90">
                                        Apply
                                    </button>
                                </div>
                            </div>

                            <div class="border rounded-lg" style="max-width: 100%; max-height: 400px; overflow-x: auto; overflow-y:auto;">
                                <table id="postTable" class="min-w-full divide-y divide-gray-200" >
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="w-12 p-3">
                                                <input id="selectAll" type="checkbox" class="h-4 w-4">
                                            </th>
                                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-700">Title</th>
                                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-700">Status</th>
                                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-700">photo</th>
                                            <th class="px-3 py-3 text-left text-sm font-semibold text-gray-700">Published
                                                At</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100 bg-white">

                                        @foreach ($allposts as $post)
                                            <tr data-row-id="{{ $post->id }}">
                                                <td class="p-3">
                                                    <input name="ids[]" value="{{ $post->id }}" type="checkbox"
                                                        class="rowCheck h-4 w-4">
                                                </td>
                                                <td class="px-3 py-3 text-sm text-gray-900">{{ $post->title }}</td>
                                                <td class="px-3 py-3 text-sm">
                                                    <span
                                                        class="inline-flex items-center rounded-full px-2 py-1 text-xs
                                                            {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                                                        {{ ucfirst($post->status) }}
                                                    </span>
                                                </td>
                                                <td class="px-3 py-3 text-sm text-gray-900"><img src="{{ asset('storage') }}/{{ $post->image }}" style="width: 100px; height:80px;" alt="" srcset=""></td>
                                                <td class="px-3 py-3 text-sm text-gray-600">
                                                    {{ $post->created_at->format('Y-m-d H:i') ?: '—' }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {{-- CSRF for fetch --}}
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                        </div>

                        {{-- Minimal JS for multi-select + bulk apply --}}
                        <script>
                            const selectAll = document.getElementById('selectAll');
                            const applyBtn = document.getElementById('applyBulk');
                            const bulkSelect = document.getElementById('bulkAction');

                            selectAll?.addEventListener('change', (e) => {
                                document.querySelectorAll('.rowCheck').forEach(ch => ch.checked = e.target.checked);
                            });

                            applyBtn?.addEventListener('click', async () => {
                                const action = bulkSelect.value;
                                const ids = Array.from(document.querySelectorAll('.rowCheck:checked')).map(i => i.value);

                                if (!action) {
                                    alert('Choose a bulk action.');
                                    return;
                                }
                                if (ids.length === 0) {
                                    alert('Select at least one row.');
                                    return;
                                }

                                if (action === 'delete' && !confirm(
                                        `Delete ${ids.length} post(s)? This can be undone only if SoftDeletes is enabled.`)) return;
                                if (action === 'unpublish' && !confirm(`Unpublish ${ids.length} post(s)?`)) return;

                                try {
                                    const res = await fetch("{{ route('bulkpostdelete') }}", {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                                'content'),
                                            'Accept': 'application/json'
                                        },
                                        body: JSON.stringify({
                                            action,
                                            ids
                                        })
                                    });

                                    const data = await res.json();
                                    if (!res.ok) throw new Error(data.message || 'Request failed');

                                    // Update UI
                                    if (action === 'delete') {
                                        ids.forEach(id => {
                                            const row = document.querySelector(`tr[data-row-id="${id}"]`);
                                            if (row) row.remove();
                                        });
                                    } else if (action === 'unpublish') {
                                        ids.forEach(id => {
                                            const row = document.querySelector(`tr[data-row-id="${id}"]`);
                                            if (!row) return;
                                            const statusCell = row.children[2];
                                            const dateCell = row.children[3];
                                            statusCell.innerHTML =
                                                `<span class="inline-flex items-center rounded-full px-2 py-1 text-xs bg-yellow-100 text-yellow-700">Draft</span>`;
                                            dateCell.textContent = '—';
                                        });
                                    }

                                    // Clear selection
                                    document.querySelectorAll('.rowCheck').forEach(ch => ch.checked = false);
                                    selectAll.checked = false;
                                    bulkSelect.value = '';
                                    alert(data.message || 'Done');

                                } catch (err) {
                                    console.error(err);
                                    alert(err.message || 'Something went wrong');
                                }
                            });
                        </script>
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
        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
        <script src="https://cdn.datatables.net/2.1.5/js/dataTables.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.1.5/css/dataTables.dataTables.min.css">
        <script>
            $(function() {
                $('#postTable').DataTable({
                  
                    pageLength: 25,
                    order: [
                        [1, 'asc']
                    ],
                    columnDefs: [{
                        orderable: false,
                        targets: 0
                    }]
                });
            });
        </script>
    </div>
@endsection
