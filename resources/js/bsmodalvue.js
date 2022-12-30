var bsModalVue={
    created() {

    },
    methods: {
        close: function () {
            this.$emit('close');
        },
        submit(e) {
            e.preventDefault();
            this.$root.$emit('form-sending');
            let myform = e.target.form;
            let data = formSerialize(myform, {
                hash: false,
                empty: true
            });
            /*
            data += '&' + e.target.name + '='
                    + encodeURIComponent(e.target.value);

            console.log('method: '+ myform.method);
            console.log('action: ' + myform.action);
            console.log(data);
            */
            this.loading = true;
            //headers: 'X-Requested-With': 'XMLHttpRequest'
            axios({
                method: myform.method,
                url: myform.action,
                data: data
            }).then(
                response => {
                    this.loading = false;
                    //console.log('success');
                    //console.log('response');
                    if (response.data.redirect) {
                        //handleFormRedirect(response.data.redirect);
                        //this.$router.push('Home')
                        //https://stackoverflow.com/questions/51281157/vue2-how-to-redirect-to-another-page-using-routes
                        window.location.href = response.data.redirect;
                    } else {
                        console.log(response);
                        this.body = response.data.html;
                        /*
                        this.title = response.data.title;
                        this.content = response.data.content;
                        */
                    }
                }
            ).catch(
                err => {
                    console.log('------- ERROR ------');
                    console.log(err);
                    let response=err.response;
                    console.log(response);
                    this.loading = false;
                    this.hasError = true;
                    this.error = 'Err: ';
                    console.log('118');
                    console.log(response.data.message);
                    this.error += response.data.error;
                    var $obj=this;
                    if(response.data.error==undefined){ //status: 429
                            this.error = response.data.message;
                            this.error += ' '+response.statusText;
                            this.errors=response.data.errors.handle;
                            /*
                            response.data.errors.handle.forEach(function(item) {
                                $obj.error += '<br/>'+item;
                            });
                            */
                    }
                    //this.body=error;
                }
            );
        },

        handleClick(e) {
            if (e.target.tagName == 'INPUT' && e.target.type == 'submit') {
                this.submit(e);
            }
            if (e.target.tagName == 'BUTTON' && e.target.type == 'submit') {
                this.submit(e);
            }
            e.preventDefault();
        }

    },
    mounted() {
        //var $emit=this.$emit;
        //this.$router.go('http://www.google.com');
        var obj = this;
        this.modal = $(this.$refs.vuemodal);
        this.modal.on("show.bs.modal", function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            obj.title = button.data('title'); // Extract info from data-* attributes
            obj.href = button.data('href');
            obj.body = '';
            var modal = $(this);

            if (obj.href == undefined) {
                obj.body = 'attributes data-href missing in button';
            }
            axios.get(obj.href)
                .then(
                    res => {
                        console.log(res);
                        obj.loading = false;
                        obj.body = res.data.html;
                    }
                ).catch(
                    err => {
                        console.log(err);
                        this.hasError = true;
                        obj.body = err;
                    }
                );

        });
        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }
};