<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Forgot Page</title>
    @include('@component/assets')

</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div id="app" class="w-full max-w-md p-8 bg-white shadow-xl rounded-xl">
        <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Forgot Password</h2>
        <center v-if="loading">
            <span class="loading loading-spinner loading-md"></span>
        </center>
            <div class="mb-4">
                <label class="block text-gray-700 mb-2" for="email"></label>
                <input v-model="email" ref="email" id="email" type="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="you@example.com" required />
            </div>

           

            <div class="mb-6">
                <button type="button" @click="forgot"
                    class="w-full bg-blue-600 text-white font-semibold py-2 px-4 rounded hover:bg-blue-700">
                    Forgot Password
                </button>
            </div>
          
            <a class="link link-info" href="/login">Login</a> <br> 
      
    </div>

    <script>
        new Vue({
            el: "#app",
            data: {
                email: null,
                loading : false
            },
            methods: {
                forgot: function() {
                    if (this.email == null) {
                        this.$refs.email.focus();
                        return;
                    }
                    
                    this.loading = true;
                    const $this = this;
                    axios.post("/forgot", {
                            email: this.email
                        })
                        .then(function(response) {
                             $this.loading = false;
                             if (response.data.result===false){
                                Swal.fire({
                                    icon: "error",
                                    title: "Oops...",
                                    text: response.data.message,
                                    footer: ''
                                });
                             }else{
                                Swal.fire({
                                    icon: "success",
                                    title: "Mantap",
                                    text: "Check Your Inbox Emaiil",
                                    footer: ''
                                });
                                this.email = null
                             }
                        })
                        .catch(function(error) {
                            console.log(error);
                        });
                }
            }
        });
    </script>
</body>

</html>
