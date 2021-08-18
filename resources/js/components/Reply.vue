<script>
	export default {
		props: ['firstBody', 'routeToUpdate'],

		data() {
			return {
				editing: false,
				originalBody: this.firstBody,
				body: ''
			};
		},

		created() {
			this.body = this.originalBody;
		},

		methods: {
			cancelEditing() {
				this.toggleEditing()

				this.body = this.originalBody;
			},

			toggleEditing() {
				this.editing = !this.editing
			},

			updateReply() {
				axios.patch(this.routeToUpdate, {
					body: this.body
				})
				.then(response => {
					if (response.data.isSuccessful) {
						this.originalBody = this.body;

						this.toggleEditing();

						flash('Reply has been updated.');
					}
				});
			},

			onInput(event) {
				this.body = event.target.value;
			}
		}
	}
</script>

<template>
	<slot :editing="editing" :body="body" 
		  :toggleEditing="toggleEditing" :updateReply="updateReply" :onInput="onInput" :cancelEditing="cancelEditing">
		  </slot>
</template>