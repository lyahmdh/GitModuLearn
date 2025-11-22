<form method="GET" action="{{ $action ?? url()->current() }}" class="mb-3">
    <div class="input-group">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input 
            type="text"
            name="search"
            class="form-control"
            placeholder="Cari modul..."
            value="{{ request('search') }}"
        >
        <button class="btn btn-primary">Cari</button>
    </div>
</form>
