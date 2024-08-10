<ul class="menu-inner py-1">

    @if(Auth::user()->department==5 && Auth::user()->company_id ==1 )
    <!-- company-select -->

    <li class="menu-item">
        <ul class="menu-sub" style="
        display: flex;
        align-content: center;
        justify-content: center;
        align-items: center;
        flex-wrap: nowrap;
        ">

         @livewire('company.company-select')
       </ul>
     </li>

    <!-- Company -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Company">Company</div>
        </a>
        <ul class="menu-sub">
            <li class="menu-item">
                <a href="{{ route('companies.index') }}" class="menu-link">
                    <div data-i18n="Working">Working</div>
                </a>
            </li>



            <li class="menu-item">
                <a href="{{ route('companies.registerCompanies') }}" class="menu-link">
                    <div data-i18n="Register">Register</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('companies.notWorking') }}" class="menu-link">
                    <div data-i18n="Not Working">Not Working</div>
                </a>
            </li>


        </ul>
    </li>
    @endif

    <!-- Emplys -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Emplys">Emplys</div>
        </a>
        <ul class="menu-sub">


            <li class="menu-item">
                <a href="{{ route('admins') }}" class="menu-link">
                    <div data-i18n="Admins">Admins</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('employs') }}" class="menu-link">
                    <div data-i18n="Employs">Employs</div>
                </a>
            </li>


            <li class="menu-item">
                <a href="{{ route('registerEmploys') }}" class="menu-link">
                    <div data-i18n="Pending Employs">Pending Employs</div>
                </a>
            </li>
        </ul>
    </li>


    <!-- Projects -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Projects">Projects</div>
        </a>
        <ul class="menu-sub">


            <li class="menu-item">
                <a href="{{ route('projects.index') }}" class="menu-link">
                    <div data-i18n="Projects">Projects</div>
                </a>
            </li>


        </ul>
    </li>


    <!-- Tasks -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Tasks">Tasks</div>
        </a>
        <ul class="menu-sub">


            <li class="menu-item">
                <a href="{{ route('tasks.index') }}" class="menu-link">
                    <div data-i18n="Tasks">Tasks</div>
                </a>
            </li>


        </ul>
    </li>


    <!-- Reports -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Reports">Reports</div>
        </a>
        <ul class="menu-sub">


            <li class="menu-item">
                <a href="{{ route('reports.index') }}" class="menu-link">
                    <div data-i18n="Reports">Reports</div>
                </a>
            </li>


        </ul>
    </li>

    <!-- chats -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="chats">chats</div>
        </a>
        <ul class="menu-sub">


            <li class="menu-item">
                <a href="{{ route('crm.chat.index') }}" class="menu-link">
                    <div data-i18n="chats">chats</div>
                </a>
            </li>


        </ul>
    </li>


    <!-- chats -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Location">Location</div>
        </a>
        <ul class="menu-sub">

            <li class="menu-item">
                <a href="{{ route('location.index') }}" class="menu-link">
                    <div data-i18n="Location">Location</div>
                </a>
            </li>


        </ul>
    </li>

    <!-- mettings -->
    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Mettings">Mettings</div>
        </a>
        <ul class="menu-sub">

            <li class="menu-item">
                <a href="{{ route('zoom.index') }}" class="menu-link">
                    <div data-i18n="Mettings">Mettings</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('zoom.create') }}" class="menu-link">
                    <div data-i18n="Create">Create</div>
                </a>
            </li>


        </ul>
    </li>

</ul>
