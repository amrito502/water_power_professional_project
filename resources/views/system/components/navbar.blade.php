  <style>

    .search-container {
        display: flex;
        align-items: center;
        position: relative;
    }

    .search-icon {
        cursor: pointer;
        padding: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #9718D3;
        border-radius: 50%;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        color: white;
        transition: background 0.3s ease;
        border: 1px solid #9f24d9;
    }

    .search-icon:hover {
        background-color: #9f24d9;
    }

    .search-icon svg {
        width: 24px;
        height: 24px;
    }

    .search-input {
        width: 0;
        padding: 0;
        border: none;
        outline: none;
        transition: width 0.3s ease, padding 0.3s ease;
        position: absolute;
        right: 50px; /* Adjusted to move left */
        opacity: 0;
        visibility: hidden;
        border-radius: 20px;
        padding-left: 10px;
        background: white;
        border: 1px solid #ccc;
    }

    .search-input.active {
        width: 394px;
        padding: 9px 20px;
        opacity: 1;
        visibility: visible;
        font-size: 15px;
        color: #4c4949;
        font-weight: 400;
    }
</style>

<nav style="height: 70px;background: #9718D3;" class="navbar navbar-expand navbar-light">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative text-white">
                        <input type="text" class="search-input" id="searchInput" placeholder="Search...">
                        <div class="search-icon" id="searchIcon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                    </div>
                </a>

            </li>

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative text-white">
                        <i class="align-middle" data-feather="bell"></i>
                        <span class="indicator" style="background: #8D44AF">4</span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">4 New Notifications</div>
                    <div class="list-group">
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-danger" data-feather="alert-circle"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Update completed</div>
                                    <div class="text-muted small mt-1">
                                        Restart server 12 to complete the update.
                                    </div>
                                    <div class="text-muted small mt-1">30m ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-warning" data-feather="bell"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Lorem ipsum</div>
                                    <div class="text-muted small mt-1">
                                        Aliquam ex eros, imperdiet vulputate hendrerit et.
                                    </div>
                                    <div class="text-muted small mt-1">2h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-primary" data-feather="home"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">Login from 192.186.1.8</div>
                                    <div class="text-muted small mt-1">5h ago</div>
                                </div>
                            </div>
                        </a>
                        <a href="#" class="list-group-item">
                            <div class="row g-0 align-items-center">
                                <div class="col-2">
                                    <i class="text-success" data-feather="user-plus"></i>
                                </div>
                                <div class="col-10">
                                    <div class="text-dark">New connection</div>
                                    <div class="text-muted small mt-1">
                                        Christina accepted your request.
                                    </div>
                                    <div class="text-muted small mt-1">14h ago</div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle text-white d-inline-block d-sm-none" href="#"
                    data-bs-toggle="dropdown">
                    <i class="align-middle text-white" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle text-white d-none d-sm-inline-block" href="#"
                    data-bs-toggle="dropdown">
                    <img src="{{ asset(auth()->user()->photo) }}" class="avatar img-fluid rounded me-1"
                        alt="Charles Hall" />
                    <span class="text-white">{{ auth()->user()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="pages-profile.html"><i class="align-middle me-1"
                            data-feather="user"></i>
                        Profile</a>

                    <a class="dropdown-item" href="index.html"><i class="align-middle me-1"
                            data-feather="settings"></i>
                        Settings</a>

                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('waterpower_logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Log out</button>
                    </form>

                </div>
            </li>
        </ul>
    </div>
</nav>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchIcon = document.getElementById('searchIcon');
        const searchInput = document.getElementById('searchInput');


        searchIcon.addEventListener('click', function (event) {
            event.stopPropagation();
            searchInput.classList.toggle('active');

            if (searchInput.classList.contains('active')) {
                searchInput.focus();
            }
        });


        document.addEventListener('click', function (event) {
            if (!searchIcon.contains(event.target) && !searchInput.contains(event.target)) {
                searchInput.classList.remove('active');
            }
        });

        searchInput.addEventListener('click', function (event) {
            event.stopPropagation();
        });
    });
</script>
