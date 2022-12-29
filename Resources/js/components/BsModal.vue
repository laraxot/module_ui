<template>
	<div class="modal fade" id="vueModal" ref="vuemodal" tabindex="-1" role="dialog" aria-labelledby="vueModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div v-if="loading">
					<div class="modal-header">
						<h5  id="vueModalLabel">{{ title }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="d-flex justify-content-center">
							<div class="spinner-border" role="status" >
								<span class="sr-only">Loading...</span>
							</div>
						</div>
					</div>
				</div>
				<div v-else>
					<div class="modal-header">
						<h5 class="modal-title" id="vueModalLabel">{{ title }}</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="hasError">
                            {{ error }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert" v-if="hasError" v-for="item in errors">
                            {{ item }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" role="alert" v-if="hasSuccess">
                            {{ success_msg }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

						<span v-html="body" v-on:click.capture="handleClick"></span>
                        <!--
                        <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Send message</button>

					    </div>
                        -->
                    </div>

				</div>
			</div>
		</div>

	</div>
</template>
<script>

var formSerialize = require('form-serialize');
import { bsModalVue } from '../../../../../../../Modules/Theme/Resources/js/components/mixins/bsModalVue';


export default {
	name: 'bs-modal',
	props: ['message'],
    mixins: [bsModalVue],
    mounted() {
        this.modal = $(this.$refs.vuemodal);
        this.modal.on("hidden.bs.modal", this.onHidden);
        this.modal.on("show.bs.modal", this.onShow);


    }

};
/*
http://junerockwell.com/how-to-make-simple-basic-modal-using-bootstrap-css-vuejs-2/
https://github.com/hultberg/vue-bootstrap-modal/blob/master/src/modal.vue

https://forum.vuejs.org/t/the-right-way-to-do-2-way-props/16487/4
<textarea v-model="interface"></textarea>
computed:{
 interface:{
   get(){
     return this.value
   },
   set(val){
     this.$emit('input', val)
   }
 }
}

/how-to-run-file-script-in-v-html
https://laracasts.com/discuss/channels/vue/how-to-run-file-script-in-v-html

loadCSS = function(href) {

  var cssLink = $("<link>");
  $("head").append(cssLink); //IE hack: append before setting href

  cssLink.attr({
    rel:  "stylesheet",
    type: "text/css",
    href: href
  });

};
Usage:

loadCSS("/css/file.css");

*/
</script>
<style>
</style>
