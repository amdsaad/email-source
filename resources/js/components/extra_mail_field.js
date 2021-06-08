Vue.component('extra_mail_field', {
	data: function(){
		return {	
	        rows: [
	            { title: "", description: "" },
	        ]
		}
    },
    methods: {
        addRow: function () {
            this.rows.push({ title: "", description: "" });
        },
        removeElement: function (row) {
            var index = this.rows.indexOf(row);
            this.rows.splice(index, 1);
        }
    }
});

