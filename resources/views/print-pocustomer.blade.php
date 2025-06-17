<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Purchase Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .table-bordered td,
        .table-bordered th {
            border: 1px solid #000;
        }
        
        .no-border td {
            border: none !important;
        }
        
        .text-small {
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="container mt-3 text-small">
        <div class="row">
            <div class="col-8">
                <h5 class="fw-bold">CV Saga Multi Industri</h5>
                <p class="mb-0">Jl. RH. Didi Sukardi No. 157 Sukabumi Kec. Citamiang, Kota Sukabumi Jawa Barat, 43144<br> Telp/Fax: (0266) 221 383<br> Email: sagamulti@yahoo.com</p>
            </div>
            <div class="col-4 text-end">
                <img src="https://upload.wikimedia.org/wikipedia/commons/9/9e/ISO_9001_2015.svg" alt="ISO Logo" width="80">
                <p class="mb-0">Management System<br>ISO 9001:2015</p>
            </div>
        </div>

        <hr>

        <h5 class="text-center fw-bold mt-3">PURCHASE ORDER</h5>

        <div class="row mt-4">
            <div class="col-6">
                <p><strong>Kepada Yth :</strong><br>
                    <strong>{{ $view_relasi->nama_supplier }}</strong><br> {{ $view_relasi->alamat_supplier }}</p>
            </div>
            <div class="col-6">
                <table class="table table-sm no-border">
                    <tr>
                        <td>No PO</td>
                        <td>:  {{ $data_header->fno_poc }}</td>
                    </tr>
                    <tr>
                        <td>Tgl PO</td>
                        <td>: {{ $data_header->ftgl_poc }}</td>
                    </tr>
                    <tr>
                        <td>Keterangan</td>
                        <td>{{ $data_header->fket }}</td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="table table-bordered mt-3 text-center align-middle">
            <thead class="table-light">
                <tr>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Satuan</th>
                    <th>Harga</th>
                    <th>Qty</th>
                    <th>Jml</th>
                </tr>
            </thead>
            <tbody>
                 <!-- row 1 -->
                    @foreach ($data_detail as $d)
                        <tr>
                            <th>{{ $d->kode_brj }}</th>
                            <th>{{ $d->nama_brg_cus }}</th>
                            <th>{{ $d->satuan_jual }}</th>
                            <th>{{ formatRupiah($d->fharga) }}</th>
                            <th>{{ $d->fqt_poc }}</th>
                            <th>{{ formatRupiah($d->FJumlah) }}</th>
                        </tr>
                    @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Sub Total</td>
                    <td>
                        {{ formatRupiah($data_total) }}
                    </td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end fw-bold">PPN 11%</td>
                    <td>{{formatRupiah($ppn)}}</td>
                </tr>
                <tr>
                    <td colspan="5" class="text-end fw-bold">Grand Total</td>
                    <td>{{formatRupiah($grand_total)}}</td>
                </tr>
            </tfoot>
        </table>

        <div class="row mt-5">
            <div class="col-6 text-center">
                <strong>PREPARED BY</strong><br><br><br>
                <u>Heni Herawati</u>
            </div>
            <div class="col-6 text-center">
                <strong>APPROVED BY</strong><br><br><br>
                <u>Waway Suherli</u>
            </div>
        </div>
    </div>

    <script>
        window.print()
    </script>
</body>
</html>