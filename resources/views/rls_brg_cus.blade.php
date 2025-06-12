<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Relasi Barang Customer</title>
    @include('@component/assets')
</head>
<body>
@include('@component/navbar')
    <div id="app" class="mx-auto">
        <hr>
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
                    <input type="text" ref="kode_rbc" v-model="kode_rbc" disabled placeholder="kode RBC" class="input input-primary" /><br><br>
                    <select v-model="result_customer" ref="result_customer" class="select">
                        <option disabled selected>Pilih Customer</option>
                        <option v-for="data in data_customer_input" :value="data.kode_cus">@{{ data.nama_cus }}</option>
                    </select> <br> <br>
                    <select  v-model="result_barang_jadi" class="select">
                        <option disabled selected>Pilih Barang</option>
                        <option v-for="data in data_barang_jadi_input" :value="data.kode_brj">@{{ data.nama_brj }}</option>
                    </select> <br> <br>
                    <input type="text" ref="nama_brg_cus" v-model="nama_brg_cus" placeholder="Nama Barang Customer" class="input input-primary" /><br><br>
                    <input type="text" ref="kode_part" v-model="kode_part" placeholder="Kode Part" class="input input-primary" /><br><br>
                    <input type="text" ref="harga_jual" v-model="harga_jual" @keyup="changeCurrency" placeholder="Harga Jual" class="input input-primary" /><br><br>
                    <input type="text" ref="satuan_jual" v-model="satuan_jual" placeholder="Satuan Jual" class="input input-primary" /><br><br>
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
                    <input type="text" ref="kode_rbc_edit" v-model="kode_rbc_edit" disabled placeholder="Kode Relasi" class="input input-primary" /><br><br>
                    <select v-model="result_customer_edit" class="select">
                        <option disabled selected>Pilih Customer</option>
                        <option v-for="data in data_customer_input" :value="data.kode_cus">@{{ data.nama_cus }}</option>
                    </select> <br> <br>
                    <select v-model="result_barang_jadi_edit" class="select">
                        <option disabled selected>Pilih Barang</option>
                        <option v-for="data in data_barang_jadi_edit" :value="data.kode_brj">@{{ data.nama_brj }}</option>
                    </select>
                    <br><br>
                    <input type="text" ref="nama_brg_cus_edit" v-model="nama_brg_cus_edit" placeholder="Nama Barang Customer" class="input input-primary" /><br><br>
                    <input type="text" ref="kode_part_edit" v-model="kode_part_edit" placeholder="Kode Part" class="input input-primary" /><br><br>
                    <input type="text" ref="harga_jual_edit" v-model="harga_jual_edit" @keyup="changeCurrencyEdit" placeholder="Harga Jual" class="input input-primary" /><br><br>
                    <input type="text" ref="satuan_jual_edit" v-model="satuan_jual_edit" placeholder="Satuan Jual" class="input input-primary" /><br><br>
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
                        <th>Kode Cus</th>
                        <th>Nama Customer</th>
                        <th>Kode Brg</th>
                        <th>Kode Rls</th>
                        <th>Nama Barang</th>
                        <th>Nama Barang Customer</th>
                        <th>Kode Part</th>
                        <th>Harga Jual</th>
                        <th>Satuan Jual</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in rls_brg_cus">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.kode_cus }}</td>
                        <td>@{{ data.nama_cus }}</td>
                        <td>@{{ data.kode_brj }}</td>
                        <td>@{{ data.kode_rbc }}</td>
                        <td>@{{ data.nama_brj }}</td>
                        <td>@{{ data.nama_brg_cus }}</td>
                        <td>@{{ data.kode_part }}</td>
                        <td>@{{ viewFormat(data.harga_jual) }}</td>
                        <td>@{{ data.satuan_jual }}</td>
                        <td>
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.nama_brg_cus)" class="btn btn-error">x</button>
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
                kode_rbc : null,
                nama_brg_cus : null,
                kode_part : null,
                harga_jual : null,
                satuan_jual : null,
                result_customer : null,
                result_barang_jadi : null,
                kode_rbc_edit : null,
                nama_brg_cus_edit : null,
                kode_part_edit : null,
                harga_jual_edit : null,
                satuan_jual_edit : null,
                result_barang_edit : null,
                result_customer_edit : null,
                result_barang_jadi_edit : null,
                data_barang_jadi_edit : null,
                kode_brj : null,
                data_kode_supplier : null,
                data_customer_input : null,
                data_barang_jadi_input : null,
                rls_brg_cus : null, 
                alert: false,
                links :null,
                search : null,
                satuan : null,
                loading :false,
                id_edit : null
            },
            methods: {
                clear: function(){
                    this.id = null,
                    this.kode_rbc = null,
                    this.kode_brj = null;
                    this.nama_brg_cus = null;
                    this.kode_part = null;
                    this.harga_jual = null;
                    this.satuan_jual = null;
                    this.alert = false;
                },

                loadDataCustomer: function() {
                    const $this = this;
                    axios.post("/load-customer", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_customer_input = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },

                loadDataBarangJadi: function() {
                    const $this = this;
                    axios.post("/load-barang-jadi", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_barang_jadi_input = response.data;
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
                    axios.post("/generate-id-rls-cus", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.result_customer.focus();
                            const kode_rls = (response.data.kode_rbc);
                            if (kode_rbc==null){
                                return $this.kode_rbc = generateNewId_rls_RBC();
                            }else{
                                $this.kode_rbc = generateNewId_rls_RBC(kode_rbc);
                                if ($this.kode_rbc==="erorr"){
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
                                $this.rls_brg_cus = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
               editModal: function(data) {
                    this.id_edit = data.id;
                    this.result_customer_edit = data.kode_supplier;
                    this.result_barang_edit = data.kode_brj;
                    this.kode_rbc_edit = data.kode_rbc;
                    this.nama_brg_sup_edit = data.nama_brg_cus;
                    this.kode_part_edit = data.kode_part;
                    this.harga_beli_edit = formatAngkaView(data.harga_jual);
                    this.satuan_jual_edit = data.satuan_jual;
                    my_modal_edit.showModal()
                },
              updateData: function(){
                    if (this.id_edit) {
                        const $this = this;
                         axios.post("/update-rls-cus", {
                            _token: _TOKEN_,
                            nama_brg_cus: this.nama_brg_cus_edit,
                            kode_part: this.kode_part_edit,
                            harga_jual: resultFormatAngka(this.harga_jual_edit),
                            satuan_jual: this.satuan_jual_edit,
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
                    axios.post("/search-rls-cus", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.rls_brg_cus = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.kode_rls == null) {
                        this.alert = false;
                        this.$refs.kode_rbc.focus()
                        return
                    }
                    const $this = this;
                     axios.post("/save-rls-cus", {
                                        _token: _TOKEN_,
                                        kode_cus: this.result_customer,
                                        kode_brj: this.result_barang_jadi,
                                        kode_rbc: this.kode_rbc,
                                        nama_brg_cus: this.nama_brg_cus,
                                        kode_part: this.kode_part,
                                        harga_jual: resultFormatAngka(this.harga_jual),
                                        satuan_jual: this.satuan_jual,
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.alert = false;
                                            $this.result_customer = null;
                                            $this.result_barang_jadi = null;
                                            $this.kode_rbc = null;
                                            $this.nama_brg_cus = null;
                                            $this.kode_part = null;
                                            $this.harga_jual = null;
                                            $this.satuan_jual = null;
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
                deleteData: function(id, rls_brg_cus) {
                    if (id) {
                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + rls_brg_cus + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-rls-cus", {
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
                    this.harga_beli = formatUangTanpaRupiah(this.harga_jual, '');
                },
                changeCurrencyEdit: function() {
                    this.harga_beli_edit = formatUangTanpaRupiah(this.harga_jual_edit, '');
                },
                loadData: function() {
                    const $this = this;
                    axios.post("/load-rls-brg-cus", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.rls_brg_cus = response.data.data;
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
                this.loadDataCustomer();
                this.loadDataBarangJadi();
            }
        });
    </script>
</body>
</html>