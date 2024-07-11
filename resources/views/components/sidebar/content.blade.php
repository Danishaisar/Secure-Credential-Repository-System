<!-- Assuming the content you provided is in a file named content.blade.php -->
<x-perfect-scrollbar as="nav" aria-label="main" class="flex flex-col flex-1 gap-4 px-3">
    <!-- Existing Dashboard Link -->
    <x-sidebar.link
        title="Dashboard"
        href="{{ route('user.dashboard') }}"
        :isActive="request()->routeIs('user.dashboard')"
    >
        <x-slot name="icon">
            <x-icons.dashboard class="flex-shrink-0 w-6 h-6" aria-hidden="true" />
        </x-slot>
    </x-sidebar.link>

    <!-- Conditional Links -->
    @if(Auth::user()->role === 'user')
        <!-- Link visible to regular users -->

        <!-- User Guide Link -->
        <x-sidebar.link
            title="System overview"
            href="{{ route('user.guide') }}"
            :isActive="request()->routeIs('user.guide')"
        >
        </x-sidebar.link>

        <x-sidebar.link
            title="Credentials"
            href="{{ route('credentials.index') }}"
            :isActive="request()->routeIs('credentials.index')"
        >
        </x-sidebar.link>
        
        <!-- Family Info Link -->
        <x-sidebar.link
            title="Family Info"
            href="{{ route('user.family.manage') }}"
            :isActive="request()->routeIs('user.family.manage')"
        >
        </x-sidebar.link>

        <!-- Agreement Link -->
        <x-sidebar.link
            title="User Agreement"
            href="{{ route('user.agreement') }}"
            :isActive="request()->routeIs('user.agreement')"
        >
        </x-sidebar.link>

        <!-- Complaint Link -->
        <x-sidebar.link
            title="Contact Us"
            href="{{ route('contact.index') }}"
            :isActive="request()->routeIs('contact.index')"
        >
        </x-sidebar.link>

    @endif

    @if(Auth::user()->role === 'admin')
        <!-- Links visible to admin users -->
        <x-sidebar.link
            title="User Management"
            href="{{ route('admin.users.index') }}"
            :isActive="request()->routeIs('admin.users.index')"
        >
        </x-sidebar.link>

        <!-- New Link for Viewing Feedback -->
        <x-sidebar.link
            title="User Feedback"
            href="{{ route('admin.feedback.index') }}"
            :isActive="request()->routeIs('admin.feedback.index')"
        >
        </x-sidebar.link>

        <!-- New Link for Viewing Audit Logs -->
        <x-sidebar.link
            title="Audit Logs"
            href="{{ route('admin.audit_logs.index') }}"
            :isActive="request()->routeIs('admin.audit_logs.index')"
        >
        </x-sidebar.link>

        <!-- Complaint Management Link -->
        <x-sidebar.link
            title="Manage Complaints"
            href="{{ route('admin.complaints.index') }}"
            :isActive="request()->routeIs('admin.complaints.index')"
        >
        </x-sidebar.link>

        <!-- New Link for Death Certificate Management -->
        <x-sidebar.link
            title="Death Certificate Management"
            href="{{ route('admin.deathCertificates') }}"
            :isActive="request()->routeIs('admin.deathCertificates')"
        >
        </x-sidebar.link>
    @endif

    @if(Auth::user()->role === 'superadmin')
        <!-- Links visible to superadmin users -->
        <x-sidebar.link
            title="User Family Info"
            href="{{ route('superadmin.family.index') }}"  
            :isActive="request()->routeIs('admin.family.index')"
        >
        </x-sidebar.link>
    @endif
</x-perfect-scrollbar>
