<form method="GET" action="{{ $action ?? url()->current() }}" class="mb-3">

    <select 
        name="category" 
        class="form-select"
        onchange="this.form.submit()"
    >
        <option value="">Semua Kategori</option>

        @foreach($categories as $cat)
            <option 
                value="{{ $cat->id }}" 
                {{ request('category') == $cat->id ? 'selected' : '' }}
            >
                {{ $cat->name }}
            </option>
        @endforeach

    </select>

</form>
