{{-- This file is used for menu items by any Backpack v6 theme --}}
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>

{{--<x-backpack::menu-item title="Monitoring Sheets" icon="la la-wpforms" :link="backpack_url('monitoring-sheet')" />--}}
<x-backpack::menu-item title="User Management" icon="la la-user" :link="backpack_url('user')" />
<x-backpack::menu-item title="Process owners" icon="la la-id-badge" :link="backpack_url('process-owner')" />

<x-backpack::menu-dropdown title="Monitoring Sheets" icon="la la-wpforms">
    <x-backpack::menu-item title="FQO" icon="la la-wpforms" :link="backpack_url('funtional-quality-objectives')" />
    <x-backpack::menu-item title="RR" icon="la la-wpforms" :link="backpack_url('risk-register')"></x-backpack::menu-item>
    <x-backpack::menu-item title="PG" icon="la la-wpforms" :link="backpack_url('process-goals')"></x-backpack::menu-item>
</x-backpack::menu-dropdown>

<x-backpack::menu-dropdown title="Settings" icon="la la-gear">
    <x-backpack::menu-item title="Processes" icon="la la-address-book" :link="backpack_url('process')" />
    <x-backpack::menu-item title="Areas" icon="la la-users" :link="backpack_url('area')" />
    <x-backpack::menu-item title="Divisions" icon="la la-landmark" :link="backpack_url('division')" />
</x-backpack::menu-dropdown>

