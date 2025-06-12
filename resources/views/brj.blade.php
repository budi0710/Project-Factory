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
        <br>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search"
                class="input input-primary" /> <button class="btn btn-primary" @click="openModalAdd">Add</button>
        </center>
        <!-- Open the modal using ID.showModal() method -->
        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>
        <br>
        <dialog id="my_modal_add" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold">Input Data Barang Jadi</h3>
                <p class="py-4">
                <div v-if="alert" role="alert" class="alert alert-error">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>@{{message_alert}}</span>
                </div>
                <input type="text" ref="kode_brj" disabled v-model="kode_brj" placeholder="Kode BRJ"
                    class="input input-primary" /><br><br>
                <input type="text" @keyup.enter="saveData" ref="nama_brj" v-model="nama_brj" placeholder="Nama Barang Jadi"
                    class="input input-primary" /><br><br>
                <textarea class="textarea" ref="decription" v-model="decription"  placeholder="Decription"></textarea><br><br>
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
                <h3 class="text-lg font-bold">Edit Data Barang Jadi </h3>
                <p class="py-4">
                    <input type="text" ref="kode_brj_edit" disabled v-model="kode_brj_edit" placeholder="Kode BRJ" class="input input-primary" /><br><br>
                    <input type="text" ref="nama_brj_edit" v-model="nama_brj_edit" placeholder="Nama BRJ" class="input input-primary" /><br><br>
                    <textarea class="textarea" ref="decription_edit" v-model="decription_edit"  placeholder="Decription"></textarea><br><br>
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
                        <th>Kode BRJ</th>
                        <th>ID</th>
                        <th>Nama BRJ</th>
                        <th>decription</th>
                        <th>Foto</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in barangs">
                        <th>@{{ data.kode_brj }}</th>
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.nama_brj }}</td>
                        <td>@{{ data.decription }}</td>
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
                            <button @click="deleteData(data.id,data.nama_brj)" class="btn btn-error">Hapus</button>
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
                search: null,
                alert: null,
                kode_brj : null,
                nama_brj: null,
                decription : null,
                loading: false,
                links: null,
                file_barang: null,
                foto_barang: './storage/barang_Jadi/no-image.png',
                kode_brj_edit: null,
                nama_brj_edit: null,
                decription_edit: null,
                file_barang_edit: null,
                foto_barang_edit: null,
                id_edit: null,
                disabled_button_save : false,
                message_alert: ''
            },
            methods: {
                saveData: function(){
                    this.save()
                },
                clear: function(){
                    this.kode_brj = null;
                    this.nama_brj = null;
                    this.decription = null;
                    this.alert = false;
                },
                openModalAdd: function() {
                    my_modal_add.showModal();
                    this.clear()
                    const $this = this;
                    axios.post("/generate-id-brj", {
                        _token: _TOKEN_
                    })
                    .then(function(response) {
                        if (response.data) {
                             $this.$refs.nama_brj.focus();
                            const kode_brj = (response.data.kode_brj);
                            if (kode_brj==null){
                                return $this.kode_brj = generateNewId_BRJ();
                            }else{
                                $this.kode_brj = generateNewId_BRJ(kode_brj);
                                if ($this.kode_brj==="erorr"){
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
                updateData: function(e) {
                    if (this.id_edit) {
                        if (this.nama_brj_edit == null) {
                            this.loading = false;
                            this.$refs.nama_brj_edit.focus()
                            return
                        }
                        if (this.decription_edit == null) {
                            this.loading = false;
                            this.$refs.decription_edit.focus()
                            return
                        }
                        this.loading = true;
                        const $this = this;

                        _upload = new Upload({
                            // Array
                            el: ['file_barang_edit'],
                            // String
                            url: '/update-barang-jadi',
                            // String
                            data: {
                                nama_brj: this.nama_brj_edit,
                                decription: this.decription_edit,
                                kode_brj: this.kode_brj_edit,
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
                    this.nama_brj_edit = data.nama_brj;
                    this.decription_edit = data.decription;
                    this.kode_brj_edit = data.kode_brj;
                   
                    if (data.foto === 'no-image.png') {
                        this.foto_barang_edit = '/storage/barang_Jadi/' + data.foto;
                    } else {
                        this.foto_barang_edit = '/storage/barang_Jadi/' + data.foto;
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
                        return '/storage/barang_Jadi/' + foto
                    } else {
                        return '/storage/barang_Jadi/' + foto
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
                    axios.post("/search-barang-jadi", {
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
                    if (this.nama_brj == null) {
                        this.loading = false;
                        this.$refs.nama_brj.focus()
                        return
                    }
                    if (this.decription == null) {
                        this.loading = false;
                        this.$refs.decription.focus()
                        return
                    }
                
                    this.loading = true;
                    const $this = this;
                    _upload = new Upload({
                        // Array
                        el: ['file_barang'],
                        // String
                        url: '/save-barang-jadi',
                        // String
                        data: {
                            nama_brj: this.nama_brj,
                            decription: this.decription,
                            kode_brj: this.kode_brj
                        },
                        // String
                        token: _TOKEN_
                    }).start(($response) => {
                        $this.loading = false;
                        var obj = JSON.parse($response)
                        if (obj.result) {
                            alert("Berhasil Add Data")
                            $this.loadData();
                            $this.nama_brj = null;
                            $this.decription = null;
                            $this.foto_barang = 'storage/barang_Jadi/no-image.png'
                            $this.kode_brj = generateNewId_BRJ($this.kode_brj);
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
                                axios.post("/delete-barang-jadi", {
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
                    axios.post("/load-barang-jadi", {
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
                 handleEnter(e) {
                    if (e.keyCode == 13) {
                        this.$refs.nama_edit.focus()
                    }
                }
            },
            mounted() {
                this.loadData();
                window.addEventListener('keydown', this.handleEnter);
            }
        });
    </script>
</body>
</html>
