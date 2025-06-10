<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PO Supplier Page</title>
    @include('@component/assets')

</head>

<body>
    @include('@component/navbar')

    <div id="app" class="mx-auto">
        <br>
        <div class="grid grid-cols-2 gap-4 p-4">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2"></h2>
                <h2 class="card-title">Header Data</h2>
                <input type="text" disabled ref="no_pos" v-model="no_pos" placeholder="NO Faktur PO"
                    class="input input-primary" /><br><br>
                <input type="date" ref="tgl_pos" v-model="tgl_pos" placeholder="Tgl Faktur"
                    class="input input-primary" /><br><br>
                <select v-model="result_suppllier" :disabled="disabled_supplier" ref="result_suppllier" class="select">
                    <option disabled selected>Pilih Suppllier</option>
                    <option v-for="data in data_suppllier" :value="data.kode_supplier">@{{ data.kode_supplier }}</option>
                </select>
                <br>
                <center>
                    <legend class="fieldset-legend text-center"></legend>
                </center>
                <label class="label">
                    PPN
                    <input type="checkbox" ref="PPN_suppllier" v-model="PPN_suppllier" class="checkbox" />
                </label>
                </fieldset>
                <br>
                <center>
                    <legend class="fieldset-legend"></legend>
                </center>
                <label class="label">
                    PPH23
                    <input type="checkbox" ref="pph23" v-model="pph23" class="checkbox" />
                </label>
                </fieldset>
                <br><br>

                <input type="text" ref="ket" v-model="ket" placeholder="Keterangan"
                    class="input input-primary" /><br><br>
                <button class="btn" @click="openModalBarang">Cari Barang</button> <br><br>
                <button @click="save" class="btn btn-success">Save</button>


            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Data Barang</h2>
                <hr> <br>

                <input type="text" placeholder="Kode RLS" v-model="kode_rls" class="input" disabled />
                <input type="text" placeholder="Nama Barang" v-model="nama_barang" class="input" disabled />
                {{-- <input type="text" placeholder="NO POS" v-model="no_pos" class="input" /> --}}
                <input type="text" placeholder="Harga POS" v-model="harga_pos" ref="harga_pos" class="input" />
                <input type="text" placeholder="Qty POS" v-model="qty_pos" ref="qty_pos" class="input" />
                <input type="text" placeholder="NO SPO" v-model="no_spo" class="input" disabled />

                <br><br>
                <button @click="addData" class="btn btn-primary">Add</button>
                <button @click="clearData" class="btn btn-success">Clear</button>
                <br><br>
                <hr>
                <div role="alert" class="alert alert-info">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        class="h-6 w-6 shrink-0 stroke-current">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>Total : @{{ grand_total }}</span>
                </div>
                <div class="overflow-x-auto">

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>

                                <th>Kode RLS</th>
                                <th>NO POS</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Sub Total</th>
                                <th>@</th>
                                {{-- <th>No SPO</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr v-for="data in data_barangs">
                                <th>@{{ data.kode_rls }}</th>
                                <td>@{{ data.no_pos }}</td>
                                <td>@{{ data.harga }}</td>
                                <td>@{{ data.qty }}</td>
                                <td>@{{ data.qty * data.harga }}</td>
                                <td>
                                    <button class="btn">x</button>
                                </td>
                                {{-- <td>@{{ data.no_spo }}</td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <center>
            <button class="btn btn-primary" onclick="window.location.href='./posuppllier'">Back</button>
        </center>

        <!-- Open the modal using ID.showModal() method -->



        <dialog id="my_modal_barang" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Cari Barang</h3>
                <hr>
                <p class="py-4"></p>
                <input type="text" placeholder="Search" class="input" />
                <br>
                <div class="modal-action">

                    <div class="overflow-x-auto">

                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Kode Supplier</th>
                                    <th>ID Otomatis</th>
                                    <th>Kode RLS</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Part</th>
                                    <th>Harga Beli</th>
                                    <th>Satuan Beli</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr v-for="data in barangs">
                                    <th @click="addBarang(data)">
                                        <a href="#">@{{ data.kode_supplier }}</a>
                                    </th>
                                    <th>@{{ data.id_otomatis }}</th>
                                    <th>@{{ data.kode_rls }}</th>
                                    <th>@{{ data.nama_brg_sup }}</th>
                                    <th>@{{ data.kode_part }}</th>
                                    <th>@{{ data.harga_beli }}</th>
                                    <th>@{{ data.satuan_beli }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
                <!-- if there is a button in form, it will close the modal -->
                <button class="btn" onclick="my_modal_barang.close()">Close</button>
            </div>
        </dialog>



    </div>
    <br><br>
    @include('@component/footer')
    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';
        new Vue({
            el: "#app",
            data: {
                barangs: null,
                h_supliers: null,
                alert: false,
                jenis_edit: null,
                links: null,
                search: null,
                jenis: null,
                loading: false,
                id_edit: null,
                no_pos: null,
                tgl_pos: null,
                result_suppllier: null,
                data_suppllier: null,
                no_ppn: null,
                pph23: null,
                PPN_suppllier: null,
                ket: null,
                result_kode_user: null,
                data_kode_user: null,
                kode_rls: null,
                nama_barang: null,
                harga_pos: null,
                no_spo: null,
                qty_pos: null,
                data_barangs: null,
                grand_total: null,
                disabled_supplier: false
            },
            methods: {
                clearData: function() {
                    localStorage.clear()
                    _refresh()
                },
                generateKodeSpo() {

                    var data = (_getStorage('data'));
                    if (data) {
                        data = JSON.parse(data);
                        var $urut = [];
                        var $i = 0;
                        data.forEach(element => {
                            $urut[$i] = element['no_spo'];

                            $i++;

                        });
                        $urut = $urut.sort((a, b) => a - b);
                        const angka = String($urut[$urut.length - 1]).slice(-3);
                        this.no_spo = generateNoUrutDateMonth(angka);
                    } else {
                        this.no_spo = tahun + bulan + '001';
                    }
                },
                addData: function() {
                    var $storage;
                    if (_getStorage('data')) {
                        $storage = JSON.parse(_getStorage('data'))
                    }
                    if (this.kode_rls == null) {
                        alert("Pilih Barang dulu !")
                        return
                    }
                    if (this.qty_pos == null) {
                        this.$refs.qty_pos.focus();
                        return;
                    }

                    var $data = [{
                        "kode_rls": this.kode_rls,
                        "no_pos": this.no_pos,
                        "harga": this.harga_pos,
                        "qty": this.qty_pos,
                        "no_spo": this.no_spo,
                        "sub_total":this.qty_pos*this.harga_pos
                    }]

                    if ($storage == null) {


                        $tmp = JSON.stringify($data);
                        _saveStorage('data', $tmp);
                        this.data_barangs = JSON.parse(_getStorage('data'));

                    } else {

                        $storage.push(...$data);
                        _saveStorage('data', JSON.stringify($storage));

                        this.data_barangs = JSON.parse(_getStorage('data'));
                    }
                    const $barang_total = this.data_barangs;

                    var grand_total = 0;
                    $barang_total.forEach(element => {
                        grand_total += element['sub_total'];
                    });
                    this.grand_total = grand_total


                    this.kode_rls = null;

                    this.nama_barang = null;
                    this.qty_pos = null;
                    this.no_spo = null;
                    this.harga_pos = null;


                    this.generateKodeSpo()
                    this.disabled_supplier=true;
                },
                addBarang: function(data) {
                    this.kode_rls = data.kode_rls
                    this.nama_barang = data.nama_brg_sup
                    this.harga_pos = data.harga_beli
                },
                openModalBarang: function() {

                    if (this.result_suppllier == null) {
                        alert("Pilih Supplier dulu !")
                        return
                    }
                    my_modal_barang.showModal()
                    this.loadDataBarang(this.result_suppllier);
                    this.generateKodeSpo();
                },
                loadDataBarang: function(kode_supplier) {
                    const $this = this;

                    axios.post("/load-barang-suppllier", {
                            _token: _TOKEN_,
                            kode_supplier: kode_supplier
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.barangs = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                updateData: function() {

                },
                searchData: function() {
                    if (this.search == null) {
                        this.$refs.search.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;
                    axios.post("/search-jenis", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.jeniss = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {

                    if (this.tgl_pos == null) {
                        this.$refs.tgl_pos.focus()
                        return;
                    }

                    if (this.result_suppllier == null) {
                        this.$refs.result_suppllier.focus()
                        return;
                    }

                    if (this.ket == null) {
                        this.$refs.ket.focus()
                        return;
                    }

                    if (_getStorage('data') == null) {

                        alert("Pilih barang terlebih dahulu")
                        return;
                    }

                    const $this = this;

                    axios.post("/save-h-supplier", {
                            _token: _TOKEN_,
                            data: (_getStorage('data')),
                            tgl_pos: this.tgl_pos,
                            result_suppllier: this.result_suppllier,
                            ket: this.ket,
                            no_pos: this.no_pos,
                            ppn: this.PPN_suppllier,
                            pph: this.pph23
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                alert("Berhasil Save Data");
                                _refresh()
                                localStorage.clear()
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                deleteData: function(id, data) {

                },
                logout: function() {
                    window.location.href = '/logout';
                },

                generateId() {
                    const $this = this;
                    axios.post("/generate-id-h-supplier", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {

                            if (response.data) {
                                if (response.data.fno_pos) {
                                    const angka = String(response.data.fno_pos).slice(-3);

                                    $this.no_pos = generateNoUrutDateMonth(angka);
                                } else {


                                    $this.no_pos = tahun + bulan + (response.data);
                                }
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                loadSupplier() {
                    const $this = this;
                    axios.post("/load-suppllier-data", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {

                            if (response.data) {
                                $this.data_suppllier = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            },
            mounted() {

                this.generateId()
                this.loadSupplier()
            }
        });
    </script>
</body>

</html>
