<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Family Information
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-x-auto shadow rounded-lg">
                <table class="min-w-full leading-normal">
                    <thead>
                        <tr>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                User ID
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Primary Kin Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Primary Relationship
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Secondary Kin Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Secondary Relationship
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tertiary Kin Email
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tertiary Relationship
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Additional Info
                            </th>
                            <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Verified
                            </th>
                        </tr>
                    </thead>
                    <tbody>
    @foreach ($familyInfos as $info)
    <tr class="hover:bg-gray-50">
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->id }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->user_id }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->kin_email_1 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->relation_1 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->kin_email_2 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->relation_2 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->kin_email_3 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->relation_3 }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">{{ $info->additional_info }}</td>
        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
            @if($info->verified)
                <span class="inline-block bg-green-500 rounded-full px-3 py-1 text-sm font-semibold text-white">Verified</span>
            @else
                <form method="POST" action="{{ route('superadmin.family.verify', $info->id) }}">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="inline-block bg-red-500 rounded-full px-3 py-1 text-sm font-semibold text-white">Verify</button>
                </form>
            @endif
        </td>
    </tr>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
</x-app-layout>
