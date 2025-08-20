<aside class="sidebar">
    <button type="button" class="sidebar-close-btn">
      <iconify-icon icon="radix-icons:cross-2"></iconify-icon>
    </button>
    <div>

    </div>
    <div class="sidebar-menu-area">
        <ul class="sidebar-menu" id="sidebar-menu">
            <li class="sidebar-menu-group-title">Dashboard</li>
            <li>
                <a href="{{ route('topik.dashboard') }}" class="{{ Route::is('topik.dashboard') ? 'active-page' : '' }}">
                    <iconify-icon icon="bxs:dashboard" class="menu-icon"></iconify-icon>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Topik</li>
            <li>
                <a href="{{ route('topik.list') }}" class="{{ Route::is('topik.list') ? 'active-page' : '' }}">
                    <iconify-icon icon="ic:round-topic" class="menu-icon"></iconify-icon>
                    <span>List Topik</span>
                </a>
                <a href="{{ route('topik.form') }}" class="{{ Route::is('topik.form') ? 'active-page' : '' }}">
                    <iconify-icon icon="fluent:slide-topic-add-32-filled" class="menu-icon"></iconify-icon>
                    <span>Tambah Topik</span>
                </a>
            </li>
            <li class="sidebar-menu-group-title">Dataset</li>
            <li>
                <a href="{{ route('topik.form.dataset') }}" class="{{ Route::is('topik.form.dataset') ? 'active-page' : '' }}">
                    <iconify-icon icon="streamline-ultimate:data-file-bars-add-bold" class="menu-icon"></iconify-icon>
                    <span>Tambah Dataset</span>
                </a>
            </li>
        </ul>
    </div>
  </aside>
