<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if(auth()->user()->hasGroup('super-admin'))
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/home">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                @endif
                <div class="sb-sidenav-menu-heading">Interface</div>
                @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermissionWithWildcards('users.*')  || auth()->user()->hasPermissionWithWildcards('groups.*')  || auth()->user()->hasPermissionWithWildcards('permissions.*'))
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Management
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermissionWithWildcards('users.*'))<a class="nav-link" href="/users/">Users</a>@endif
                        @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermissionWithWildcards('groups.*'))<a class="nav-link" href="/groups">Groups</a>@endif
                        @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermissionWithWildcards('permissions.*'))<a class="nav-link" href="/permissions/">Permissions</a>@endif
                    </nav>
                </div>
                @endif
                @if( auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermission('report'))
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ReportLayouts" aria-expanded="false" aria-controls="ReportLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Report 
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="ReportLayouts" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Call Recording</a>
                        <a class="nav-link" href="#">Call Details</a>
                    </nav>
                </div>
                @endif
                @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermission('import-export'))
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#ImportLayouts" aria-expanded="false" aria-controls="ImportLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Import/Export
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="ImportLayouts" aria-labelledby="headingThree" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="#">Import Data</a>
                        <a class="nav-link" href="#">Export Bulk Recording</a>
                    </nav>
                </div>                
                @endif
                
            </div>
        </div>
        @auth
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ Auth::user()->name }}
        </div>
        @endauth
    </nav>
</div>