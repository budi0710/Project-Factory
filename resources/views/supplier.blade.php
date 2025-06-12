<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Supplier</title>
    @include('@component/assets')

</head>
<body>
    @include('@component/navbar')
    <div id="app" class="mx-auto">
        <hr>
        <br>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search" class="input input-primary" />
            <button class="btn btn-primary" @click="openModalAdd()">Add</button>
        </center>

        <!-- Open the modal using ID.showModal() method -->
        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>
        <br>
        <dialog id="my_modal_add" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Input Data Supplier</h3>
                <p class="py-4">
                    <div v-if="alert" role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Data has been saved !</span>
                    </div>
                    <input type="text" ref="kode_supplier" v-model="kode_supplier" disabled placeholder="Kode" class="input input-primary" maxlength="4" /><br>
                    <input type="text" ref="nama_supplier" v-model="nama_supplier" placeholder="Nama" class="input input-primary" /><br>
                    <input type="text" ref="notelp_supplier" v-model="notelp_supplier" placeholder="No Telp" class="input input-primary" /><br>
                    <textarea class="textarea" ref="alamat_supplier" v-model="alamat_supplier"  placeholder="Alamat Supplier"></textarea><br>
                    <input type="text" ref="email_supplier" v-model="email_supplier" placeholder="Email" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPN</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPN_supplier" v-model="PPN_supplier" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" id="npwp" maxlength="20" ref="NPWP_supplier" v-model="NPWP_supplier" placeholder="N.P.W.P" class="input input-primary"/><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPH 23</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPH23_supplier" v-model="PPH23_supplier" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" ref="CP_supplier" v-model="CP_supplier" placeholder="Contact" class="input input-primary" /><br><br>
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

        <dialog id="my_modal_edit" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Edit Data Supplier</h3>
                <p class="py-4">
                    <input type="text" ref="kode_supplier_edit" v-model="kode_supplier_edit" disabled placeholder="Kode" class="input input-primary" /><br>
                    <input type="text" ref="nama_supplier_edit" v-model="nama_supplier_edit" placeholder="Nama" class="input input-primary" /><br>
                    <input type="text" ref="notelp_supplier_edit" v-model="notelp_supplier_edit" placeholder="No Telp" class="input input-primary" /><br>
                    <textarea class="textarea" ref="alamat_supplier_edit" v-model="alamat_supplier_edit"  placeholder="Alamat Supplier"></textarea><br>
                    <input type="text" ref="email_supplier_edit" v-model="email_supplier_edit" placeholder="Email" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPN</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPN_supplier_edit" v-model="PPN_supplier_edit" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" id="npwp_edit" maxlength="20" ref="NPWP_supplier_edit" v-model="NPWP_supplier_edit" placeholder="N.P.W.P" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPH 23</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPH23_supplier_edit" v-model="PPH23_supplier_edit" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" ref="CP_supplier_edit" v-model="CP_supplier_edit" placeholder="Contact" class="input input-primary" /><br><br>
                    <button class="btn btn-warning" @click="updateData">Update</button>
                </p>
                <div class="modal-action">
                    <button class="btn" onclick="my_modal_edit.close()">Close</button>
                </div>
            </div>
        </dialog>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Notelp</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>PPN</th>
                        <th>NPWP</th>
                        <th>PPH23</th>
                        <th>Contact</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in suppliers">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.kode_supplier }}</td>
                        <td>@{{ data.nama_supplier }}</td>
                        <td>@{{ data.notelp_supplier }}</td>
                        <td>@{{ data.alamat_supplier }}</td>
                        <td>@{{ data.email_supplier }}</td>
                        <td>@{{ data.PPN_supplier }}</td>
                        <td>@{{ data.NPWP_supplier }}</td>
                        <td>@{{ data.PPH23_supplier }}</td>
                        <td>@{{ data.CP_supplier }}</td>
                        <td>
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.nama_supplier)" class="btn btn-error">x</button>
                        </td>
                    </tr>

                </tbody>
            </table>
            <hr>


        </div>
        <br>
        <center>
            <button class="btn btn-dash btn-primary" @click="loadPaginate(link.url)" v-for="link in links" v-html="link.label"></button>
        </center>
    </div>
    <br><br>
    @include('@component/footer')
    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';
        new Vue({
            el: "#app",
            data: {
                suppliers : null,
                kode_supplier : null,
                nama_supplier : null,
                alamat_supplier : null,
                email_supplier : null,
                notelp_supplier : null,
                PPN_supplier : null,
                PPH23_supplier : null,
                NPWP_supplier : null,
                CP_supplier : null,
                nama_supplier_edit : null,
                notelp_supplier_edit : null,
                alamat_supplier_edit : null,
                email_supplier_edit : null,
                PPN_supplier_edit : null,
                NPWP_supplier_edit : null,
                PPH23_supplier_edit : null,
                CP_supplier_edit : null,
                alert: false,
                kode_supplier_edit : null,
                links :null,
                search : null,
                jenis : null,
                loading :false,
                id_edit : null
            },
            methods: {
                clear: function(){
                    this.kode_supplier = null;
                    this.nama_supplier = null;
                    this.alamat_supplier = null;
                    this.email_supplier = null;
                    this.PPN_supplier = null;
                    this.NPWP_supplier = null;
                    this.PPH23_supplier = null;
                    this.CP_supplier = null;
                    this.alert = false;
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
                                $this.suppliers = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                openModalAdd: function() {
                    my_modal_add.showModal();
                    this.clear()
                    const $this = this;
                    axios.post("/generate-id-sup", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.nama_supplier.focus();
                            const kode_supplier = (response.data.kode_supplier);
                            if (kode_supplier==null){
                                return $this.kode_supplier = generateNewId_sup();
                            }else{
                                $this.kode_supplier = generateNewId_sup(kode_supplier);
                                if ($this.kode_supplier==="erorr"){
                                    alert("Disabld Button")
                                    $this.disabled_button_save = true
                                }
                            }
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                },
               editModal: function(data) {
                    this.id_edit = data.id;
                    this.kode_supplier_edit = data.kode_supplier;
                    this.nama_supplier_edit = data.nama_supplier;
                    this.notelp_supplier_edit = data.notelp_supplier;
                    this.alamat_supplier_edit = data.alamat_supplier;
                    this.email_supplier_edit = data.email_supplier;
                    this.PPN_supplier_edit = data.PPN_supplier;
                    this.NPWP_supplier_edit = data.NPWP_supplier;
                    this.PPH23_supplier_edit = data.PPH23_supplier;
                    this.CP_supplier_edit = data.CP_supplier;
                    my_modal_edit.showModal()
                },
              updateData: function(){
                    if (this.id_edit) {
                        const $this = this;
                         axios.post("/update-supplier", {
                            _token: _TOKEN_,
                            kode_supplier_edit: this.kode_supplier_edit,
                            nama_supplier_edit: this.nama_supplier_edit,
                            notelp_supplier_edit: this.notelp_supplier_edit,
                            alamat_supplier_edit: this.alamat_supplier_edit,
                            email_supplier_edit: this.email_supplier_edit,
                            PPN_supplier_edit: this.PPN_supplier_edit,
                            NPWP_supplier_edit: this.NPWP_supplier_edit,
                            PPH23_supplier_edit: this.PPH23_supplier_edit,
                            CP_supplier_edit: this.CP_supplier_edit,
                            id : this.id_edit
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.loadData();
                                $this.kode_supplier_edit = null;
                                $this.nama_supplier_edit = null;
                                $this.notelp_supplier_edit = null;
                                $this.alamat_supplier_edit = null;
                                $this.email_supplier_edit = null;
                                $this.PPN_supplier_edit = null;
                                $this.NPWP_supplier_edit = null;
                                $this.PPH23_supplier_edit = null;
                                $this.CP_supplier_edit = null;
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
                    axios.post("/search-supplier", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.suppliers = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.kode_supplier == null) {
                        this.alert = false;
                        this.$refs.kode_supplier.focus()
                        return
                    }
                    if (this.nama_supplier == null) {
                        this.alert = false;
                        this.$refs.nama_supplier.focus()
                        return
                    }
                    if (this.notelp_supplier == null) {
                        this.alert = false;
                        this.$refs.notelp_supplier.focus()
                        return
                    }
                    if (this.alamat_supplier == null) {
                        this.alert = false;
                        this.$refs.alamat_supplier.focus()
                        return
                    }
                    if (this.email_supplier == null) {
                        this.alert = false;
                        this.$refs.email_supplier.focus()
                        return
                    }
                    if (this.NPWP_supplier == null) {
                        this.alert = false;
                        this.$refs.NPWP_supplier.focus()
                        return
                    }
                    if (this.CP_supplier == null) {
                        this.alert = false;
                        this.$refs.CP_supplier.focus()
                        return
                    }
                    const $this = this;
                     axios.post("/save-supplier", {
                                        _token: _TOKEN_,
                                        kode_supplier: this.kode_supplier,
                                        nama_supplier: this.nama_supplier,
                                        notelp_supplier: this.notelp_supplier,
                                        alamat_supplier: this.alamat_supplier,
                                        email_supplier: this.email_supplier,
                                        PPN_supplier: this.PPN_supplier,
                                        NPWP_supplier: this.NPWP_supplier,
                                        PPH23_supplier: this.PPH23_supplier,
                                        CP_supplier: this.CP_supplier,
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.alert = false;
                                            $this.kode_supplier = null;
                                            $this.nama_supplier = null;
                                            $this.notelp_supplier = null;
                                            $this.alamat_supplier = null;
                                            $this.email_supplier = null;
                                            $this.PPN_supplier = null;
                                            $this.NPWP_supplier = null;
                                            $this.PPH23_supplier = null;
                                            $this.CP_supplier = null;
                                            alert("Tambah data sukses");
                                            // Swal.fire({
                                            //     icon: "success",
                                            //     title: "Mantap",
                                            //     text: "Add Success",
                                            //     footer: ''
                                            // });
                                        }
                                    })
                                    .catch(function(error) {
                                        console.log(error);
                                    }); 
                },
                deleteData: function(id, jenis) {
                    if (id) {
                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + jenis + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-supplier", {
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
                    axios.post("/load-supplier", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.suppliers = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            },
            mounted() {
                this.loadData()
            }
        });

        const NPWP_INPUT = document.getElementById("npwp")
            NPWP_INPUT.oninput = (e) => {
                e.target.value = autoFormatNPWP(e.target.value);
            };
        const NPWP_EDIT = document.getElementById("npwp_edit")
            NPWP_EDIT.oninput = (e) => {
                e.target.value = autoFormatNPWP(e.target.value);
            };
    </script>
</body>
</html>