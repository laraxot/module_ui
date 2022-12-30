<template>
	<div class="modal fade" id="vueIframeModal" ref="vueiframemodal" tabindex="-1" role="dialog" aria-labelledby="vueIframeModalLabel" aria-hidden="true">
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

                        <!--
						<span v-html="body" v-on:click.capture="handleClick"></span>
                        <div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Send message</button>

					    </div>
                        -->
                        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
                            <iframe class="embed-responsive-item" :src="href" allowfullscreen></iframe>
                        </div>

                    </div>

				</div>
			</div>
		</div>

	</div>
</template>
<script>

//var formSerialize = require('form-serialize');
import { bsIframeModalVue } from '../../../../../../../Modules/Theme/Resources/js/components/mixins/bsIframeModalVue';


export default {
	name: 'bs-iframe-modal',
	props: ['message'],
    mixins: [bsIframeModalVue],
    mounted() {
        this.modal = $(this.$refs.vueiframemodal);
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



*/
</script>
<style>
</style>
