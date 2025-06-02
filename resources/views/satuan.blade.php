<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Satuan Page</title>
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
            <button class="btn btn-primary" onclick="my_modal_1.showModal()">Add</button>
        </center>
        <center>
            <span v-if="loading" class="loading loading-spinner loading-md"></span>
        </center>
        <dialog id="my_modal_1" class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold"></h3>
                <p class="py-4">
                    <div v-if="alert" role="alert" class="alert alert-success">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                        <span>Data has been saved !</span>
                    </div><br>
                    <input type="text" ref="satuan" v-model="satuan" placeholder="Satuan" class="input input-primary" /><br><br>
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
                <h3 class="text-lg font-bold">Edit</h3>
                <p class="py-4">
                    <input type="text" ref="satuan_edit" v-model="satuan_edit" placeholder="Satuan" class="input input-primary" /><br><br>
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
                        <th>Satuan</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in satuans">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.satuan }}</td>
                      
                        <td>
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.satuan)" class="btn btn-error">x</button>
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
                barangs : null,
                satuans : null,
                alert: false,
                satuan_edit : null,
                links :null,
                search : null,
                satuan : null,
                loading :false,
                id_edit : null
            },
            methods: {
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
                                $this.satuans = response.data.data;
                                $this.links = response.data.links;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
               editModal: function(data) {
                    this.id_edit = data.id;
                    this.satuan_edit = data.satuan;
                    my_modal_edit.showModal()
                },
              updateData: function(){
                    if (this.id_edit) {
                        const $this = this;
                       
                         axios.post("/update-satuan", {
                            _token: _TOKEN_,
                            satuan: this.satuan_edit,
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
                    axios.post("/search-satuan", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.satuans = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.satuan == null) {
                        this.alert = false;
                        this.$refs.satuan.focus()
                        return
                    }
                    
                    const $this = this;

                     axios.post("/save-satuan", {
                                        _token: _TOKEN_,
                                        satuan: this.satuan
                                    })
                                    .then(function(response) {
                                        if (response.data.result) {
                                            $this.loadData();
                                            $this.alert = false;
                                             $this.satuan = null;
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
                deleteData: function(id, satuan) {
                    if (id) {

                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + satuan + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-satuan", {
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
            
                    axios.post("/load-satuan", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {
                                $this.satuans = response.data.data;
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
    </script>
</body>
</html>