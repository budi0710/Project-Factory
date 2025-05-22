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
       

       

     

       
        <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">

            <center>
                <button @click="go('barang')" class="btn btn-active">Data Barang</button>
                <button @click="go('satuan')" class="btn btn-active btn-primary">Data Satuan</button>
                <button @click="go('jenis')" class="btn btn-active btn-secondary">Data Jenis</button>
            </center>

        </div>
       
    </div>


    <script>
        const _TOKEN_ = '<?= csrf_token() ?>';

        new Vue({
            el : "#app",
            data : {
                
            },
            methods: {
                go: function(page){
                    window.location.href= "./"+page;
                }
            },
        })
    </script>
</body>

</html>
