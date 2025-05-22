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
    <br>

    <div id="app" class="mx-auto">
        <div class="items-center">
            <div class="carousel w-full">
                <div id="item1" class="carousel-item w-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1625726411847-8cbb60cc71e6.webp"
                        class="w-full" />
                </div>
                <div id="item2" class="carousel-item w-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1609621838510-5ad474b7d25d.webp"
                        class="w-full" />
                </div>
                <div id="item3" class="carousel-item w-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1414694762283-acccc27bca85.webp"
                        class="w-full" />
                </div>
                <div id="item4" class="carousel-item w-full">
                    <img src="https://img.daisyui.com/images/stock/photo-1665553365602-b2fb8e5d1707.webp"
                        class="w-full" />
                </div>
            </div>
            <div class="flex w-full justify-center gap-2 py-2">
                <a href="#item1" class="btn btn-xs">1</a>
                <a href="#item2" class="btn btn-xs">2</a>
                <a href="#item3" class="btn btn-xs">3</a>
                <a href="#item4" class="btn btn-xs">4</a>
            </div>
        </div>

        <hr>
        <center>
            <input type="text" @keyup="searchData" ref="search" v-model="search" placeholder="Search"
                class="input input-primary" />
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 shrink-0 stroke-current" fill="none"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Data has been saved !</span>
                </div><br>
                <div class="avatar">
                    <div class="w-24 rounded-full">
                        <img :src="my_foto" />
                    </div>
                </div>
                <input type="file" id="my_foto" name="my_foto" @change="changeImage($event)"
                    class="file-input file-input-ghost" />
                <br> <br>
                <input type="text" ref="todo" v-model="todo" placeholder="Todo"
                    class="input input-primary" /><br><br>
                <input type="text" ref="rp" v-model="rp" @keyup="changeCurrency" placeholder="Rp"
                    class="input input-primary" /> <br> <br>

                <br><br>
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
                <div class="avatar">
                    <div class="w-24 rounded-full">
                        <img :src="my_foto_edit" />
                    </div>
                </div>
                <input type="file" id="my_foto_edit" name="my_foto_edit" @change="changeImageEdit($event)"
                    class="file-input file-input-ghost" />
                <br> <br>
                <input type="text" ref="todo_edit" v-model="todo_edit" placeholder="Todo"
                    class="input input-primary" /><br><br>
                <input type="text" ref="rp_edit" v-model="rp_edit" @keyup="changeCurrencyEdit" placeholder="Rp"
                    class="input input-primary" /> <br> <br>

                <br><br>
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
                        <th></th>
                        <th>Todo</th>
                        <th>Foto</th>
                        <th>Harga</th>
                        <th>@</th>

                    </tr>
                </thead>
                <tbody>
                    <!-- row 1 -->
                    <tr v-for="data in todos">
                        <th>@{{ data.id }}</th>
                        <td>@{{ data.todo }}</td>
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
                            <button @click="editModal(data)" class="btn btn-warning">Edit</button>
                            <button @click="deleteData(data.id,data.todo)" class="btn btn-error">x</button>
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


    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';

      

        new Vue({
            el: "#app",
            data: {
                todos: null,
                todo: null,
                search: null,
                loading: false,
                alert: false,
                links: null,
                my_foto: './storage/todo/no-image.png',
                rp: null,
                todo_edit: null,
                rp_edit: null,
                my_foto_edit: './storage/todo/no-image.png',
                id_edit: null
            },
            methods: {
                updateData: function() {
                    if (this.id_edit) {
                        const $this = this;
                        _upload = new Upload({
                            // Array
                            el: ['my_foto_edit'],
                            // String
                            url: '/update-todo',
                            // String
                            data: {
                                todo: this.todo_edit,
                                number: this.rp_edit,
                                id: this.id_edit
                            },
                            // String
                            token: _TOKEN_
                        }).start(($response) => {
                            $this.loading = false;
                            var obj = JSON.parse($response)

                            if (obj.result) {
                                alert("Berhasil Update Data")
                                $this.loadData()
                            }
                        });

                    }
                },
                editModal: function(data) {
                    this.id_edit = data.id;
                    this.todo_edit = data.todo;
                    this.rp_edit = data.number;
                    this.my_foto_edit = '/storage/todo/' + data.foto;
                    my_modal_edit.showModal()
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
                    this.my_foto_edit = URL.createObjectURL(files[0])
                },
                changeCurrency: function() {
                    this.rp = formatUangTanpaRupiah(this.rp, 'Rp. ');
                },
                changeCurrencyEdit: function() {
                    this.rp_edit = formatUangTanpaRupiah(this.rp_edit, 'Rp. ');
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
                    this.my_foto = URL.createObjectURL(files[0])
                },
                viewFoto: function(foto) {
                    return '/storage/todo/' + foto
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
                                $this.todos = response.data.data;
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
                    axios.post("/search-todo", {
                            _token: _TOKEN_,
                            search: this.search
                        })
                        .then(function(response) {
                            if (response.data) {
                                $this.loading = false;
                                $this.todos = response.data;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                },
                save: function() {
                    if (this.todo == null) {
                        this.loading = false;
                        this.$refs.todo.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;

                    _upload = new Upload({
                        // Array
                        el: ['my_foto'],
                        // String
                        url: '/save-todo',
                        // String
                        data: {
                            todo: this.todo,
                            number: this.rp
                        },
                        // String
                        token: _TOKEN_
                    }).start(($response) => {
                        $this.loading = false;
                        var obj = JSON.parse($response)

                        if (obj.result) {
                            alert("Berhasil Add Data")
                            $this.loadData();
                            $this.todo = null;
                            $this.rp = null;
                            $this.my_foto = 'storage/todo/no-image.png'
                        }
                    });
                },
                deleteData: function(id, todo) {
                    if (id) {

                        const $this = this;
                        Swal.fire({
                            title: "Are you sure?",
                            text: "Apakah anda ingin menghapus data ini {" + todo + "}",
                            icon: "warning",
                            showCancelButton: true,
                            confirmButtonColor: "#3085d6",
                            cancelButtonColor: "#d33",
                            confirmButtonText: "Yes, delete it!"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                this.loading = true;
                                axios.post("/delete-todo", {
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
                    axios.post("/load-todo", {
                            _token: _TOKEN_
                        })
                        .then(function(response) {
                            $this.loading = false;
                            if (response.data) {

                                $this.todos = response.data.data;
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
