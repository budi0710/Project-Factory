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
        <hr>
        <br>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search"
                class="input input-primary" /> <button class="btn btn-primary" @click="openPage">Add</button>
        </center>
        <!-- Open the modal using ID.showModal() method -->
        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>
        <br>
        <dialog id="my_modal_1" class="modal">

            <div class="modal-box">
                <h3 class="text-lg font-bold"></h3>
                <p class="py-4">
                <div v-if="alert" role="alert" class="alert alert-success">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Data has been saved !</span>
                </div><br>


                <input type="text" disabled ref="no_pos" v-model="no_pos" placeholder="NO Faktur PO"
                    class="input input-primary" /><br><br>
                <input type="date" ref="tgl_pos" v-model="tgl_pos" placeholder="Tgl Faktur"
                    class="input input-primary" /><br><br>
                <select v-model="result_suppllier" ref="result_suppllier" class="select">
                    <option disabled selected>Pilih Suppllier</option>
                    <option v-for="data in data_suppllier" :value="data.id">@{{ data.kode_supplier }}</option>
                </select>
                <br>
                <legend class="fieldset-legend">PPN</legend>
                <label class="label">
                    <input type="checkbox" ref="PPN_suppllier" v-model="PPN_suppllier" class="checkbox" />
                </label>
                </fieldset>
                <br>
                <legend class="fieldset-legend">PPH23</legend>
                <label class="label">
                    <input type="checkbox" ref="pph23" v-model="pph23" class="checkbox" />
                </label>
                </fieldset>
                <br>
                <input type="text" ref="ket" v-model="ket" placeholder="Keterangan"
                    class="input input-primary" /><br><br>
                {{-- <select  v-model="result_kode_user" ref="result_kode_user" class="select">
                        <option disabled selected>Pilih User</option>
                        <option v-for="data in data_kode_user" :value="data.id">@{{ data.fk_user }}</option>
                    </select> <br><br> --}}
                <button @click="save" class="btn btn-success">Save</button>
                </p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- Open the modal using ID.showModal() method -->

        <dialog id="my_modal_detail" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Detail PO</h3>
                <p class="py-4">
                <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kode Part</th>
                                <th>Qty</th>
                                <th>Harga</th>
                                <th>Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in detail_barangs">
                                <th>@{{data.id_otomatis}}</th>
                                <td>@{{data.nama_brg_sup}}</td>
                                <td>@{{data.kode_part}}</td>
                                <td>@{{data.fqa_pos}}</td>
                                <td>@{{data.fharga}}</td>
                                <td>@{{data.FJumlah}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </p>
                <div class="modal-action">
                    <button class="btn" onclick="my_modal_detail.close()">Close</button>
                </div>
            </div>
        </dialog>
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>No POS</th>
                        <th>Tgl POS</th>
                        <th>Kode Supplier</th>
                        <th>PPN</th>
                        <th>PPH 23</th>
                        <th>Ket</th>
                        <th>Kode User</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in h_supliers">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.fno_pos }}</td>
                        <td>@{{ data.ftgl_pos }}</td>
                        <td>@{{ data.fk_sup }}</td>
                        <td>@{{ data.fppn }}</td>
                        <td>@{{ data.fpph23 }}</td>
                        <td>@{{ data.fket }}</td>
                        <td>@{{ data.fk_user }}</td>

                        <td>

                            <button @click="printPage(data.fno_pos)" class="btn btn-success">Print</button>
                            <button @click="editPage(data.fno_pos)" class="btn btn-primary">Edit</button>
                            <button @click="editModal(data.fno_pos)" class="btn btn-warning">Lihat Detail</button>
                            <button @click="deleteData(data.id,data)" class="btn btn-error">x</button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <hr>


        </div>
        <br>
        <center>
            <button class="btn btn-dash btn-primary" @click="loadPaginate(link.url)" v-for="link in links"
                v-html="link.label"></button>
        </center>
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
                detail_barangs : null
            },
            methods: {
                editPage: function(fnopos){
                    window.location.href="./edit-posupplier/"+fnopos;
                },
                printPage : function(fno_pos){
                    window.location.href = './print-posuppllier/'+fno_pos;
                },
                openPage: function() {
                    window.location.href = './add-posuppllier';
                },
                loadPaginate: function(url) {
                    if (url == null) {
                        return
                    }
                    const $this = this;
                    this.loading = true;
                    axios.post(url, {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.jeniss = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                editModal: function(fno_pos) {
                    my_modal_detail.showModal();
                    const $this = this;
                    axios.post("/load-detail-barang", {
                        _token: _TOKEN_,
                        fno_pos : fno_pos
                    })
                    .then(function(response) {
                    
                        if (response.data) {
                            $this.detail_barangs = response.data;
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                },
                updateData: function() {
                    if (this.id_edit) {
                        const $this = this;
                        axios.post("/update-jenis", {
                                _token: _TOKEN_,
                                jenis: this.jenis_edit,
                                id: this.id_edit
                            })
                            .then(function(response) {
                                if (response.data) {
                                    $this.loading = false;
                                    $this.loadData();
                                    alert("Update data sukses")
                                }
                            })
                            .catch(function(error) {
                                console.log(error);
                            });
                    }
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
                        return
                    }
                    if (this.result_suppllier == null) {
                        this.$refs.result_suppllier.focus()
                        return
                    }
                    if (this.PPN_suppllier == null) {

                        this.$refs.PPN_suppllier.focus()
                        return
                    }
                    if (this.pph23 == null) {

                        this.$refs.pph23.focus()
                        return
                    }
                    if (this.ket == null) {

                        this.$refs.ket.focus()
                        return
                    }
                

                    const $this = this;

                    axios.post("/save-po-suppllier", {
                            _token: _TOKEN_,
                            tgl_pos: this.tgl_pos,
                            result_suppllier: this.result_suppllier,
                            PPN_suppllier: this.PPN_suppllier,
                            pph23: this.pph23,
                            ket: this.ket,
                            no_pos: this.no_pos
                        })
                        .then(function(response) {
                            if (response.data.result) {
                                $this.loadData();
                                $this.alert = false;
                                $this.no_pos = null;
                                $this.result_suppllier = null;
                                $this.ket = null;
                                $this.PPN_suppllier = null;
                                $this.pph23 = null
                                alert("Tambah data sukses");
                                // Swal.fire({
                                //     icon: "success",
                                //     title: "Mantap",
                                //     text: "Add Success",
                                //     footer: ''
                                // });
                                $this.generateId()

                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                deleteData: function(id, data) {
                    if (id) {

                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + data.fno_pos + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-h-supplier", {
                                        _token: _TOKEN_,
                                        id: id
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.loading = false;
                                            Swal.fire({
                                                icon: "success",
                                                title: "Mantap",
                                                text: "Delete Success",
                                                footer: ''
                                            });
                                        }
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                    });

                            }
                        });

                    }
                },
                logout: function() {
                    window.location.href = '/logout';
                },
                loadData: function() {
                    const $this = this;

                    axios.post("/load-h-suppllier", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.h_supliers = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
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
                this.loadData()
                this.generateId()
                // this.loadSupplier()
            }
        });
    </script>
</body>

</html>
