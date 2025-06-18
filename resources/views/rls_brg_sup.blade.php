<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relasi Barang Supplier</title>
    @include('@component/assets')
</head>
<body>
@include('@component/navbar')
    <div id="app" class="mx-auto">
        <br><br><br>
        <br>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search" class="input input-primary" /> | <button class="btn btn-primary" @click="openModalAdd()">Add</button>
        </center>
        <!-- Open the modal using ID.showModal() method -->
        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>
        <br>
        <dialog id="my_modal_add" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Input Data Relasi</h3>
                <p class="py-4">
                    <div v-if="alert" role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                        <span>Data has been saved !</span>
                    </div><br>
                    <input type="text" ref="kode_rls" v-model="kode_rls" disabled placeholder="kode relasi" class="input input-primary" /><br><br>
                    <select v-model="result_supplier" ref="result_supplier" class="select">
                        <option disabled selected>Pilih Supplier</option>
                        <option v-for="data in data_supplier_input" :value="data.kode_supplier">@{{ data.nama_supplier }}</option>
                    </select> <br> <br>
                    <select  v-model="result_barang" class="select">
                        <option disabled selected>Pilih Barang</option>
                        <option v-for="data in data_barang_input" :value="data.id_otomatis">@{{ data.nama }}</option>
                    </select> <br> <br>
                    <input type="text" ref="nama_brg_sup" v-model="nama_brg_sup" placeholder="Nama Barang Supplier" class="input input-primary" /><br><br>
                    <input type="text" ref="kode_part" v-model="kode_part" placeholder="Kode Part" class="input input-primary" /><br><br>
                    <input type="text" ref="harga_beli" v-model="harga_beli" @keyup="changeCurrency" placeholder="Harga Beli" class="input input-primary" /><br><br>
                    <input type="text" ref="satuan_beli" v-model="satuan_beli" placeholder="Satuan Beli" class="input input-primary" /><br><br>
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
                <h3 class="text-lg font-bold">Edit Data Relasi</h3>
                <p class="py-4">
                    <input type="text" ref="kode_rls_edit" v-model="kode_rls_edit" disabled placeholder="Kode Relasi" class="input input-primary" /><br><br>
                    <select v-model="result_supplier_edit" class="select">
                        <option disabled selected>Pilih Satuan</option>
                        <option v-for="data in data_supplier_input" :value="data.kode_supplier">@{{ data.nama_supplier }}</option>
                    </select> <br> <br>
                    <select v-model="result_barang_edit" class="select">
                        <option disabled selected>Pilih Jenis</option>
                        <option v-for="data in data_barang_input" :value="data.id_otomatis">@{{ data.nama }}</option>
                    </select>
                    <br><br>
                    <input type="text" ref="nama_brg_sup_edit" v-model="nama_brg_sup_edit" placeholder="Nama Barang Supplier" class="input input-primary" /><br><br>
                    <input type="text" ref="kode_part_edit" v-model="kode_part_edit" placeholder="Kode Part" class="input input-primary" /><br><br>
                    <input type="text" ref="harga_beli_edit" v-model="harga_beli_edit" @keyup="changeCurrencyEdit" placeholder="Harga Beli" class="input input-primary" /><br><br>
                    <input type="text" ref="satuan_beli_edit" v-model="satuan_beli_edit" placeholder="Satuan Beli" class="input input-primary" /><br><br>
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
                        <th>Kode Sup</th>
                        <th>Nama Sup</th>
                        <th>Kode Brg</th>
                        <th>Kode Rls</th>
                        <th>Nama Barang</th>
                        <th>Nama Relasi</th>
                        <th>Kode Part</th>
                        <th>Harga Beli</th>
                        <th>Satuan Beli</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in rls_brg_sup">
                        <td>@{{ data.id }} </td>
                        <td>@{{ data.kode_supplier }}</td>
                        <td>@{{ data.nama_supplier }}</td>
                        <td>@{{ data.id_otomatis }}</td>
                        <td>@{{ data.kode_rls }}</td>
                        <td>@{{ data.nama }}</td>
                        <td>@{{ data.nama_brg_sup }}</td>
                        <td>@{{ data.kode_part }}</td>
                        <td>@{{ viewFormat(data.harga_beli) }}</td>
                        <td>@{{ data.satuan_beli }}</td>
                        <td>
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.nama_brg_sup)" class="btn btn-error">x</button>
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
                kode_rls : null,
                nama_brg_sup : null,
                kode_part : null,
                harga_beli : null,
                satuan_beli : null,
                result_supplier : null,
                result_barang : null,
                kode_rls_edit : null,
                nama_brg_sup_edit : null,
                kode_part_edit : null,
                harga_beli_edit : null,
                satuan_beli_edit : null,
                result_barang_edit : null,
                result_supplier_edit : null,
                data_kode_brg : null,
                data_kode_supplier : null,
                data_supplier_input : null,
                data_barang_input : null,
                rls_brg_sup : null, 
                alert: false,
                satuan_edit : null,
                links :null,
                search : null,
                satuan : null,
                loading :false,
                id_edit : null
            },
            methods: {
                clear: function(){
                    this.kode_rls = null;
                    this.nama_brg_sup = null;
                    this.kode_part = null;
                    this.harga_beli = null;
                    this.satuan_beli = null;
                    this.alert = false;
                },

                loadDataSupplier: function() {
                    const $this = this;
                    axios.post("/load-data-supplier", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_supplier_input = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                loadDataBarang: function() {
                    const $this = this;
                    axios.post("/load-data-barang", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_barang_input = response.data;
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
                    //alert("ok")
                    axios.post("/generate-id-rls-sup", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.result_supplier.focus();
                            const kode_rls = (response.data.kode_rls);
                            if (kode_rls==null){
                                return $this.kode_rls = generateNewId_rls_sup();
                            }else{
                                $this.kode_rls = generateNewId_rls_sup(kode_rls);
                                if ($this.kode_rls==="erorr"){
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
                                $this.rls_brg_sup = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
               editModal: function(data) {
                    this.id_edit = data.id;
                    this.result_supplier_edit = data.kode_supplier;
                   // alert(data.kode_supplier)
                    this.result_barang_edit = data.id_otomatis;
                    this.kode_rls_edit = data.kode_rls;
                    this.nama_brg_sup_edit = data.nama_brg_sup;
                    this.kode_part_edit = data.kode_part;
                    this.harga_beli_edit = formatAngkaView(data.harga_beli);
                    this.satuan_beli_edit = data.satuan_beli;
                    my_modal_edit.showModal()
                },
              updateData: function(){
                    if (this.id_edit) {
                        const $this = this;
                         axios.post("/update-rls-sup", {
                            _token: _TOKEN_,
                            nama_brg_sup: this.nama_brg_sup_edit,
                            kode_part: this.kode_part_edit,
                            harga_beli: resultFormatAngka(this.harga_beli_edit),
                            satuan_beli: this.satuan_beli_edit,
                            id : this.id_edit
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
                    axios.post("/search-rls-sup", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.rls_brg_sup = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.kode_rls == null) {
                        this.alert = false;
                        this.$refs.kode_rls.focus()
                        return
                    }
                    const $this = this;
                     axios.post("/save-rls-sup", {
                                        _token: _TOKEN_,
                                        kode_supplier: this.result_supplier,
                                        id_otomatis: this.result_barang,
                                        kode_rls: this.kode_rls,
                                        nama_brg_sup: this.nama_brg_sup,
                                        kode_part: this.kode_part,
                                        harga_beli: resultFormatAngka(this.harga_beli),
                                        satuan_beli: this.satuan_beli,
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.alert = false;
                                            $this.result_supplier = null;
                                            $this.result_barang = null;
                                            $this.kode_rls = null;
                                            $this.nama_brg_sup = null;
                                            $this.kode_part = null;
                                            $this.harga_beli = null;
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
                deleteData: function(id, rls_brg_sups) {
                    if (id) {
                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + rls_brg_sups + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-rls-sup", {
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

                viewFormat: function(data) {
                    return formatAngkaView(data);
                },
                changeCurrency: function() {
                    this.harga_beli = formatUangTanpaRupiah(this.harga_beli, '');
                },
                changeCurrencyEdit: function() {
                    this.harga_beli_edit = formatUangTanpaRupiah(this.harga_beli_edit, '');
                },
                loadData: function() {
                    const $this = this;
                    axios.post("/load-rls-brg-sup", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.rls_brg_sup = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            },
            mounted() {
                this.loadData();
                this.loadDataSupplier();
                this.loadDataBarang();
            }
        });
    </script>
</body>
</html>