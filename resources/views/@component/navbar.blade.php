{{-- <div class="navbar bg-base-100 shadow-sm">
  <div class="navbar-start">
    <div class="dropdown "  >
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /> </svg>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-50 mt-3 w-52 p-2 shadow">
      <li><a href="./">Home</a></li>
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
    <a class="btn btn-ghost text-xl">SIP</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1 ">
      <li><a href="./">Home</a></li>
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
            <li><a href="./pocustomer">PO Customer</a></li>
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
</div> --}}

{{-- <div class="navbar bg-base-100 shadow-sm fixed top-0 w-full z-50">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" href=".">SIP</a>
  </div>
  <div class="flex-none">
    <ul class="menu menu-horizontal px-1">
      
      <li>
        <details>
          <summary>Master Data</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
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
          <ul class="bg-base-100 rounded-t-none p-2">
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
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a>Barang Customer</a></li>
            <li><a href="./pocustomer">PO Customer</a></li>
            <li><a>Pengiriman</a></li>
            <li><a>Retur Kirim</a></li>
            <li><a>AR</a></li>
          </ul>
        </details>
      </li>

       <li>
        <details>
          <summary>Accounting</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
           <li><a>Kas Bank</a></li>
            <li><a>Jurnal GL</a></li>
          </ul>
        </details>
      </li>
    <li><a href="./logout" style="color: red">Logout</a></li>
    </ul>
  </div>
</div> --}}

<!-- Navbar Responsive -->
<div class="navbar bg-base-100 shadow-sm fixed top-0 w-full z-50">
  <div class="flex-1">
    <a class="btn btn-ghost text-xl" href=".">SIP</a>
  </div>

  <!-- Toggle Button (Mobile Only) -->
  <div class="lg:hidden">
    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="btn btn-square btn-ghost">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>
  </div>

  <!-- Desktop Menu -->
  <div class="hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <!-- Master Data -->
      <li>
        <details>
          <summary>Master Data</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a href="./jenis">Jenis</a></li>
            <li><a href="./satuan">Satuan</a></li>
            <li><a href="./barang">Material</a></li>
            <li><a href="./brj">Barang Jadi</a></li>
            <li><a href="./supplier">Supplier</a></li>
            <li><a href="./customer">Customer</a></li>
          </ul>
        </details>
      </li>
      <!-- Transaksi Supplier -->
      <li>
        <details>
          <summary>Transaksi Supplier</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a href="./rls_brg_sup">Barang Supplier</a></li>
            <li><a href="./posuppllier">PO Supplier</a></li>
            <li><a href="./receive">Receive</a></li>
            <li><a>Retur Receive</a></li>
            <li><a>AP</a></li>
          </ul>
        </details>
      </li>
      <!-- Transaksi Customer -->
      <li>
        <details>
          <summary>Transaksi Customer</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a>Barang Customer</a></li>
            <li><a href="./pocustomer">PO Customer</a></li>
            <li><a>Pengiriman</a></li>
            <li><a>Retur Kirim</a></li>
            <li><a>AR</a></li>
          </ul>
        </details>
      </li>
      <!-- Accounting -->
      <li>
        <details>
          <summary>Accounting</summary>
          <ul class="bg-base-100 rounded-t-none p-2">
            <li><a>Kas Bank</a></li>
            <li><a>Jurnal GL</a></li>
          </ul>
        </details>
      </li>
      <!-- Logout -->
      <li><a href="./logout" class="text-red-500">Logout</a></li>
    </ul>
  </div>
</div>

<!-- Mobile Menu -->
<div id="mobile-menu" class="lg:hidden hidden bg-base-100 w-full mt-16 p-4 shadow-md">
  <ul class="menu menu-vertical">
    <li>
      <details>
        <summary>Master Data</summary>
        <ul>
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
        <ul>
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
        <ul>
          <li><a>Barang Customer</a></li>
          <li><a href="./pocustomer">PO Customer</a></li>
          <li><a>Pengiriman</a></li>
          <li><a>Retur Kirim</a></li>
          <li><a>AR</a></li>
        </ul>
      </details>
    </li>
    <li>
      <details>
        <summary>Accounting</summary>
        <ul>
          <li><a>Kas Bank</a></li>
          <li><a>Jurnal GL</a></li>
        </ul>
      </details>
    </li>
    <li><a href="./logout" class="text-red-500">Logout</a></li>
  </ul>
</div>
