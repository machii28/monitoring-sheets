{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

<x-backpack::menu-item title="Monitoring Sheets" icon="la la-wpforms" :link="backpack_url('monitoring-sheet')" />
<x-backpack::menu-item title="Monitoring Sheets Category" icon="la la-clipboard" :link="backpack_url('monitoring-sheet-category')" />
<x-backpack::menu-item title="Users" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Areas" icon="la la-users" :link="backpack_url('area')" />
