<div class="navbar bg-base-100 shadow-sm">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-1 mt-3 w-52 p-2 shadow">
      <li><a>Home</a></li>
      <li>
        <details>
          <summary>Master Data</summary>
          <ul class="p-2">
            <li><a href="./jenis">Jenis</a></li>
            <li><a href="./satuan">Satuan</a></li>
            <li><a href="./barang">Material</a></li>
            <li><a href="./brj">Barang Jadi</a></li>
            <li><a href="./supplier">Supplier</a></li>
            <li><a href="./customer">Customer</a></li>
          </ul>
        </details>
      </li>
      <li>
        <details>
          <summary>Transaksi Supplier</summary>
          <ul class="p-2">
            <li><a href="./rls_brg_sup">Barang Supplier</a></li>
            <li><a href="./posuppllier">PO Supplier</a></li>
            <li><a href="./receive">Receive</a></li>
            <li><a>Retur Receive</a></li>
            <li><a>AP</a></li>
          </ul>
        </details>
    </li>
    <li>
      <details>
          <summary>Transaksi Customer</summary>
          <ul class="p-2">
            <li><a>Barang Customer</a></li>
            <li><a>PO Customer</a></li>
            <li><a>Pengiriman</a></li>
            <li><a>Retur Kirim</a></li>
            <li><a>AR</a></li>
          </ul>
        </details>
      </li>
      <li>
      <details>
          <summary>Accounting</summary>
          <ul class="p-2">
            <li><a>Kas Bank</a></li>
            <li><a>Jurnal GL</a></li>
          </ul>
        </details>
      </li>
      </ul>
    </div>
    <a class="btn btn-ghost text-xl">Sistem Informasi Factory</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><href="/">Home</a></li>
      <li>
        <details>
          <summary>Master Data</summary>
          <ul class="p-2">
            <li><a href="./jenis">Jenis</a></li>
            <li><a href="./satuan">Satuan</a></li>
            <li><a href="./barang">Material</a></li>
            <li><a href="./brj">Barang Jadi</a></li>
            <li><a href="./supplier">Supplier</a></li>
            <li><a href="./customer">Customer</a></li>
          </ul>
        </details>
      </li>
      <li>
        <details>
          <summary>Transaksi Supplier</summary>
          <ul class="p-2">
            <li><a href="./rls_brg_sup">Barang Supplier</a></li>
            <li><a href="./posuppllier">PO Supplier</a></li>
            <li><a href="./receive">Receive</a></li>
            <li><a>Retur Receive</a></li>
            <li><a>AP</a></li>
          </ul>
        </details>
    </li>
    <li>
        <details>
          <summary>Transaksi Customer</summary>
          <ul class="p-2">
            <li><a href="./rls_brg_cus">Barang Customer</a></li>
            <li><a>PO Customer</a></li>
            <li><a>Pengiriman</a></li>
            <li><a>Retur Kirim</a></li>
            <li><a>AR</a></li>
          </ul>
        </details>
      </li>
      <li>
        <details>
          <summary>Inventory Gudang</summary>
          <ul class="p-2">
            <li><a>Pengeluaran Barang</a></li>
            <li><a>Retur Barang</a></li>
            <li><a>Stok Material</a></li>
            <li><a>Stok Barang Jadi</a></li>
          </ul>
        </details>
      </li>
      <li>
      <details>
          <summary>Accounting</summary>
          <ul class="p-2">
            <li><a>Kas Bank</a></li>
            <li><a>Jurnal GL</a></li>
          </ul>
        </details>
      </li>
    </ul>
  </div>
  <div class="navbar-end">
    <a href="/logout" style="color: red" @click="logout">Log Out</a>
  </div>
</div>