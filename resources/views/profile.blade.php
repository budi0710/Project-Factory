<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile Page</title>
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
    </div>


    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';

        new Vue({
            el: "#app",
            data: {
                todos: null,
                todo : null,
                search: null,
                loading : false
            },
            methods: {
                searchData: function(){
                     if (this.search==null){
                        this.$refs.search.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;
                    axios.post("/search-todo", {
                        _token: _TOKEN_,
                        search : this.search
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
                save: function(){
                    if (this.todo==null){
                        this.$refs.todo.focus()
                        return
                    }
                    this.loading = true;
                    const $this = this;

                    axios.post("/save-todo", {
                        _token: _TOKEN_,
                        todo : this.todo
                    })
                    .then(function(response) {
                        if (response.data.result) {
                            $this.todo = null;
                            $this.loadData();
                            $this.loading = false;
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
                },
                deleteData: function(id) {
                    if (id){
                          this.loading = true;
                        const $this = this;
                         axios.post("/delete-todo", {
                            _token: _TOKEN_,
                            id : id
                        })
                        .then(function(response) {
                            if (response.data.result) {
                                $this.loadData();
                                $this.loading = false;
                            }
                        })
                        .catch(function(error) {
                            console.log(error);
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
                            if (response.data) {
                               $this.loading = false;
                                $this.todos = response.data;
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
