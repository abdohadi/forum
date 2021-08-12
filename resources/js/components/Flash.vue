<script>
	export default {
		props: ['message'],

		data() {
			return {
				body: '',
				show: false
			};
		},

		created() {
			if (this.message) {
				this.flash(this.message);
			}

			this.listenToFlash();
		},

		methods: {
			flash(message) {
				this.body = message;
				this.show = true;

				this.hide();
			},

			hide() {
				setTimeout(() => {
					this.show = false;
				}, 3000);
			}, 

			listenToFlash() {
				body.addEventListener("flash", (e) => { this.flash(e.detail.message) });
			}
		}
	}
</script>

<template>
	<div class="alert alert-success" v-if="show">
		<strong>Success! </strong>{{ body }}
	</div>
</template>

<style>
	.alert {
		position: fixed;
		bottom: 20px;
		right: 20px;
		padding: .75rem 1.25rem;
		margin-bottom: 1rem;
		border: 1px solid transparent;
		border-radius: .25rem;
	}

	.alert-success {
	    color: #155724;
	    background-color: #d4edda;
	    border-color: #c3e6cb;
	}
</style>