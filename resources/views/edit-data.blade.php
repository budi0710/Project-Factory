
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
       
        <div id="app" class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
            <center><br>
                 <div class="avatar">
                    <div class="w-24 rounded-full">
                        <img :src="my_foto" />
                    </div>
                </div>
                <input type="file" id="my_foto" name="my_foto" @change="changeImage($event)" class="file-input file-input-ghost" />
                <br> <br>
                <input type="text" placeholder="ID" readonly  v-model="id" ref="id"  class="input input-info" /> <br>  <br>  
                <input type="text" placeholder="Todo" v-model="todo" ref="todo" class="input input-info" /><br><br>
                <button class="btn btn-info" @click="updateData">Update</button>
                <button class="btn btn-success" @click="back">Back</button><br>
            </center>
           <br>
        </div>
    </div>


    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';

        new Vue({
            el: "#app",
            data: {
                todo : '<?= $todo ?>',
                search: null,
                loading : false,
                alert : false,
                id : '<?= $id ?>',
                my_foto: '<?= '../storage/todo/'.$foto ?>'
            },
            methods: {
                
                 changeImage: function(e) {
                    var files = e.target.files || e.dataTransfer.files;
                    if (!files.length) {
                        return
                    }
                    if (files[0].type!= 'image/png'){
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "File must be image",
                            footer: ''
                        });
                        return;
                    }
                    this.my_foto = URL.createObjectURL(files[0])

                    _upload = new Upload({
                        // Array
                        el: ['my_foto'],
                        // String
                        url: '/upload-foto',
                        // String
                        data: {
                            id: this.id
                        },
                        // String
                        token: _TOKEN_
                    }).start(($response) => {
                          var obj = JSON.parse($response)

                          if (obj.result){
                            Swal.fire({
                                icon: "success",
                                title: "Mantap",
                                text: "upload Success",
                                footer: ''
                            });
                          }
                    });
                },
                viewFoto: function(foto) {
                    return '../storage/' + foto
                },
                back : function(){
                     window.location.href = '/home'
                },
                updateData: function(id){
                    if (id){
                        if (this.todo==null){
                            this.$refs.todo.focus()
                            return
                        }
                        
                        const $this = this;

                        axios.post("/update-todo", {
                            _token: _TOKEN_,
                            todo : this.todo,
                            id : this.id
                        })
                        .then(function(response) {
                            if (response.data.result) {
                                $this.todo = null;
                                Swal.fire({
                                    icon: "success",
                                    title: "Mantap",
                                    text: "Updated Success",
                                    footer: ''
                                });
                                window.location.href="/home"
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                    }
                },
            },
            mounted() {
                
            }
        });
    </script>
</body>

</html>
