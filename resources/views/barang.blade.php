<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home Page</title>
    @include('@component/assets')

</head>

<body>
    @include('@component/navbar')
    <div id="app" class="mx-auto">
    @include('@component/slide')
        <hr>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search"
                class="input input-primary" />
        </center>
        <div class="badge badge-secondary">Total Harga @{{ total }}</div>
        <!-- Open the modal using ID.showModal() method -->
        <center>
            <button class="btn btn-primary" @click="openModalAdd">Add</button>
        </center>

        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>

        <dialog id="my_modal_add" class="modal">

            <div class="modal-box">
                <h3 class="text-lg font-bold">Input Data Barang</h3>
                <p class="py-4">
                <div v-if="alert" role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>@{{message_alert}}</span>
                </div><br>
                <input type="text" ref="id_otomatis" disabled v-model="id_otomatis" placeholder="ID Otomatis"
                    class="input input-primary" /><br><br>
                <input type="text" @keyup.enter="saveData" ref="nama" v-model="nama" placeholder="Nama"
                    class="input input-primary" /><br><br>
                <input type="text"  @keyup.enter="saveData" ref="harga" v-model="harga" @keyup="changeCurrency" placeholder="Harga"
                    class="input input-primary" /><br><br>
                <select v-model="result_satuan" class="select">
                    <option disabled selected>Pilih Satuan</option>
                    <option v-for="data in data_satuan" :value="data.id">@{{ data.satuan }}</option>
                </select> <br> <br>
                <select  v-model="result_jenis" class="select">
                    <option disabled selected>Pilih Jenis</option>
                    <option v-for="data in data_jenis" :value="data.id">@{{ data.jenis }}</option>
                </select>
                <br><br>
                <input  @keyup.enter="saveData" type="number" ref="stock" v-model="stock" placeholder="Stock"
                    class="input input-primary" /><br><br>
                <div class="avatar">
                    <div class="w-24 rounded-full">
                        <img :src="foto_barang" />
                    </div>
                </div>
                <input  @keyup.enter="saveData" type="file" id="file_barang" name="file_barang" @change="changeImage($event)"
                    class="file-input file-input-ghost" />
                <br> <br>
                <button @click="save" :disabled="disabled_button_save" class="btn btn-success">Save</button>
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
                <h3 class="text-lg font-bold">Edit Data </h3>
                <p class="py-4">
                      <input type="text" ref="id_otomatis_edit" disabled v-model="id_otomatis_edit" placeholder="ID Otomatis"
                    class="input input-primary" /><br><br>
                    <input type="text" ref="nama_edit" v-model="nama_edit" placeholder="Nama"
                        class="input input-primary" /><br><br>
                    <input type="text" ref="harga_edit" v-model="harga_edit" @keyup="changeCurrencyEdit"
                        placeholder="Harga" class="input input-primary" /><br><br>
                    <select v-model="result_satuan_edit" class="select">
                        <option disabled selected>Pilih Satuan</option>
                        <option v-for="data in data_satuan" :value="data.id">@{{ data.satuan }}</option>
                    </select> <br> <br>
                    <select v-model="result_jenis_edit" class="select">
                        <option disabled selected>Pilih Jenis</option>
                        <option v-for="data in data_jenis" :value="data.id">@{{ data.jenis }}</option>
                    </select>
                    <br><br>
                    <input type="number" ref="stock_edit" v-model="stock_edit" placeholder="Stock"
                        class="input input-primary" /><br><br>
                <div class="avatar">
                    <div class="w-24 rounded-full">
                        <img :src="foto_barang_edit" />
                    </div>
                </div>
                <input type="file" id="file_barang_edit" name="file_barang_edit"
                    @change="changeImageEdit($event)" class="file-input file-input-ghost" />
                <br> <br>
                <button @click="updateData($event)" class="btn btn-success">Update</button>
                </p>
                <div class="modal-action">
                    <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                    </form>
                </div>
            </div>
        </dialog>

        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

            <table class="table">
                <!-- head -->
                <thead>
                    <tr>
                        <th>ID Otomatis</th>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Satuan</th>
                        <th>Jenis</th>
                        <th>Stock</th>
                        <th>Foto</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in barangs">
                        <th>@{{ data.id_otomatis }}</th>
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.nama }}</td>
                        <td>@{{ viewFormat(data.harga) }}</td>
                        <td>@{{ data.satuan }}</td>
                        <td>@{{ data.jenis }}</td>
                        <td>@{{ data.stock }}</td>
                        <td>
                            <div class="avatar">
                                <div class="w-24 rounded-full">
                                    <img :src="viewFoto(data.foto)" width="100" height="100" alt="">
                                </div>
                            </div>
                        </td>
                        <td>
                            @{{ data.number }}
                        </td>
                        <td>
                            <button @click="editModal(data,$event)"  class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.nama)" class="btn btn-error">Hapus</button>
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
                data_satuan: null,
                search: null,
                alert: null,
                harga: null,
                nama: null,
                loading: false,
                links: null,
                data_jenis: null,
                stock: null,
                file_barang: null,
                foto_barang: './storage/todo/no-image.png',
                result_satuan: null,
                result_jenis: null,
                total: null,
                nama_edit: null,
                harga_edit: null,
                stock_edit: null,
                result_jenis_edit: null,
                result_satuan_edit: null,
                file_barang_edit: null,
                foto_barang_edit: null,
                id_edit: null,
                id_otomatis: null,
                id_otomatis_edit : null,
                disabled_button_save : false,
                message_alert: ''
            },
            methods: {
                saveData: function(){
                    this.save()
                },
                clear: function(){
                    this.nama = null;
                    this.harga = null;
                    this.stock = null;
                    this.result_satuan = null;
                    this.result_jenis = null;
                    this.alert = false;
                },
                openModalAdd: function() {
                    my_modal_add.showModal();
                    this.clear()
                    const $this = this;
                    axios.post("/generate-id", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.nama.focus();
                            const id_otomatis = (response.data.id_otomatis);
                            if (id_otomatis==null){
                                return $this.id_otomatis = generateNewId();
                            }else{
                                $this.id_otomatis = generateNewId(id_otomatis);
                                if ($this.id_otomatis==="erorr"){
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
                viewFormat: function(data) {
                    return formatAngkaView(data);
                },
                changeCurrency: function() {
                    this.harga = formatUangTanpaRupiah(this.harga, '');
                },
                changeCurrencyEdit: function() {
                    this.harga_edit = formatUangTanpaRupiah(this.harga_edit, '');
                },
                updateData: function(e) {
                    if (this.id_edit) {
                        if (this.nama_edit == null) {
                            this.loading = false;
                            this.$refs.nama_edit.focus()
                            return
                        }
                        if (this.harga_edit == null) {
                            this.loading = false;
                            this.$refs.harga_edit.focus()
                            return
                        }
                        if (this.result_satuan_edit == null) {
                            alert("Pilih satuan dulu !")
                            return
                        }
                        if (this.result_jenis_edit == null) {
                            alert("Pilih jenis dulu !")
                            return
                        }
                        if (this.stock_edit == null) {
                            this.loading = false;
                            this.$refs.stock_edit.focus()
                            return
                        }
                        this.loading = true;
                        const $this = this;

                        _upload = new Upload({
                            // Array
                            el: ['file_barang_edit'],
                            // String
                            url: '/update-barang',
                            // String
                            data: {
                                nama: this.nama_edit,
                                id_satuan: this.result_satuan_edit,
                                id_jenis: this.result_jenis_edit,
                                harga: resultFormatAngka(this.harga_edit),
                                stock: this.stock_edit,
                                id: this.id_edit,
                                id_otomatis_edit : this.id_otomatis_edit
                            },
                            // String
                            token: _TOKEN_
                        }).start(($response) => {
                            $this.loading = false;
                            var obj = JSON.parse($response)

                            if (obj.result) {
                                alert("Berhasil update Data")
                                $this.loadData();

                            }
                        });
                    }
                },
                editModal: function(data,e) {
                    this.id_edit = data.id;
                    this.result_satuan_edit = data.id_satuan;
                    this.result_jenis_edit = data.id_jenis;
                    this.nama_edit = data.nama;
                    this.harga_edit = formatAngkaView(data.harga);
                    this.stock_edit = data.stock;
                    this.id_otomatis_edit = data.id_otomatis;
                   
                    if (data.foto === 'no-image.png') {
                        this.foto_barang_edit = '/storage/todo/' + data.foto;
                    } else {
                        this.foto_barang_edit = '/storage/barang/' + data.foto;
                    }
                     
                    my_modal_edit.showModal()
                    this.$nextTick(() => {
                        this.$refs.nama_edit.focus();
                    });
                   
                   //this.$refs.nama_edit.focus();
                },
                toggle: function(e){
                    if (e.keyCode == '13') {
                        this.$nextTick(() => this.$refs.nama_edit.focus())
                    }
                },
                changeImageEdit: function(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length) {
                        return
                    }

                    if (files[0].type != 'image/png' && files[0].type != 'image/jpeg') {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "File must be image",
                            footer: ''
                        });
                        return;
                    }
                    this.foto_barang_edit = URL.createObjectURL(files[0])
                },
                changeImage: function(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length) {
                        return
                    }

                    if (files[0].type != 'image/png' && files[0].type != 'image/jpeg') {
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "File must be image",
                            footer: ''
                        });
                        return;
                    }
                    this.foto_barang = URL.createObjectURL(files[0])
                },
                viewFoto: function(foto) {
                    if (foto === 'no-image.png') {
                        return '/storage/todo/' + foto
                    } else {
                        return '/storage/barang/' + foto
                    }
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
                                $this.barangs = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                editData: function(id) {
                    if (id) {
                        window.location.href = '/edit-data/' + id
                    }
                },
                searchData: function() {
                    if (this.search == null) {
                        this.$refs.search.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;
                    axios.post("/search-barang", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.barangs = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                      this.alert = false;
                    if (this.nama == null) {
                        this.loading = false;
                        this.$refs.nama.focus()
                        return
                    }
                    if (this.harga == null) {
                        this.loading = false;
                        this.$refs.harga.focus()
                        return
                    }
                    
                    if (this.result_satuan == null) {
                        this.alert= true;
                        this.message_alert = 'Pilih Satuan Dulu'
                        return
                    }
                    this.alert = false;
                    if (this.result_jenis == null) {
                        this.alert= true;
                        this.message_alert = 'Pilih Jenis Dulu'
                        return
                    }
                      this.alert = false;
                    if (this.stock == null) {
                        this.loading = false;
                        this.$refs.stock.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;
                    _upload = new Upload({
                        // Array
                        el: ['file_barang'],
                        // String
                        url: '/save-barang',
                        // String
                        data: {
                            nama: this.nama,
                            id_satuan: this.result_satuan,
                            id_jenis: this.result_jenis,
                            harga: resultFormatAngka(this.harga),
                            stock: this.stock,
                            id_otomatis: this.id_otomatis
                        },
                        // String
                        token: _TOKEN_
                    }).start(($response) => {
                        $this.loading = false;
                        var obj = JSON.parse($response)
                        if (obj.result) {
                            alert("Berhasil Add Data")
                            $this.loadData();
                            $this.harga = null;
                            $this.stock = null;
                            $this.nama = null;
                            $this.result_satuan = null;
                            $this.result_jenis = null;
                            $this.foto_barang = 'storage/todo/no-image.png'
                            $this.id_otomatis = generateNewId($this.id_otomatis);
                        }
                    });
                },
                deleteData: function(id, barang) {
                    if (id) {
                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + barang + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-barang", {
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
                    this.loading = true;
                    axios.post("/load-barang", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {

                                $this.barangs = response.data.data;
                                $this.links = response.data.links;

                                var total = 0;
                                response.data.data.forEach(element => {
                                    total += parseFloat(element['harga'])
                                });
                                $this.total = _moneyFormat(total.toFixed(2))
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                loadDataSatuan: function() {
                    const $this = this;
                    axios.post("/load-data-satuan", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_satuan = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                loadDataJenis: function() {
                    const $this = this;
                    axios.post("/load-data-jenis", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.data_jenis = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                 handleEnter(e) {
                    if (e.keyCode == 13) {
                        this.$refs.nama_edit.focus()
                    }
                }
            },
            mounted() {
                this.loadData();
                this.loadDataSatuan();
                this.loadDataJenis();
                window.addEventListener('keydown', this.handleEnter);
            }
        });
    </script>
</body>

</html>
