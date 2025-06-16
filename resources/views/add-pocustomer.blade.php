<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>PO Customer</title>
    @include('@component/assets')
</head>
<body>
    @include('@component/navbar')
    <div id="app" class="mx-auto">
        <br>
        <div class="grid grid-flow-col grid-rows-1">
            <!-- Card 1 -->
            <div class="row-span-1 ms-4">
                <div class="bg-white rounded-xl shadow-md p-2">
                    <h2 class="text-xl font-semibold mb-2"></h2>
                    <h2 class="card-title">Header Data POC</h2>
                    <input type="text" disabled ref="no_poc" v-model="no_poc" placeholder="NO Faktur PO"
                        class="input input-primary" /><br><br>
                    <input type="date" ref="tgl_poc" v-model="tgl_poc" placeholder="Tgl Faktur"
                        class="input input-primary" /><br><br>
                    <select v-model="result_customer" ref="result_customer" class="select">
                        <option disabled selected>Pilih Customer</option>
                        <option v-for="data in data_customer" :value="data.kode_cus">@{{ data.nama_cus }}</option>
                    </select> <br>
                    <center>
                        <legend class="fieldset-legend text-center"></legend>
                    </center>
                    <label class="label">
                        <input type="checkbox" ref="PPN_Customer" v-model="PPN_Customer" class="checkbox" />
                        PPN
                    </label>
                    </fieldset>
                    <br>
                    <center>
                        <legend class="fieldset-legend"></legend>
                    </center>
                    <label class="label">
                        <input type="checkbox" ref="pph23_customer" v-model="pph23_customer" class="checkbox" />
                        PPH23
                    </label>
                    </fieldset>
                    <br><br>

                    <input type="text" ref="ket" v-model="ket" placeholder="Keterangan"
                        class="input input-primary" /><br><br>
                    <button @click="save" class="btn btn-success">Save</button> |   <button class="btn btn-primary" onclick="window.location.href='./pocustomer'">Back</button>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-span-2 row-span-2 ms-2">
                <div class="bg-white rounded-xl shadow-md p-6">
                <h2 class="text-xl font-semibold mb-2">Data Barang Customer</h2>
                <hr> <br>
                <input type="text" placeholder="Kode RBC" v-model="kode_rbc" class="input" disabled />
                <input type="text" placeholder="Nama Barang" v-model="nama_brg_cus" class="input" disabled />
                {{-- <input type="text" placeholder="NO POS" v-model="fno_poc" class="input" /> --}}
                <input type="text" placeholder="Harga POC" v-model="harga_poc" ref="harga_poc" class="input" />
                <input type="text" placeholder="Qty POC" v-model="fqt_poc" ref="fqt_poc" class="input" />
                <input type="hidden" placeholder="NO SPK" v-model="fno_spk" class="input" disabled />

                <br><br>
                <button class="btn" @click="openModalBarang">Cari Barang</button> 
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
                    <span>Total : @{{ _moneyFormat(grand_total) }}</span>
                </div>
                <div class="overflow-x-auto">

                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Kode RBC</th>
                                {{-- <th>NO POS</th> --}}
                                <th>Nama Barang</th>
                                <th>Harga POC</th>
                                <th>Qty POC</th>
                                <th>Sub Total</th>
                                <th>@</th>
                                {{-- <th>No SPO</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row 1 -->
                            <tr v-for="data in data_barangs">
                                <th>@{{ data.kode_rbc }}</th>
                                {{-- <td>@{{ data.fno_poc }}</td> --}}
                                <td>@{{ data.nama_brg_cus }}</td>
                                <td>@{{ data.harga_poc }}</td>
                                <td>@{{ data.fqt_poc }}</td>
                                <td>@{{ data.fqt_poc * data.harga_poc }}</td>
                                <td>
                                    <button class="btn btn-error" @click="deleteData(data.kode_rbc)">x</button>
                                </td>
                                {{-- <td>@{{ data.no_spo }}</td> --}}
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
        <!-- Open the modal using ID.showModal() method -->
        <dialog id="my_modal_barang" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Cari Barang Customer</h3>
                <hr>
                <p class="py-4"></p>
                <input type="text" placeholder="Search" @keyup="searchData"  v-model="search" ref="search" class="input" />
                <br>
                <div class="modal-action">

                    <div class="overflow-x-auto">

                        <table class="table">
                            <!-- head -->
                            <thead>
                                <tr>
                                    <th>Kode Customer</th>
                                    <th>ID Otomatis</th>
                                    <th>Kode RBC</th>
                                    <th>Nama Barang</th>
                                    <th>Kode Part</th>
                                    <th>harga PO</th>
                                    <th>Satuan Jual</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- row 1 -->
                                <tr v-for="data in barangs">
                                    <th @click="addBarang(data)">
                                        <a href="#">@{{ data.kode_cus }}</a>
                                    </th>
                                    <th>@{{ data.kode_brj }}</th>
                                    <th>@{{ data.kode_rbc }}</th>
                                    <th>@{{ data.nama_brg_cus }}</th>
                                    <th>@{{ data.kode_part }}</th>
                                    <th>@{{ data.harga_jual }}</th>
                                    <th>@{{ data.satuan_jual }}</th>
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
                PPN_Customer : null,
                pph23_customer : null,
                fno_spk : null,
                Hpo_Customer: null,
                alert: false,
                links: null,
                search: null,
                loading: false,
                id_edit: null,
                no_poc: null,
                tgl_poc: null,
                result_customer: null,
                data_customer: null,
                no_ppn: null,
                pph23: null,
                PPN_customer: null,
                ket: null,
                result_kode_user: null,
                data_kode_user: null,
                kode_rbc: null,
                nama_brg_cus: null,
                harga_poc: null,
                no_spk: null,
                fqt_poc: null,
                data_barangs: null,
                grand_total: 0,
                disabled_customer: false
            },
            methods: {
                deleteData: function(kd){
                    var $storage = _getStorage('data');
                    $storage = JSON.parse($storage);
                    
                    var newData;
                    $storage.forEach(element => {
                        if (element['kode_rbc']===kd){
                            newData = $storage.filter(item => item.kode_rbc !== kd);
                        }
                    });

                    _saveStorage('data',JSON.stringify(newData))
                    this.data_barangs = JSON.parse(_getStorage('data'));

                    var grand_total = 0;
                    newData.forEach(element => {
                        grand_total += element['sub_total'];
                    });
                    this.grand_total = grand_total
                },
                clearData: function() {
                    localStorage.clear()
                    _refresh()
                },
                generateKodeSpk() {

                    var data = (_getStorage('data'));
                    if (data) {
                        data = JSON.parse(data);
                        var $urut = [];
                        var $i = 0;
                        data.forEach(element => {
                            $urut[$i] = element['no_spk']
                            $i++;
                        });
                        $urut = $urut.sort((a, b) => a - b);
                        const angka = String($urut[$urut.length - 1]).slice(-3);
                        this.no_spk = generateNoUrutDateMonth(angka);
                    } else {
                        this.no_spk = tahun + bulan + '001';
                    }
                },
                addData: function() {
                    var $storage;
                    if (_getStorage('data')) {
                        $storage = JSON.parse(_getStorage('data'))
                    }
                    if (this.kode_rbc == null) {
                        alert("Pilih Barang dulu !")
                        return
                    }
                    if (this.fqt_poc == null) {
                        this.$refs.fqt_poc.focus();
                        return;
                    }

                    var $data = [{
                        "kode_rbc": this.kode_rbc,
                        "nama_brg_cus" : this.nama_brg_cus,
                        "fno_poc": this.fno_poc,
                        "harga_poc": this.harga_poc,
                        "fqt_poc": this.fqt_poc,
                        "fno_spk": this.fno_spk,
                        "sub_total":this.fqt_poc * this.harga_poc
                    }]

                    if ($storage == null) {
                        $tmp = JSON.stringify($data);
                        _saveStorage('data', $tmp);
                       
                    } else {
                        var BreakException = {};
                        $storage.forEach(element => {
                            if (element['kode_rbc']===this.kode_rbc){
                                alert("Data sudah ada !")
                                throw BreakException;
                            }   
                        });
                        $storage.push(...$data);
                        _saveStorage('data', JSON.stringify($storage));
                    }
                     this.data_barangs = JSON.parse(_getStorage('data'));
                    const $barang_total = this.data_barangs;

                    var grand_total = 0;
                    $barang_total.forEach(element => {
                        grand_total += element['sub_total'];
                    });

                    this.grand_total = grand_total
                    this.kode_rbc = null;
                    this.nama_brg_cus = null;
                    this.fqt_poc = null;
                    this.no_spk = null;
                    this.harga_poc = null;
                    this.generateKodeSpk()
                    this.disabled_customer=true;
                },
                addBarang: function(data) {
                    this.kode_rbc = data.kode_rbc
                    this.nama_brg_cus = data.nama_brg_cus
                    this.harga_poc = data.harga_jual
                    my_modal_barang.close()
                    this.$refs.fqt_poc.focus()
                },
                openModalBarang: function() {

                    if (this.result_customer == null) {
                        alert("Pilih Customer Customer !")
                        return
                    }
                    my_modal_barang.showModal()
                    this.loadDataBarang(this.result_customer);
                    this.generateKodeSpk();
                },
                loadDataBarang: function(kode_cus) {
                    const $this = this;
                    axios.post("/load-data-rls-brg-cus", {
                            _token: _TOKEN_,
                            kode_cus: kode_cus
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
                   
                    const $this = this;
                    axios.post("/search-rls-cus", {
                            _token: _TOKEN_,
                            search: this.search,
                            kode_cus : this.result_customer
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.barangs = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.tgl_poc == null) {
                        this.$refs.tgl_poc.focus()
                        return;
                    }

                    if (this.result_customer == null) {
                        this.$refs.result_customer.focus()
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
                    axios.post("/save-hpo_customer", {
                            _token: _TOKEN_,
                            data: (_getStorage('data')),
                            tgl_poc: this.tgl_poc,
                            result_customer: this.result_customer,
                            ket: this.ket,
                            fno_poc: this.fno_poc,
                            PPN_customer: this.PPN_customer,
                            pph23_customer: this.pph23_customer
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
                logout: function() {
                    window.location.href = '/logout';
                },

                generateId() {
                    const $this = this;
                    axios.post("/generate-id-hpo-customer", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                if (response.data.fno_poc) {
                                    const angka = String(response.data.fno_poc).slice(-3);
                                    $this.fno_poc = generateNoUrutDateMonth(angka);
                                } else {
                                    $this.fno_poc = tahun + bulan + (response.data);
                                }
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                loadDataCustomer: function() {
                    const $this = this;
                    axios.post("/load-data-customer", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_customer = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
            },
            mounted() {
                localStorage.clear(); 
                this.generateId();
                this.loadDataCustomer();
            }
        });
    </script>
</body>

</html>
