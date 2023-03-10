var formSerialize = require('form-serialize');

export const bsModalVue = {
    data() {
		return {
			body: this.message,
			loading: true,
			title: 'Loading..',
			hasError: false,
            error: null,
            errors:null,
            hasSuccess:false,
            success_msg:null,
            script_src:null,

		}
	},
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
            this.hasError = false;
            this.hasSuccess = false;
            //headers: 'X-Requested-With': 'XMLHttpRequest'
            axios({
                method: myform.method,
                url: myform.action,
                data: data
            }).then(
                response => {
                    this.loading = false;
                    this.hasSuccess= true;
                    //console.log('success');
                    //console.log('response');
                    if (response.data.redirect) {
                        //handleFormRedirect(response.data.redirect);
                        //this.$router.push('Home')
                        //https://stackoverflow.com/questions/51281157/vue2-how-to-redirect-to-another-page-using-routes
                        this.title="Attendere ..";
                        window.location.href = response.data.redirect;
                    } else {
                        console.log(response);
                        this.title= response.data.message;
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
                    this.loading = false;
                    this.hasError = true;
                    let response=err.response;
                    console.log(response);

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
        },
        onShow(event){
            var button = $(event.relatedTarget); // Button that triggered the modal //relatedTarget: button.btn.btn-primary

            this.title = button.data('title'); // Extract info from data-* attributes
            this.href = button.data('href');
            this.body = '';


            if (this.href == undefined) {
                this.body = 'attributes data-href missing in button';
            }
            axios.get(this.href)
                .then(
                    res => {
                        console.log(res);
                        this.loading = false;
                        this.body = res.data.html;

                        
                        //$.getScript(base_url+'/bc/jquery.rateit/scripts/jquery.rateit.min.js');
                        //$.getScript(base_url+'/bc/jquery.rateit/scripts/rateit.css');
                        $.getScript(base_url+'/themes/coderdocs/dist/js/app.js');
                    }
                ).catch(
                    err => {
                        console.log(err);
                        this.loading = false;
                        this.hasError = true;
                        let response=err.response;
                        console.log(response);
                        this.error=response.data.error;
                        this.body = err;
                    }
                );

        },
         onHidden(){
            this.loading = true;
            this.hasError = false;
            this.hasSuccess = false;
            this.body = '';

        },

    },
    mounted() {
        this.modal = $(this.$refs.vuemodal);
        this.modal.on("hidden.bs.modal", this.onHidden);
        this.modal.on("show.bs.modal", this.onShow);

        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }



};

//export default bsModalVue;
