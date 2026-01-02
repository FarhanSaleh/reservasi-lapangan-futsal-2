<x-base-layout>
    <h1 class="text-2xl">Dashbaord</h1>
    <form action="/logout" method="POST">
        @csrf
        @method("DELETE")
        <button type="submit" class="border">Logout</button>
    </form>
</x-base-layout>