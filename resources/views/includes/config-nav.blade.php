<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                @if(auth()->user()->hasGroup('super-admin'))
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="/home">
                    <div class="sb-nav-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#fff" class="bi bi-speedometer2" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"/>
                        <path fill-rule="evenodd" d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"/>
                    </svg>
                    </div>
                    Dashboard
                </a>
                @endif
                <div class="sb-sidenav-menu-heading">Interface</div>
                @if(auth()->user()->hasGroup('super-admin') || auth()->user()->hasPermissionWithWildcards('users.*')  || auth()->user()->hasPermissionWithWildcards('groups.*')  || auth()->user()->hasPermissionWithWildcards('permissions.*'))
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon fw-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentcolor" class="bi bi-layout-three-columns" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13zM1.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5H5V1H1.5zM10 15V1H6v14h4zm1 0h3.5a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5H11v14z"/>
                    </svg>
                    </div>
                    Management
                    <div class="sb-sidenav-collapse-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                    </svg>
                    </div>
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
                    <div class="sb-nav-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-three-columns" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13zM1.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5H5V1H1.5zM10 15V1H6v14h4zm1 0h3.5a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5H11v14z"/>
                    </svg>
                    </div>
                    Report 
                    <div class="sb-sidenav-collapse-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                    </svg>
                    </div>
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
                    <div class="sb-nav-link-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-three-columns" viewBox="0 0 16 16">
                        <path d="M0 1.5A1.5 1.5 0 0 1 1.5 0h13A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 14.5v-13zM1.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5H5V1H1.5zM10 15V1H6v14h4zm1 0h3.5a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5H11v14z"/>
                    </svg>
                    </div>
                    Import/Export
                    <div class="sb-sidenav-collapse-arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-chevron-compact-down" viewBox="0 0 16 16">
                        <path d="M1.553 6.776a.5.5 0 0 1 .67-.223L8 9.44l5.776-2.888a.5.5 0 1 1 .448.894l-6 3a.5.5 0 0 1-.448 0l-6-3a.5.5 0 0 1-.223-.67z"/>
                    </svg>
                    </div>
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