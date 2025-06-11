<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Data Customer</title>
    @include('@component/assets')
</head>
<body>
    @include('@component/navbar')

    <div id="app" class="mx-auto">
    @include('@component/slide')

        <hr>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search" class="input input-primary" />
        </center>

        <!-- Open the modal using ID.showModal() method -->
        <center>
            <button class="btn btn-primary" @click="openModalAdd()">Add</button>
        </center>

        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>

        <dialog id="my_modal_add" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Input Data Customer</h3>
                <p class="py-4">
                    <div v-if="alert" role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Data has been saved !</span>
                    </div>
                    <input type="text" ref="kode_cus" v-model="kode_cus" disabled placeholder="Kode" class="input input-primary" maxlength="4" /><br>
                    <input type="text" ref="nama_cus" v-model="nama_cus" placeholder="Nama Customer" class="input input-primary" /><br>
                    <input type="text" ref="notelp_cus" v-model="notelp_cus" placeholder="No Telp" class="input input-primary" /><br>
                    <textarea class="textarea" ref="alamat_cus" v-model="alamat_cus"  placeholder="Alamat Supplier"></textarea><br>
                    <input type="text" ref="email_cus" v-model="email_cus" placeholder="Email" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPN</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPN_cus" v-model="PPN_cus" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" id="npwp" maxlength="20" ref="NPWP_cus" v-model="NPWP_cus" placeholder="N.P.W.P" class="input input-primary"/><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPH 23</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPH23_cus" v-model="PPH23_cus" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" ref="CP_cus" v-model="CP_cus" placeholder="Contact Person" class="input input-primary" /><br><br>
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
                <h3 class="text-lg font-bold">Edit Data Customer</h3>
                <p class="py-4">
                    <input type="text" ref="kode_cus_edit" v-model="kode_cus_edit" disabled placeholder="Kode" class="input input-primary" /><br>
                    <input type="text" ref="nama_cus_edit" v-model="nama_cus_edit" placeholder="Nama" class="input input-primary" /><br>
                    <input type="text" ref="notelp_cus_edit" v-model="notelp_cus_edit" placeholder="No Telp" class="input input-primary" /><br>
                    <textarea class="textarea" ref="alamat_cus_edit" v-model="alamat_cus_edit"  placeholder="Alamat Supplier"></textarea><br>
                    <input type="text" ref="email_cus_edit" v-model="email_cus_edit" placeholder="Email" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPN</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPN_cus_edit" v-model="PPN_cus_edit" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" id="npwp_edit" maxlength="20" ref="NPWP_cus_edit" v-model="NPWP_cus_edit" placeholder="N.P.W.P" class="input input-primary" /><br>
                    <fieldset class="fieldset bg-base-100 border-base-300 rounded-box w-64 border p-4">
                    <legend class="fieldset-legend">PPH 23</legend>
                        <label class="label">
                            <input type="checkbox" ref="PPH23_cus_edit" v-model="PPH23_cus_edit" class="checkbox" />
                        </label>
                    </fieldset>
                    <br>
                    <input type="text" ref="CP_cus_edit" v-model="CP_cus_edit" placeholder="Contact" class="input input-primary" /><br><br>
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
                    <tr v-for="data in customers">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.kode_cus }}</td>
                        <td>@{{ data.nama_cus }}</td>
                        <td>@{{ data.notelp_cus }}</td>
                        <td>@{{ data.alamat_cus }}</td>
                        <td>@{{ data.email_cus }}</td>
                        <td>@{{ data.PPN_cus }}</td>
                        <td>@{{ data.NPWP_cus }}</td>
                        <td>@{{ data.PPH23_cus }}</td>
                        <td>@{{ data.CP_cus }}</td>
                        <td>
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.nama_cus)" class="btn btn-error">x</button>
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
                customers : null,
                kode_cus : null,
                nama_cus : null,
                notelp_cus : null,
                alamat_cus : null,
                email_cus : null,
                PPN_cus : null,
                NPWP_cus : null,
                PPH23_cus : null,
                CP_cus : null,
                kode_cus_edit : null,
                nama_cus_edit : null,
                notelp_cus_edit : null,
                alamat_cus_edit : null,
                email_cus_edit : null,
                PPN_cus_edit : null,
                NPWP_cus_edit : null,
                PPH23_cus_edit : null,
                CP_cus_edit : null,
                alert: false,
                links :null,
                search : null,
                jenis : null,
                loading :false,
                id_edit : null
            },
            methods: {
                clear: function(){
                    this.kode_cus = null;
                    this.nama_cus = null;
                    this.notelp_cus = null;
                    this.alamat_cus = null;
                    this.email_cus = null;
                    this.PPN_cus = null;
                    this.NPWP_cus = null;
                    this.PPH23_cus = null;
                    this.CP_cus = null;
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
                                $this.customers = response.data.data;
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
                    axios.post("/generate-id-cus", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.nama_cus.focus();
                            const kode_cus = (response.data.kode_cus);
                            if (kode_cus==null){
                                return $this.kode_cus = generateNewId_cus();
                            }else{
                                $this.kode_cus = generateNewId_cus(kode_cus);
                                if ($this.kode_cus==="erorr"){
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
                    this.kode_cus_edit = data.kode_cus;
                    this.nama_cus_edit = data.nama_cus;
                    this.notelp_cus_edit = data.notelp_cus;
                    this.alamat_cus_edit = data.alamat_cus;
                    this.email_cus_edit = data.email_cus;
                    this.PPN_cus_edit = data.PPN_cus;
                    this.NPWP_cus_edit = data.NPWP_cus;
                    this.PPH23_cus_edit = data.PPH23_cus;
                    this.CP_cus_edit = data.CP_cus;
                    my_modal_edit.showModal()
                },
              updateData: function(){
                    if (this.id_edit) {
                        const $this = this;
                         axios.post("/update-customer", {
                            _token: _TOKEN_,
                            kode_cus_edit: this.kode_cus_edit,
                            nama_cus_edit: this.nama_cus_edit,
                            notelp_cus_edit: this.notelp_cus_edit,
                            alamat_cus_edit: this.alamat_cus_edit,
                            email_cus_edit: this.email_cus_edit,
                            PPN_cus_edit: this.PPN_cus_edit,
                            NPWP_cus_edit: this.NPWP_cus_edit,
                            PPH23_cus_edit: this.PPH23_cus_edit,
                            CP_cus_edit: this.CP_cus_edit,
                            id : this.id_edit
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.loadData();
                                $this.kode_cus_edit = null;
                                $this.nama_cus_edit = null;
                                $this.notelp_cus_edit = null;
                                $this.email_cus_edit = null;
                                $this.PPN_cus_edit = null;
                                $this.NPWP_cus_edit = null;
                                $this.PPH23_cus_edit = null;
                                $this.CP_cus_edit = null;
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
                    axios.post("/search-customer", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.customers = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.kode_cus == null) {
                        this.alert = false;
                        this.$refs.kode_cus.focus()
                        return
                    }
                    if (this.nama_cus == null) {
                        this.alert = false;
                        this.$refs.nama_cus.focus()
                        return
                    }
                    if (this.notelp_cus == null) {
                        this.alert = false;
                        this.$refs.notelp_cus.focus()
                        return
                    }
                    if (this.alamat_cus == null) {
                        this.alert = false;
                        this.$refs.alamat_cus.focus()
                        return
                    }
                    if (this.email_cus == null) {
                        this.alert = false;
                        this.$refs.email_cus.focus()
                        return
                    }
                    if (this.NPWP_cus == null) {
                        this.alert = false;
                        this.$refs.NPWP_cus.focus()
                        return
                    }
                    if (this.CP_cus == null) {
                        this.alert = false;
                        this.$refs.CP_cus.focus()
                        return
                    }
                    const $this = this;
                     axios.post("/save-customer", {
                                        _token: _TOKEN_,
                                        kode_cus: this.kode_cus,
                                        nama_cus: this.nama_cus,
                                        notelp_cus: this.notelp_cus,
                                        alamat_cus: this.alamat_cus,
                                        email_cus: this.email_cus,
                                        PPN_cus: this.PPN_cus,
                                        NPWP_cus: this.NPWP_cus,
                                        PPH23_cus: this.PPH23_cus,
                                        CP_cus: this.CP_cus,
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.alert = false;
                                            $this.kode_cus = null;
                                            $this.nama_cus = null;
                                            $this.notelp_cus = null;
                                            $this.alamat_cus = null;
                                            $this.email_cus = null;
                                            $this.PPN_cus = null;
                                            $this.NPWP_cus = null;
                                            $this.PPH23_cus = null;
                                            $this.CP_cus = null;
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
                                axios.post("/delete-customer", {
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
                    axios.post("/load-customer", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.customers = response.data.data;
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