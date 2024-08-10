<ul class="menu-inner py-1">

    <li class="menu-item">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <i class="menu-icon tf-icons ti ti-smart-home"></i>
            <div data-i18n="Crm">Crm</div>
        </a>
        <ul class="menu-sub">

            <li class="menu-item">
                <a href="{{ route('crm.employ.main') }}" class="menu-link">
                    <div data-i18n="Main">Main</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('crm.employ.report',['user'=>Auth::user()->id]) }}" class="menu-link">
                    <div data-i18n="Working Report">Working Report</div>
                </a>
            </li>

            <li class="menu-item">
                <a href="{{ route('zoom.users') }}" class="menu-link">
                    <div data-i18n="Mettings">Mettings</div>
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



</ul>
