var formSerialize = require('form-serialize');

export const bsIframeModalVue = {
    data() {
		return {
			body: this.message,
			loading: true,
			title: 'Loading.. IFRAME',
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
        onShow(event){
            var button = $(event.relatedTarget); // Button that triggered the modal //relatedTarget: button.btn.btn-primary

            this.title = button.data('title'); // Extract info from data-* attributes
            this.href = button.data('href');
            this.body = '';


            if (this.href == undefined) {
                this.body = 'attributes data-href missing in button';
            }
            this.loading=false;

        },
         onHidden(){
            this.loading = true;
            this.hasError = false;
            this.hasSuccess = false;
            this.body = '';

        },

    },
    mounted() {
        this.modal = $(this.$refs.vueiframemodal);
        this.modal.on("hidden.bs.modal", this.onHidden);
        this.modal.on("show.bs.modal", this.onShow);

        document.addEventListener("keydown", (e) => {
            if (this.show && e.keyCode == 27) {
                this.close();
            }
        });
    }



};

//export default bsIframeModalVue;
