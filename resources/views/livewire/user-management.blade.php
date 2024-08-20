@extends('layouts.app')
@section('content')
    @inject('user','App\Models\User')
<div>
    <h1 class="text-2xl font-bold">User Management</h1>

    <table class="table-auto w-full">
        <thead>
        <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($users as $user)
            <tr>
                <td class="border px-4 py-2">{{ $user->id }}</td>
                <td class="border px-4 py-2">{{ $user->name }}</td>
                <td class="border px-4 py-2">{{ $user->email }}</td>
                <td class="border px-4 py-2">
                    <button class="bg-blue-500 text-white px-4 py-2">Edit</button>
                    <button class="bg-red-500 text-white px-4 py-2">Delete</button>
                </td>
            </tr>
        @endforeach
        </tbody>
         </table>
</div>
@stop
