/* var newStr = window.location.href.substring(0, window.location.href.length - 4);

console.log(newStr); */

const app = {
	data() {
		return {
			title: 'Todo list',
			id: null,
			todo: '',
			todos: [],
			newTodo: '',
			url: window.location.href.substring(0, window.location.href.length - 4) +
				'api/todo/',
		}
	},

	mounted() {
		this.getAll();
	},
	methods: {

		getAll() {
			fetch(`${this.url}index.php`)
				.then(response => response.json())
				.then(data => {
					this.todos = data;
					console.log(data);
				})
				.catch((err) => console.log(err))
		},
		addTodo() {

			if (this.newTodo != '') {

				fetch(`${this.url}create.php`, {
						method: 'POST',
						body: JSON.stringify({
							title: this.newTodo
						}),
						headers: {
							'Content-Type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(res => {
						console.log(res);
						this.getAll();
						this.newTodo = '';
					});
			}

		},
		deleteTodo(deleteId) {

			console.log(deleteId);
			fetch(`${this.url}delete.php`, {
					method: 'DELETE',
					body: JSON.stringify({
						id: deleteId
					}),
					headers: {
						'Content-Type': 'application/json'
					}
				})
				.then(res => res.json())
				.then(res => {
					console.log(res);
					this.getAll();

				});
		},
		updateTodo(updateId, updateTitle) {
			console.log(updateId, updateTitle);

			if (updateTitle) {
				fetch(`${this.url}update.php`, {
						method: 'PUT',
						body: JSON.stringify({
							id: updateId,
							title: updateTitle
						}),
						headers: {
							'Content-Type': 'application/json'
						}
					})
					.then(res => res.json())
					.then(res => {
						console.log(res);
						this.getAll();

					});
			} else {
				this.getAll();
			}
		}
	}
}

Vue.createApp(app).mount('#app');