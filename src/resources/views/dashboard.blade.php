<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inventory | Stockroom</title>
    <style>
        :root{font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;color:#182230;background:#f5f7fb;font-synthesis:none}
        *{box-sizing:border-box}body{margin:0}button,input,select,textarea{font:inherit}button{cursor:pointer}
        .layout{min-height:100vh;display:grid;grid-template-columns:244px minmax(0,1fr)}
        aside{background:#142b26;color:#d4e4dd;padding:27px 17px;display:flex;flex-direction:column}
        .brand{display:flex;align-items:center;gap:12px;padding:0 10px 32px;color:#fff;font-size:17px;font-weight:750;letter-spacing:-.3px}
        .brand-mark{display:grid;place-items:center;width:34px;height:34px;border-radius:11px;background:#3d8b69;color:white;font-size:17px}
        .nav-label{padding:0 12px 10px;color:#8aa499;font-size:10px;font-weight:700;letter-spacing:1.3px;text-transform:uppercase}
        .nav{display:grid;gap:5px}.nav a{display:flex;align-items:center;gap:12px;padding:11px 12px;border-radius:9px;color:#bfd0c8;text-decoration:none;font-size:13px;font-weight:550}
        .nav a:hover,.nav a.active{background:#24473b;color:#fff}.nav-icon{width:18px;text-align:center;font-size:15px}
        .side-note{margin-top:auto;border-top:1px solid #315045;padding:17px 10px 0;color:#9bb2a7;font-size:11px;line-height:1.6}
        main{min-width:0;padding:27px clamp(18px,4vw,48px) 48px}
        .topbar{display:flex;justify-content:space-between;align-items:center;gap:18px;margin-bottom:32px}
        .eyebrow{margin-bottom:5px;color:#798695;font-size:11px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase}
        h1{margin:0;font-size:26px;letter-spacing:-.8px}.date{color:#748091;font-size:12px}
        .heading-row{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:19px}
        .heading-row p{margin:5px 0 0;color:#7a8694;font-size:13px}
        .button{border:0;border-radius:8px;padding:10px 14px;background:#287653;color:#fff;font-size:12px;font-weight:700;box-shadow:0 3px 8px #24694920}
        .button:hover{background:#1f6344}.button.secondary{background:#e8f1ec;color:#236545;box-shadow:none}.button.secondary:hover{background:#dcebe2}
        .stats{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;margin-bottom:30px}
        .stat,.panel{background:#fff;border:1px solid #e8edf1;border-radius:12px;box-shadow:0 4px 16px #24364b08}
        .stat{padding:17px 18px}.stat-label{color:#748091;font-size:11px;font-weight:600}.stat-value{margin-top:11px;font-size:24px;font-weight:750;letter-spacing:-.7px}.stat-foot{margin-top:5px;color:#98a1ac;font-size:10px}
        .panel{overflow:hidden}.table-tools{display:flex;gap:10px;align-items:center}
        .search,.filter{height:36px;border:1px solid #e2e8ed;border-radius:7px;background:#fff;padding:0 11px;color:#394657;font-size:12px;outline:none}
        .search{width:210px}.search:focus,.filter:focus,.field input:focus,.field textarea:focus,.field select:focus{border-color:#5a9a77;box-shadow:0 0 0 3px #47876018}
        .table-wrap{overflow:auto}table{width:100%;border-collapse:collapse;white-space:nowrap}th{text-align:left;padding:12px 16px;background:#f9fafb;border-bottom:1px solid #edf0f3;color:#7a8694;font-size:10px;font-weight:700;letter-spacing:.6px;text-transform:uppercase}
        td{padding:13px 16px;border-bottom:1px solid #f0f2f4;color:#3b4653;font-size:12px}tbody tr:last-child td{border-bottom:0}
        .item-name{color:#202b38;font-weight:650}.subtext{margin-top:3px;color:#98a1ac;font-size:10px;max-width:260px;overflow:hidden;text-overflow:ellipsis}
        .badge{display:inline-flex;align-items:center;border-radius:99px;background:#edf5f0;padding:5px 9px;color:#347253;font-size:10px;font-weight:650}
        .qty{font-weight:700}.qty.low{color:#c47727}.empty{padding:32px;text-align:center;color:#818b98;font-size:13px}
        .section{margin-top:28px}.mini-grid{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:16px}
        .list{padding:0 18px}.list-row{display:flex;justify-content:space-between;gap:15px;padding:14px 0;border-bottom:1px solid #f0f2f4;font-size:12px}.list-row:last-child{border-bottom:0}
        .list-row strong{display:block;color:#2d3946;font-size:12px}.list-row span{display:block;margin-top:3px;color:#8a95a2;font-size:10px}.list-value{color:#405363;font-weight:700;text-align:right}
        .panel-title{padding:17px 18px 12px;font-size:13px;font-weight:700}
        dialog{width:min(480px,calc(100% - 28px));max-height:90vh;padding:0;border:0;border-radius:14px;box-shadow:0 20px 70px #1723333d}
        dialog::backdrop{background:#13201bc0;backdrop-filter:blur(2px)}.modal-head{display:flex;justify-content:space-between;align-items:center;padding:18px 21px;border-bottom:1px solid #edf0f3}
        .modal-head h2{margin:0;font-size:16px}.close{border:0;background:transparent;color:#7c8793;font-size:22px}
        .form-body{display:grid;gap:13px;padding:19px 21px 21px}.field{display:grid;gap:6px}.field label{color:#475363;font-size:11px;font-weight:650}
        .field input,.field select,.field textarea{width:100%;border:1px solid #dfe5e9;border-radius:7px;padding:9px 10px;outline:none;font-size:12px}.field textarea{min-height:72px;resize:vertical}
        .form-error{display:none;border-radius:7px;background:#fff0ee;padding:10px;color:#a3392b;font-size:11px;line-height:1.5}.form-actions{display:flex;justify-content:flex-end;gap:9px;margin-top:3px}
        .toast{position:fixed;right:22px;bottom:22px;display:none;border-radius:9px;background:#173c2d;padding:12px 17px;color:#fff;font-size:12px;box-shadow:0 10px 28px #11271e30}
        @media(max-width:850px){.layout{grid-template-columns:72px minmax(0,1fr)}aside{padding:22px 10px}.brand{justify-content:center;padding:0 0 28px}.brand-name,.nav-label,.nav-text,.side-note{display:none}.nav a{justify-content:center;padding:12px 6px}.stats{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media(max-width:560px){.layout{display:block}aside{padding:10px 14px;display:block}.brand{display:none}.nav{display:flex;overflow:auto}.nav a{flex-shrink:0}.nav-text{display:inline}.nav a{padding:9px 11px}main{padding:22px 14px}.topbar{margin-bottom:24px}.date{display:none}.stats{gap:9px}.stat{padding:13px}.stat-value{font-size:20px}.heading-row{align-items:flex-start;flex-direction:column}.table-tools{width:100%}.search{width:auto;flex:1}.filter{max-width:132px}.mini-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
<div class="layout">
    <aside>
        <div class="brand"><div class="brand-mark">S</div><span class="brand-name">Stockroom</span></div>
        <div class="nav-label">Workspace</div>
        <nav class="nav">
            <a class="active" href="#overview"><span class="nav-icon">▦</span><span class="nav-text">Overview</span></a>
            <a href="#inventory"><span class="nav-icon">▤</span><span class="nav-text">Inventory</span></a>
            <a href="#categories"><span class="nav-icon">◫</span><span class="nav-text">Categories</span></a>
            <a href="#suppliers"><span class="nav-icon">♧</span><span class="nav-text">Suppliers</span></a>
        </nav>
        <div class="side-note">Inventory management<br>Keep your stock in sync.</div>
    </aside>
    <main>
        <header class="topbar" id="overview">
            <div><div class="eyebrow">Inventory management</div><h1>Overview</h1></div>
            <div class="date">{{ now()->format('l, F j, Y') }}</div>
        </header>
        <section class="stats" aria-label="Inventory summary">
            <article class="stat"><div class="stat-label">Total products</div><div class="stat-value">{{ number_format($items->count()) }}</div><div class="stat-foot">Products in your inventory</div></article>
            <article class="stat"><div class="stat-label">Units in stock</div><div class="stat-value">{{ number_format((int) ($summary->total_stock ?? 0)) }}</div><div class="stat-foot">Across all products</div></article>
            <article class="stat"><div class="stat-label">Stock value</div><div class="stat-value">${{ number_format((float) ($summary->total_stock_value ?? 0), 2) }}</div><div class="stat-foot">Based on current quantities</div></article>
            <article class="stat"><div class="stat-label">Categories / suppliers</div><div class="stat-value">{{ $categories->count() }} <span style="color:#aab3bd;font-size:16px">/</span> {{ $suppliers->count() }}</div><div class="stat-foot">Catalog groups and partners</div></article>
        </section>

        <section id="inventory">
            <div class="heading-row">
                <div><h2 style="margin:0;font-size:17px">Inventory</h2><p>Browse and manage the products in stock.</p></div>
                <button class="button" type="button" data-open="item-dialog">＋ Add product</button>
            </div>
            <div class="panel">
                <div style="display:flex;justify-content:flex-end;gap:10px;padding:14px 16px">
                    <input class="search" id="item-search" type="search" placeholder="Search products..." aria-label="Search products">
                    <select class="filter" id="category-filter" aria-label="Filter by category">
                        <option value="">All categories</option>
                        @foreach($categories as $category)<option value="{{ $category->name }}">{{ $category->name }}</option>@endforeach
                    </select>
                </div>
                <div class="table-wrap">
                    <table>
                        <thead><tr><th>Product</th><th>Category</th><th>Supplier</th><th>Unit price</th><th>Quantity</th><th>Stock value</th></tr></thead>
                        <tbody id="items-body">
                        @forelse($items as $item)
                            <tr data-name="{{ strtolower($item->name) }}" data-category="{{ $item->category->name ?? '' }}">
                                <td><div class="item-name">{{ $item->name }}</div><div class="subtext">{{ $item->description }}</div></td>
                                <td><span class="badge">{{ $item->category->name ?? 'Uncategorized' }}</span></td>
                                <td>{{ $item->supplier->name ?? '—' }}</td>
                                <td>${{ number_format((float) $item->price, 2) }}</td>
                                <td class="qty {{ $item->quantity < 10 ? 'low' : '' }}">{{ number_format((int) $item->quantity) }}</td>
                                <td>${{ number_format((float) $item->price * (int) $item->quantity, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td class="empty" colspan="6">No products yet. Add your first product to get started.</td></tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="section mini-grid">
            <div class="panel" id="categories">
                <div class="heading-row" style="padding:17px 18px 0;margin-bottom:0">
                    <div><h2 style="margin:0;font-size:14px">Categories</h2><p>Organize your products</p></div>
                    <button class="button secondary" type="button" data-open="category-dialog">＋ Add</button>
                </div>
                <div class="list">
                    @forelse($categories as $category)
                        <div class="list-row"><div><strong>{{ $category->name }}</strong><span>{{ $category->description ?: 'No description' }}</span></div><div class="list-value">{{ $category->items()->count() }} items</div></div>
                    @empty<div class="empty">No categories added yet.</div>@endforelse
                </div>
            </div>
            <div class="panel" id="suppliers">
                <div class="heading-row" style="padding:17px 18px 0;margin-bottom:0">
                    <div><h2 style="margin:0;font-size:14px">Suppliers</h2><p>Your supply partners</p></div>
                    <button class="button secondary" type="button" data-open="supplier-dialog">＋ Add</button>
                </div>
                <div class="list">
                    @forelse($suppliers as $supplier)
                        <div class="list-row"><div><strong>{{ $supplier->name }}</strong><span>{{ $supplier->contact_info ?: 'No contact details' }}</span></div><div class="list-value">{{ $supplier->items()->count() }} items</div></div>
                    @empty<div class="empty">No suppliers added yet.</div>@endforelse
                </div>
            </div>
        </section>
    </main>
</div>

<dialog id="item-dialog">
    <div class="modal-head"><h2>Add product</h2><button class="close" type="button" aria-label="Close">×</button></div>
    <form class="form-body" data-endpoint="/api/items/store">
        <div class="form-error"></div>
        <div class="field"><label for="item-name">Product name</label><input id="item-name" name="name" required maxlength="100"></div>
        <div class="field"><label for="item-description">Description</label><textarea id="item-description" name="description" required></textarea></div>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px">
            <div class="field"><label for="item-price">Unit price</label><input id="item-price" name="price" type="number" min="0" step="0.01" required></div>
            <div class="field"><label for="item-quantity">Quantity</label><input id="item-quantity" name="quantity" type="number" min="0" step="1" required></div>
        </div>
        <div class="field"><label for="item-category">Category</label><select id="item-category" name="category_id" required><option value="">Select category</option>@foreach($categories as $category)<option value="{{ $category->id }}">{{ $category->name }}</option>@endforeach</select></div>
        <div class="field"><label for="item-supplier">Supplier</label><select id="item-supplier" name="supplier_id" required><option value="">Select supplier</option>@foreach($suppliers as $supplier)<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>@endforeach</select></div>
        <div class="form-actions"><button class="button secondary" type="button" data-close>Cancel</button><button class="button" type="submit">Save product</button></div>
    </form>
</dialog>
<dialog id="category-dialog">
    <div class="modal-head"><h2>Add category</h2><button class="close" type="button" aria-label="Close">×</button></div>
    <form class="form-body" data-endpoint="/api/categories/store">
        <div class="form-error"></div>
        <div class="field"><label for="category-name">Category name</label><input id="category-name" name="name" required maxlength="100"></div>
        <div class="field"><label for="category-description">Description</label><textarea id="category-description" name="description" required></textarea></div>
        <div class="form-actions"><button class="button secondary" type="button" data-close>Cancel</button><button class="button" type="submit">Save category</button></div>
    </form>
</dialog>
<dialog id="supplier-dialog">
    <div class="modal-head"><h2>Add supplier</h2><button class="close" type="button" aria-label="Close">×</button></div>
    <form class="form-body" data-endpoint="/api/suppliers/store">
        <div class="form-error"></div>
        <div class="field"><label for="supplier-name">Supplier name</label><input id="supplier-name" name="name" required maxlength="100"></div>
        <div class="field"><label for="supplier-contact">Contact information</label><input id="supplier-contact" name="contact_info" required maxlength="100" placeholder="Email or phone"></div>
        <div class="form-actions"><button class="button secondary" type="button" data-close>Cancel</button><button class="button" type="submit">Save supplier</button></div>
    </form>
</dialog>
<div class="toast" id="toast" role="status"></div>
<script>
    document.querySelectorAll('[data-open]').forEach(button => button.addEventListener('click', () => document.getElementById(button.dataset.open).showModal()));
    document.querySelectorAll('dialog .close, dialog [data-close]').forEach(button => button.addEventListener('click', () => button.closest('dialog').close()));
    document.querySelectorAll('dialog').forEach(dialog => dialog.addEventListener('click', event => { if (event.target === dialog) dialog.close(); }));

    const search = document.getElementById('item-search');
    const categoryFilter = document.getElementById('category-filter');
    function filterItems() {
        const query = search.value.trim().toLowerCase();
        const category = categoryFilter.value.toLowerCase();
        document.querySelectorAll('#items-body tr[data-name]').forEach(row => {
            row.hidden = !row.dataset.name.includes(query) || (category && row.dataset.category.toLowerCase() !== category);
        });
    }
    search.addEventListener('input', filterItems);
    categoryFilter.addEventListener('change', filterItems);

    document.querySelectorAll('form[data-endpoint]').forEach(form => form.addEventListener('submit', async event => {
        event.preventDefault();
        const errorBox = form.querySelector('.form-error');
        const submit = form.querySelector('[type="submit"]');
        errorBox.style.display = 'none';
        submit.disabled = true;
        try {
            const response = await fetch(form.dataset.endpoint, {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify(Object.fromEntries(new FormData(form)))
            });
            const result = await response.json();
            if (!response.ok) {
                const messages = result.errors ? Object.values(result.errors).flat() : [result.message || result.error || 'Could not save this record.'];
                throw new Error(messages.join(' '));
            }
            form.closest('dialog').close();
            document.getElementById('toast').textContent = 'Saved successfully. Refreshing inventory…';
            document.getElementById('toast').style.display = 'block';
            window.setTimeout(() => window.location.reload(), 650);
        } catch (error) {
            errorBox.textContent = error.message || 'The request failed. Please try again.';
            errorBox.style.display = 'block';
        } finally {
            submit.disabled = false;
        }
    }));
</script>
</body>
</html>
